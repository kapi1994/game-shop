$(document).ready(function () {
  const reFirstLastName =
    /^[A-ZŠĐČĆŽ][a-zšđžčć]{3,15}(\s[A-ZČŠĐĆŽ][a-zčćšđž]{3,15})?$/;
  const reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
  const rePassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;

  $("#btnRegister").click(function (e) {
    e.preventDefault();
    let first_name = $("#first_name").val();
    let last_name = $("#last_name").val();
    let email = $("#email").val();
    let password = $("#password").val();

    if (registerFormValidation().length == 0) {
      $.ajax({
        type: "post",
        url: "models/auth/register.php",
        data: { first_name, last_name, email, password },
        dataType: "json",
        success: function (response) {
          window.location.href = "index.php?page=login";
        },
        error: function (jqXHR, statusTxt, xhr) {
          createResponseMessages(
            "danger",
            jqXHR.responseJSON,
            "register_response_messages"
          );
        },
      });
    }
  });

  $("#btnLogIn").click(function (e) {
    e.preventDefault();
    let email = $("#email").val();
    let password = $("#password").val();
    if (loginFormValidation().length == 0) {
      $.ajax({
        type: "post",
        url: "models/auth/login.php",
        data: { email, password },
        dataType: "json",
        success: function (response) {
          if (response == 1) {
            window.location.href = "index.php";
          } else {
            window.location.href = "admin.php";
          }
        },
        error: function (jqXHR, statusTxt, xhr) {
          createResponseMessages(
            "danger",
            jqXHR.responseJSON,
            "login_response_messages"
          );
        },
      });
    }
  });

  function registerFormValidation() {
    let first_name = $("#first_name").val();
    let last_name = $("#last_name").val();
    let email = $("#email").val();
    let password = $("#password").val();

    let errors = [];
    validainteInputElement(
      first_name,
      reFirstLastName,
      errors,
      "first_name_error",
      "First name isn't ok!"
    );
    validainteInputElement(
      last_name,
      reFirstLastName,
      errors,
      "last_name_error",
      "Last name isn't ok!"
    );
    validainteInputElement(
      email,
      reEmail,
      errors,
      "email_error",
      "Email isn't ok!"
    );
    validainteInputElement(
      password,
      rePassword,
      errors,
      "password_error",
      "Password isn't ok!"
    );

    return errors;
  }
  function loginFormValidation() {
    let email = $("#email").val();
    let password = $("#password").val();

    let errors = [];
    validainteInputElement(
      email,
      reEmail,
      errors,
      "email_error",
      "Email isn't ok!"
    );
    validainteInputElement(
      password,
      rePassword,
      errors,
      "password_error",
      "Password isn't ok"
    );
    return errors;
  }
});
