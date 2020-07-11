$(document).ready(function(){

var basepath = $('#basepath').val();

$("#resetgstform").click(function(){

   $("#gstType").val('').change();
   $("#accountid").val('').change();
   $("#usedfor").val('').change();

 });

  $('.number_only').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9\.]/g, '');

  });

//form submit

$(document).on('submit','#gstFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(validateform())
        {   

            var formDataserialize = $("#gstFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#gstsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'gstmaster/gstmaster_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    
                    if (result.msg_status == 1) {

                    	if(mode == 'EDIT'){


                    	 $("#gstsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'gstmaster';
                         //showMsg();

                    	}else{

                    	 $("#errormsg").removeClass('errormsgcolor');
                         $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                         $("#gstsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         $('#gstrate').val('');                    
                         $('#gstdescription').val('');                    
                        $("#gstType").val('').change();
					              $("#accountid").val('').change();
					              $("#usedfor").val('').change();

                    	}

                                             
                  
                    } 
                    else {
                     
                    }
                   
                   
                }, 
                error: function (jqXHR, exception) {
                  var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                   // alert(msg);  
                }
            }); /*end ajax call*/
               	

        }   // end master validation

       
    });




});


function deletegst(id) {

  var basepath = $("#basepath").val();
  
      Swal.fire({
      title: 'Are you sure?',
      // text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
  
         $.ajax({
                type: "POST",
                url: basepath+'gstmaster/deletegstmaster',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: {id:id},
                
                success: function (result) {

                    window.location.href=basepath+'gstmaster';
                                    
                }, 
                error: function (jqXHR, exception) {
                  var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                   // alert(msg);  
                }
            }); /*end ajax call*/

                // Swal.fire(
        //   'Deleted!',
        //   'Your file has been deleted.',
        //   'success'
        // )
      }
    })

}  





function validateform(){

	var gstdescription = $('#gstdescription').val();
	var gstType = $('#gstType').val();
	var gstrate = $('#gstrate').val();
	var accountid = $('#accountid').val();
	var usedfor = $('#usedfor').val();

  $("#errormsg").removeClass('succmsg');
     $("#errormsg").addClass('errormsgcolor');
  $('#errormsg').text();

	if(gstdescription == ''){

	  $('#errormsg').text('Enter GST Description Name');
	  $("#gstdescription").focus();
	  return false;
	  

	}else if(gstType == ''){

      $('#errormsg').text('Select GST Type');
      $("#gstType").focus();
      return false;

	}else if(gstrate == ''){
		$('#errormsg').text('Enter GST Rate');
		$("#gstrate").focus();
		return false;

	}else if(accountid == ''){
		$('#errormsg').text('Select Account');
		$("#accountid").focus();
		return false;

	}
	else if(usedfor == ''){
		$('#errormsg').text('Select Input/Output');
		$("#usedfor").focus();
		return false;

	}

	return true;
}

