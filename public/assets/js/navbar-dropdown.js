document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = document.querySelectorAll('.dropdown');

    function closeAllDropdowns() {
        dropdowns.forEach(dropdown => dropdown.classList.remove('open'));
    }

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector(':scope > a');
        const menu = dropdown.querySelector('.dropdown-menu');

        if (!toggle || !menu) return;

        toggle.addEventListener('click', function (event) {
            event.preventDefault();
            dropdown.classList.toggle('open');
        });

        menu.addEventListener('click', function (event) {
            const optionLink = event.target.closest('a');
            if (optionLink) {
                dropdown.classList.remove('open');
            }
        });
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown')) {
            closeAllDropdowns();
        }
    });
});
