// CONTACT FORM VALIDATION
//----------------------------------------------------------------------------------------------------------------------
$(document).ready(function() {
// Validate Name Field
//----------------------------------------------------------------------------------------------------------------------
    $("#form_name").on("input", function () {
        // Set variables
        var name = $(this).val();
        var validName = /^[a-zA-Z ]*$/;
        // If field is empty add invalid input class and dont allow the form to be submitted
        if (name.length == 0) {
            $(".name-msg").addClass('invalid').text("You must enter your name.");
            $(this).addClass('invalid-input').removeClass('valid-input');
            // Actions on Submit button
            $('#submit-btn').addClass('deny-submit');
            $("#contactForm").submit(function (){
                preventDefault();
            });
        // If the Name field has anything except alphabetic characters and white space show error and dont allow form submission
        } else if (!validName.test(name)) {
            $(".name-msg").addClass('invalid').text('Only alphabetic characters & whitespace are allowed.');
            $(this).addClass('invalid-input').removeClass('valid-input');
            $('#submit-btn').addClass('deny-submit');
            $("#contactForm").submit(function (){
                preventDefault();
            });
        } else {
            // If there were no errors thrown allow form submission
            $(".name-msg").empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
            $('#submit-btn').removeClass('deny-submit');
        }
    });
// Validate Email Field
//----------------------------------------------------------------------------------------------------------------------
    $("#form_email").on('input', function () {
        // Set variables
        var emailAddress = $(this).val();
        var validEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        // If field is empty add invalid input class, show an error and dont allow the form to be submitted
        if (emailAddress.length == 0) {
            $('.email-msg').addClass('invalid').text('An Email Address is required.');
            $(this).addClass('invalid-input').removeClass('valid-input');
            // Actions on submit button
            $('#submit-btn').addClass('deny-submit');
            $("#contactForm").submit(function (){
                preventDefault();
            });
        // If the email address entered is invalid show error and dont allow submission
        } else if (!validEmail.test(emailAddress)) {
            $('.email-msg').addClass('invalid').text('Invalid Email Address.');
            $(this).addClass('invalid-input').removeClass('valid-input');
            // Actions on submit button
            $('#submit-btn').addClass('deny-submit');
            $("#contactForm").submit(function (){
                preventDefault();
            });
        } else {
            // If there were no errors thrown allow form submission
            $('.email-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
            $('#submit-btn').removeClass('deny-submit');
        }
    });
// Validate Message Field
//----------------------------------------------------------------------------------------------------------------------
    $("#form_message").on('input', function () {
        var msg = $(this).val();
        var validMsg = /[!@#$%^&*()_+\-=[\];'\/<>?:"{}_+\|0-9]/;
        if (msg.length == 0) {
            $('.msg-msg').addClass('invalid').text('Cant send a blank message.');
            $(this).addClass('invalid-input').removeClass('valid-input');
            // Actions on submit button
            $('#submit-btn').addClass('deny-submit');
            $("#contactForm").submit(function (){
                preventDefault();
            });
        } else if (validMsg.test(msg)) {
            $('.msg-msg').addClass('invalid').text('Message cannot contain special characters or numbers.');
            $(this).addClass('invalid-input').removeClass('valid-input');
            // Actions on submit button
            $('#submit-btn').addClass('deny-submit');
            $("#contactForm").submit(function (){
                preventDefault();
            });
        } else {
            $('.msg-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
            $('#submit-btn').removeClass('deny-submit');
        }
    });
});
