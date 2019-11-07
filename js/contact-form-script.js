$("#contactForm").validator().on("submit", function(event) {

    var googleResponse = jQuery('#g-recaptcha-response').val();
    if (!googleResponse) {
        $('<p class="help-block with-errors">Please prove you are not a robot.</p>" ').insertAfter("#html_element");

        return false;
    } else {
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            formError();
            submitMSG(false, "There seems to be an error, please check the details you have entered");
        } else {
            // everything looks good!
            event.preventDefault();
            submitForm();
        }
    }
});

function isHuman() {

}


function submitForm() {
    // Initiate Variables With Form Content
    var name = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var msg_subject = $("#msg_subject").val();
    var message = $("#message").val();


    $.ajax({
        type: "POST",
        url: "form-process.php",
        data: "name=" + name + "&phone=" + phone + "&email=" + email + "&msg_subject=" + msg_subject + "&message=" + message,
        success: function(text) {
            if (text == "success") {
                formSuccess();
            } else {
                formError();
                submitMSG(false, text);
            }
        }
    });
}

function formSuccess() {
    $("#contactForm")[0].reset();
    submitMSG(true, "Message sent, thank you! We will be in touch ASAP")
}

function formError() {
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        $(this).removeClass();
    });
}

function submitMSG(valid, msg) {
    if (valid) {
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}