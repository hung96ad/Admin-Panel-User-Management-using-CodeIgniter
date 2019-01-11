/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".delete_student", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "hust/delete_student",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) {
					alert("User successfully deleted");
					location.reload();
                }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
