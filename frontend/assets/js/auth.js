document.addEventListener('DOMContentLoaded', () => {
    // Gestion login
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(loginForm);
            const response = await fetch('../../backend/api/auth/login.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(Object.fromEntries(formData))
            });

            const data = await response.json();
            if (response.ok) {
                localStorage.setItem('user', JSON.stringify(data.user));
                window.location.href = 'chat.html'; // Page à créer
            } else {
                alert(data.error || 'Erreur de connexion');
            }
        });
    }

    // Gestion register
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(registerForm);
            const response = await fetch('../../backend/api/auth/register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(Object.fromEntries(formData))
            });

            const data = await response.json();
            if (response.status === 201) {
                alert(data.message);
                window.location.href = 'login.html';
            } else {
                alert(data.error || 'Erreur lors de l\'inscription');
            }
        });
    }
});