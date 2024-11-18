import './bootstrap';

// Jelszó megjelenítés funkció
document.addEventListener('DOMContentLoaded', () => {
    const showPasswordCheckbox = document.getElementById('showPassword');
    if (showPasswordCheckbox) {
        showPasswordCheckbox.addEventListener('change', function () {
            const passwordField = document.getElementById('password');
            if (passwordField) {
                passwordField.type = this.checked ? 'text' : 'password';
            }
        });
    }
});
