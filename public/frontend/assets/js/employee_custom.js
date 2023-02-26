$(document).ready(function(){
	$("#verification_employee").on("submit",function(e){
		//alert(1);
		e.preventDefault();
		$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
		$.ajax({
			url:"/employee/verify",
			  type:'post',

			  data:new FormData(this),
			  processData: false,
			  contentType: false,
			  cache:false,
			  success: function(data){
			  	if(data.status == 'success')
			  	{
			  		$('#verification_employee').hide();
			  		$('#register_employee').show();
			  	}
			  	else
			  	{
			  		$('#verification_employee').show();

			  	}

			  }
		});
	});
});