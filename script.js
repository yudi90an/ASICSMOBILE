document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const errorMessage = document.getElementById('error-message');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Kirim data login ke server
        fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, password }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect pengguna ke halaman setelah login sukses
                window.location.href = 'dashboard.php';
            } else {
                errorMessage.textContent = data.message;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
