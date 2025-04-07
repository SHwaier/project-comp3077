/**
 * Login script for the eStore application.
 * This script handles the login form submission, sends the credentials to the server,
 */
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    const errorMsg = document.getElementById('login-error');

    form.addEventListener('submit', async (e) => {
        e.preventDefault(); // consume default submit, basically preventing weird behavior cz of the default action

        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value;

        try {
            const res = await fetch('/estore/api/auth/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username, password })
            });

            const data = await res.json();

            if (!res.ok) {
                // Handle backend error
                errorMsg.textContent = data.error || "Login failed. Please try again.";
                errorMsg.style.display = 'block';
                return;
            }

            if (data.token) {
                // Store token and redirect
                localStorage.setItem('Token', data.token);
                window.location.href = '/estore'; // Redirect to homepage
            } else {
                errorMsg.textContent = "Unexpected response.";
                errorMsg.style.display = 'block';
            }

        } catch (err) {
            console.error(err);
            errorMsg.textContent = "Something went wrong. Please try again later.";
            errorMsg.style.display = 'block';
        }
    });
});
