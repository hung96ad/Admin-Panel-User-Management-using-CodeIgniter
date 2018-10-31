/**
 * File : signup.js
 *
 * This file contain the validation of add user form
 *
 * Using validation plugin : jquery.validate.js
 *
 * @author Kishor Mali
 */

$(document).ready(function(){

    var addUserForm = $("#signup");

    var validator = addUserForm.validate({

        rules:{
            email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },
            password : { required : true, minlength : 8, },
            cpassword : {required : true, equalTo: "#password"},
        },
        messages:{
            email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
            password : { required : "This field is required", minlength: "Passwords must be at least 8 characters long"},
            cpassword : {required : "This field is required", equalTo: "Please enter same password" },
        }
    });
});