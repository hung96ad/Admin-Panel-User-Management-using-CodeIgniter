/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addUserForm = $("#addUser");
	
	var validator = addUserForm.validate({
		
		rules:{
			fname :{ required : true },
            dept_name : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "This field is required" },
            dept_name : { required : "This field is required", selected : "Please select atleast one option" }
		}
	});
});
