function togglePass() {
    const input = document.getElementById('loginPass');
    input.type = input.type === 'password' ? 'text' : 'password';
}