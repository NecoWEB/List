$(document).ready(function(){
    $("#forgot-password").click(function(){
      $("#forgot_password_form").show();
      $('#login-form').hide();
    });

    $(".go-back").click(function(){
        $("#forgot_password_form").hide();
        $('#login-form').show();
      });
});

const emailElForgot = document.querySelector('#email-forgot');
const formForget = document.querySelector('#forget-form');

const checkEmailForgot = () => {
    let valid = false;
    const email = emailElForgot.value.trim();
    if (!isRequired(email)) {
        showError(emailElForgot, 'Email cannot be blank.');
    } else if (!isEmailValid(email)) {
        showError(emailElForgot, 'Email is not valid.')
    } else {
        showSuccess(emailElForgot);
        valid = true;
    }
    return valid;
};


formForget.addEventListener('submit', function (e) {
    // prevent the form from submitting
    e.preventDefault();

    // validate fields
    let isEmailValid = checkEmailForgot();

    let isFormValid = isEmailValid;

    // submit to the server if the form is valid
    if (isFormValid) {
        this.submit();
    }
});


const debounceForgot = (fn, delay = 500) => {
    let timeoutId;
    return (...args) => {
        // cancel the previous timer
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        // setup a new timer
        timeoutId = setTimeout(() => {
            fn.apply(null, args)
        }, delay);
    };
};

formForget.addEventListener('input', debounceForgot(function (e) {
    switch (e.target.id) {
        case 'email-forgot':
            checkEmailForgot();
            break;
    }
}));