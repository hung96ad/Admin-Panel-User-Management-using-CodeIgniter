/**
 * File : editUser.js 
 * 
 * This file contain the validation of edit user form
 * 
 * @author Kishor Mali
 */
$(document).ready(function(){
	
	var editUserForm = $("#editUser");
	
	var validator = editUserForm.validate({

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