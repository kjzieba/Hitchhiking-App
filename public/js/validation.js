const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]')
const repeatedPasswordInput = form.querySelector('input[name="password-repeat"]')
const passwordInput = form.querySelector('input[name="password"]')

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordsEqual(password, repeatedPassword) {
    return password === repeatedPassword;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('not-valid-input') : element.classList.remove('not-valid-input');
}

function validateEmail() {
    setTimeout(function () {
            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000);
}

function validatePasswords() {
    setTimeout(function () {
            const condition = arePasswordsEqual(
                repeatedPasswordInput.previousElementSibling.value,
                repeatedPasswordInput.value
            )
            markValidation(repeatedPasswordInput, condition);
        },
        1000);
}


emailInput.addEventListener('keyup', validateEmail);
repeatedPasswordInput.addEventListener('keyup', validatePasswords);