/* animations.js
   - Ligero módulo de UX: animación de contadores, barras de progreso y ripple en botones
   - No modifica lógica del sistema. Solo mejora microinteracciones y animaciones al entrar en viewport.
   - Usa IntersectionObserver para rendimiento y respeta prefers-reduced-motion.
*/
(function(){
    'use strict';
    const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function animateCount(el, start, end, duration){
        if(prefersReduced){ el.textContent = end; return; }
        const range = end - start;
        const startTime = performance.now();
        function tick(now){
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const value = Math.floor(start + range * progress);
            el.textContent = value;
            if(progress < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
    }

    function animateProgressBar(bar){
        if(!bar) return;
        const raw = bar.dataset.percent || bar.getAttribute('data-percent') || bar.style.width || '0';
        const percent = parseFloat(raw) || 0;
        // reset then animate (CSS transition handles smoothness)
        bar.style.willChange = 'width';
        bar.style.width = '0%';
        // allow layout flush
        requestAnimationFrame(()=>{
            bar.style.width = percent + '%';
        });
    }

    function createRipple(e){
        if(prefersReduced) return;
        const btn = e.currentTarget;
        const rect = btn.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height) * 1.2;
        const span = document.createElement('span');
        span.className = 'ripple-effect';
        span.style.width = span.style.height = size + 'px';
        span.style.left = (e.clientX - rect.left - size/2) + 'px';
        span.style.top = (e.clientY - rect.top - size/2) + 'px';
        btn.appendChild(span);
        span.addEventListener('animationend', ()=>{ span.remove(); });
        // safety removal after animation
        setTimeout(()=>{ if(span.parentNode) span.remove(); }, 900);
    }

    function init(){
        // Counters (.count-number[data-target])
        const counters = document.querySelectorAll('.count-number[data-target]');
        if(counters.length){
            const io = new IntersectionObserver((entries, obs)=>{
                entries.forEach(entry => {
                    if(entry.isIntersecting){
                        const el = entry.target;
                        const target = parseInt(el.dataset.target, 10) || 0;
                        animateCount(el, 0, target, 1100);
                        obs.unobserve(el);
                    }
                });
            }, { threshold: 0.3 });
            counters.forEach(c => io.observe(c));
        }

        // Progress bars (.progreso-barra and .progreso-interior)
        const bars = document.querySelectorAll('.progreso-barra, .progreso-interior, .progreso-interior');
        if(bars.length){
            const ioBars = new IntersectionObserver((entries, obs)=>{
                entries.forEach(entry => {
                    if(entry.isIntersecting){
                        animateProgressBar(entry.target);
                        entry.target.classList.add('progreso-animated');
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.24 });
            bars.forEach(b => ioBars.observe(b));
        }

        // Ripple on buttons
        const buttons = document.querySelectorAll('.btn, .btn-main, .btn-card, .btn-login');
        buttons.forEach(btn => {
            // ensure relative positioning for ripple placement
            if(getComputedStyle(btn).position === 'static') btn.style.position = 'relative';
            btn.style.overflow = 'hidden';
            btn.addEventListener('pointerdown', createRipple, {passive: true});
        });

        // Dropdown menu enhancement: apply slight staggered animation to items
        const dropdowns = document.querySelectorAll('.dropdown-menu');
        dropdowns.forEach(menu => {
            const items = Array.from(menu.children).filter(n => n.nodeType === 1);
            items.forEach((li, i) => {
                li.style.animation = 'slideIn .36s cubic-bezier(.2,.9,.2,1) both';
                li.style.animationDelay = (i * 0.055) + 's';
            });
        });
    }

    if(document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init); else init();

})();
