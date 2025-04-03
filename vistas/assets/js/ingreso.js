   // Validación de formulario para email y password
   document.addEventListener('DOMContentLoaded', function() {
    // Elementos del formulario
    const form = document.querySelector('form');
    const emailInput = document.querySelector('input[name="email"]');
    const emailConfirmInput = document.querySelector('input[name="email2"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const passwordConfirmInput = document.querySelector('input[name="password2"]');
    
    // Expresiones regulares para validación
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    // Función para mostrar errores
    function showError(input, message) {
        const formControl = input.closest('.mb-3');
        let errorElement = formControl.querySelector('.error-message');
        
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'error-message text-danger mt-1 small';
            formControl.appendChild(errorElement);
        }
        
        errorElement.textContent = message;
        input.classList.add('is-invalid');
    }
    
    // Función para limpiar errores
    function clearError(input) {
        const formControl = input.closest('.mb-3');
        const errorElement = formControl.querySelector('.error-message');
        
        if (errorElement) {
            errorElement.remove();
        }
        
        input.classList.remove('is-invalid');
    }
    
    // Validación de email
    function validateEmail() {
        const email = emailInput.value.trim();
        const emailConfirm = emailConfirmInput.value.trim();
        let isValid = true;
        
        // Validar formato de email
        if (!emailRegex.test(email)) {
            showError(emailInput, 'Por favor ingresa un email válido');
            isValid = false;
        } else {
            clearError(emailInput);
        }
        
        // Validar coincidencia de emails
        if (email !== emailConfirm) {
            showError(emailConfirmInput, 'Los emails no coinciden');
            isValid = false;
        } else {
            clearError(emailConfirmInput);
        }
        
        return isValid;
    }
    
    // Validación de contraseña
    function validatePassword() {
        const password = passwordInput.value;
        const passwordConfirm = passwordConfirmInput.value;
        let isValid = true;
        
        // Validar longitud mínima
        if (password.length < 6) {
            showError(passwordInput, 'La contraseña debe tener al menos 6 caracteres');
            isValid = false;
        } else {
            clearError(passwordInput);
        }
        
        // Validar coincidencia de contraseñas
        if (password !== passwordConfirm) {
            showError(passwordConfirmInput, 'Las contraseñas no coinciden');
            isValid = false;
        } else {
            clearError(passwordConfirmInput);
        }
        
        return isValid;
    }
    
    // Validación completa del formulario
    function validateForm() {
        const isEmailValid = validateEmail();
        const isPasswordValid = validatePassword();
        return isEmailValid && isPasswordValid;
    }
    
    // Event listeners para validación en tiempo real
    emailInput.addEventListener('blur', validateEmail);
    emailConfirmInput.addEventListener('input', function() {
        if (emailInput.value.trim() !== '') {
            validateEmail();
        }
    });
    
    passwordInput.addEventListener('input', function() {
        if (passwordInput.value.length > 0) {
            validatePassword();
        }
    });
    
    passwordConfirmInput.addEventListener('input', function() {
        if (passwordInput.value !== '' || passwordConfirmInput.value !== '') {
            validatePassword();
        }
    });
    
    // Validación al enviar el formulario
    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
            // Mostrar primer paso si hay errores
            const firstTab = document.querySelector('#pills-gen-info-tab');
            if (firstTab) {
                firstTab.click();
            }
        }
    });
    
    // Validación para el botón "Siguiente" del primer paso
    const nextButton = document.querySelector('[data-nexttab="pills-info-desc-tab"]');
    if (nextButton) {
        nextButton.addEventListener('click', function(event) {
            if (!validateForm()) {
                event.preventDefault();
                event.stopPropagation();
                
                // Mostrar mensaje general de error
                const generalError = document.querySelector('#general-error') || 
                    document.createElement('div');
                generalError.id = 'general-error';
                generalError.className = 'alert alert-danger mt-3';
                generalError.textContent = 'Por favor corrige los errores en el formulario antes de continuar';
                
                if (!document.querySelector('#general-error')) {
                    form.prepend(generalError);
                }
            }
        });
    }
    
    // Limpiar errores generales al hacer cambios
    form.addEventListener('input', function() {
        const generalError = document.querySelector('#general-error');
        if (generalError) {
            generalError.remove();
        }
    });
});