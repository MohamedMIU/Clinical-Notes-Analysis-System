document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editProfileForm');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');

    function showError(input, message) {
        const formGroup = input.parentElement;
        const errorDisplay = formGroup.querySelector('.error-text');
        if (!errorDisplay) {
            const errorDiv = document.createElement('span');
            errorDiv.className = 'error-text';
            errorDiv.textContent = message;
            formGroup.appendChild(errorDiv);
        } else {
            errorDisplay.textContent = message;
        }
        input.classList.add('error-input');
    }

    function removeError(input) {
        const formGroup = input.parentElement;
        const errorDisplay = formGroup.querySelector('.error-text');
        if (errorDisplay) {
            errorDisplay.remove();
        }
        input.classList.remove('error-input');
    }

    function isValidEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@(($$[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$$)|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function isValidPassword(password) {
        const minLength = 8;
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*()\-_=+{};:,<.>]/.test(password);

        return password.length >= minLength && 
               hasUpperCase && 
               hasLowerCase && 
               hasNumbers && 
               hasSpecialChar;
    }

    username.addEventListener('input', function() {
        if (username.value.length < 3) {
            showError(username, 'Username must be at least 3 characters long');
        } else {
            removeError(username);
        }
    });

    email.addEventListener('input', function() {
        if (!isValidEmail(email.value)) {
            showError(email, 'Please enter a valid email address');
        } else {
            removeError(email);
        }
    });

    newPassword.addEventListener('input', function() {
        if (newPassword.value !== '') {
            if (!isValidPassword(newPassword.value)) {
                showError(newPassword, 'Password must be at least 8 characters long and contain uppercase, lowercase, number and special character');
            } else {
                removeError(newPassword);
            }
        } else {
            removeError(newPassword);
        }
    });

    confirmPassword.addEventListener('input', function() {
        if (newPassword.value !== confirmPassword.value) {
            showError(confirmPassword, 'Passwords do not match');
        } else {
            removeError(confirmPassword);
        }
    });

    form.addEventListener('submit', function(e) {
        let isValid = true;

        if (username.value.length < 3) {
            showError(username, 'Username must be at least 3 characters long');
            isValid = false;
        }

        if (!isValidEmail(email.value)) {
            showError(email, 'Please enter a valid email address');
            isValid = false;
        }

        if (newPassword.value !== '') {
            if (!isValidPassword(newPassword.value)) {
                showError(newPassword, 'Password must be at least 8 characters long and contain uppercase, lowercase, number and special character');
                isValid = false;
            }

            if (newPassword.value !== confirmPassword.value) {
                showError(confirmPassword, 'Passwords do not match');
                isValid = false;
            }
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});