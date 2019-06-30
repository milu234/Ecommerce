
$(document).ready(function(){

	$("#current_pwd").keyup(function(){
		var current_pwd = $("#current_pwd").val();
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				// alert(resp);
				if(resp == "false"){
					$("#chkPwd").html("<font color = 'red'>Current Password is Incorrect</font>");
				}else if(resp == "true"){
					$("#chkPwd").html("<font color = 'green'>Current Password is Correct</font>");
				}

			},error:function(){
				alert("Error");
			}
		});
	});
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


	// Add Category Validation
	$("#add_category").validate({
		rules:{
			category_name:{
				required: true,
				
			},
			description:{
				required:true,
			
			},
			url:{
				required:true,
				
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// Edit Category Validation
	$("#edit_category").validate({
		rules:{
			category_name:{
				required: true,
				
			},
			description:{
				required:true,
			
			},
			url:{
				required:true,
				
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
 

	
	
	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},

			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},


			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


	



	// *********************************************Products*******************************************************

	// Add Category Validation
	$("#add_product").validate({
		rules:{
			category_id:{
				required: true,
				
			},

			//Product Name
			product_name:{
				required: true,

			},

			//Product code Validation
			product_code:{
				required:true,	
			},

			//Product color
			product_color:{
				required:true,
			},

			//Product Description
			product_description:{
				required:true,
			},

			//Product Price
			price:{
				number:true,
				required:true
			},

			//P
			// description:{
			// 	required:true,
			
			// },
			image:{
				required:true,
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});










	///////////////////////////////Edit Products Validation////////////////////////////////////////////


	$("#edit_product").validate({
		rules:{
			category_id:{
				required: true,
				
			},

			//Product Name
			product_name:{
				required: true,

			},

			//Product code Validation
			product_code:{
				required:true,	
			},

			//Product color
			product_color:{
				required:true,
			},

			//Product Description
			product_description:{
				required:true,
			},

			//Product Price
			price:{
				number:true,
				required:true
			},

			//P
			// description:{
			// 	required:true,
			
			// },
			// image:{
			// 	required:true,
			// }
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


	////////////////////////////////Dialogue box///////////////////////////////////////////////////////


	// $("#delProduct").click(function(){
	// 	if(confirm('Are you sure , you want to delete this Product??')){
	// 		return true;

	// 	}
	// 	return false;
	// });


	$(".deleteRecord").click(function(){
		 var id = $(this).attr('rel');
		 var deleteFunction = $(this).attr('rel1');
		 swal({
			 title: "Are you Sure?",
			 text: "You will not be able to recover this record again!!",
			 type: "warning",
			 showCancelButton: true,
			 confirmButtonColor:'#3085d6',
			 cancelButtonColor: '#d33',
			 confirmButtonClass:"btn btn-success",
			 cancelButtonClass:"btn btn-danger",
			 buttonsStyling: false,
			 confirmButtonText: "Yes, delete it!",
			 cancelButtonText:'No , Cancel!',
			 reverseButtons:true

		 },
		 	function(){
				 window.location.href="/admin/"+deleteFunction+"/"+id;
			 });
		
	});





// ************************************************Products**************************************************



});
