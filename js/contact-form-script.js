$("#contactForm")
  .validator()
  .on("submit", function (event) {
    if (event.isDefaultPrevented()) {
      formError();
      // Usa una clave para identificar el mensaje
      submitMSG(false, "formInvalid");
    } else {
      event.preventDefault();
      submitForm();
    }
  });
function submitForm() {
  var name = $("#name").val();
  var email = $("#email").val();
  var msg_subject = $("#msg_subject").val();
  var budget = $("#budget").val();
  var message = $("#message").val();
  $.ajax({
    type: "POST",
    url: "php/form-process.php",
    data:
      "name=" +
      name +
      "&email=" +
      email +
      "&msg_subject=" +
      msg_subject +
      "&budget=" +
      budget +
      "&message=" +
      message,
    success: function (text) {
      if (text == "success") {
        formSuccess();
      } else {
        formError();
        submitMSG(false, "formInvalid");
      }
    },
  });
}
function formSuccess() {
    $("#contactForm")[0].reset();
    // Usa otra clave para el mensaje de éxito
    submitMSG(true, "messageSubmitted");
  }
function formError() {
  $("#contactForm")
    .removeClass()
    .addClass("shake animated")
    .one(
      "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
      function () {
        $(this).removeClass();
      }
    );
}
function submitMSG(valid, msg) {
  if (valid) {
    var msgClasses = "h3 text-center tada animated text-success";
  } else {
    var msgClasses = "h3 text-center text-danger";
  }
  $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}
function submitMSG(valid, msgKey) {
   
    var lang = localStorage.getItem('selectedLanguage') || 'en';

    var msg = traducciones[msgKey] ? traducciones[msgKey][lang] : "Mensaje no definido";

    var msgClasses;

    if (valid) {
      msgClasses = "h3 text-center tada animated text-success";
    } else {
      msgClasses = "h3 text-center text-danger";
    }

    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}
