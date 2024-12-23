document.addEventListener('DOMContentLoaded', function() {
    const registerButton = document.getElementById("register");
    const loginButton = document.getElementById("login");
    const container = document.getElementById("container-acc");

    // Form transitions
    if(registerButton) {
        registerButton.addEventListener("click", () => {
            container.classList.add("right-panel-active");
        });
    }

    if(loginButton) {
        loginButton.addEventListener("click", () => {
            container.classList.remove("right-panel-active");
        });
    }

    // Add switch to register functionality
    document.querySelector('.overlay-right .ghost').addEventListener('click', () => {
        document.querySelector('.container-acc').classList.add('right-panel-active');
    });

    // Add switch to login functionality
    document.querySelector('.overlay-left .ghost').addEventListener('click', () => {
        document.querySelector('.container-acc').classList.remove('right-panel-active');
    });

    // Add form switching functions
    window.switchToLogin = function() {
        document.querySelector('.container-acc').classList.remove('right-panel-active');
    }

    window.switchToRegister = function() {
        document.querySelector('.container-acc').classList.add('right-panel-active');
    }

    // Make sure registration form is visible by default on larger screens
    if (window.innerWidth > 768) {
        document.querySelector('.register-container').style.display = 'flex';
    }

    // Ensure registration form is visible
    const registerContainer = document.querySelector('.register-container');
    if (registerContainer) {
        registerContainer.style.display = 'block';
        registerContainer.style.opacity = '1';
        registerContainer.style.visibility = 'visible';
    }

    // Make sure signup button is visible
    const signupBtn = document.querySelector('button[name="signup_btn"]');
    if (signupBtn) {
        signupBtn.style.display = 'block';
        signupBtn.style.opacity = '1';
        signupBtn.style.visibility = 'visible';
    }

    // Form validation
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const password = this.querySelector('input[type="password"]');
            const email = this.querySelector('input[type="email"]');
            let isValid = true;

            if (password && password.value.length < 6) {
                alert('Password must be at least 6 characters long');
                isValid = false;
            }

            if (email && !isValidEmail(email.value)) {
                alert('Please enter a valid email address');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    });

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
});