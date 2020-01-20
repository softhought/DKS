$(document).ready(function(){
	
var basepath =$('#basepath').val();



 $(document).on('keyup','#groupname',function(e){

 	e.preventDefault();
     $("#accgroupsavebtn").attr('disabled',false);   
   $("#errormsg").text('');
  var groupname = $(this).val();
  var validgroupname = $('#validgroupname').val();
  var mode = $('#mode').val();

   
    $.ajax({
        type: "POST",
        url:basepath+'accountgroup/checkduplicatgroupname',
        data:{groupname:groupname},
        dataType: 'json',
        success: function(result) {

         if(result.msg_status == 1){
         	
         	if(mode == 'ADD'){

         	  $("#errormsg").text(result.msg_data);
              $("#accgroupsavebtn").attr('disabled',true);	
         	}else{
         		if(groupname.toUpperCase() != validgroupname){

         		   $("#errormsg").text(result.msg_data);
                   $("#accgroupsavebtn").attr('disabled',true);		

         		}
         	}
         	
         }
        
          
        },
        error: function(jqXHR, exception) {
            $('#btnusersaveDiv').css('display','none');
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



 });

 $("#resetgrpform").click(function(){

   $("#gropcat").val('').change();
   $("#subgropucat").val('').change();

 });

 
//form submit

$(document).on('submit','#groupnameFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(valiadtegroupinfo())
        {   

            var formDataserialize = $("#groupnameFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#accgroupsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'accountgroup/groupform_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    
                    if (result.msg_status == 1) {

                    	if(mode == 'EDIT'){


                    	 $("#accgroupsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'accountgroup';
                         //showMsg();

                    	}else{

                    	 $("#errormsg").removeClass('errormsgcolor');
                         $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                         $("#accgroupsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         $('#groupname').val('');                    
                         $('#gropcat').val('').change();                    
                         $('#subgropucat').val('').change();

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


function showMsg(){

	const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
  });
      Toast.fire({
        type: 'success',
        title: 'Update Successfully'
      })



}

function valiadtegroupinfo(){

	var groupname = $('#groupname').val();
	var gropcat = $('#gropcat').val();
	var subgropucat = $('#subgropucat').val();

  $("#errormsg").removeClass('succmsg');
  $("#errormsg").addClass('errormsgcolor');
  $('#errormsg').text();

	if(groupname == ''){

	  $('#errormsg').text('Enter Group Name');
	  $("#groupname").focus();
	  return false;
	  

	}else if(gropcat == ''){

      $('#errormsg').text('Select Group Category');
      $("#gropcat").focus();
      return false;

	}else if(subgropucat == ''){
		$('#errormsg').text('Select Sub Category Name');
		$("#subgropucat").focus();
		return false;

	}

	return true;
}