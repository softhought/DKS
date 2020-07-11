$(document).ready(function(){

 var basepath = $("#basepath").val();

//check duplicate 
$(document).on('keyup','#item_name',function(e){
  e.preventDefault();

  $("#baritemsavebtn").attr('disabled',false);   
  $("#errormsg").text('');
  var item_name = $(this).val();
  var validitem_name = $('#validitem_name').val();
  var mode = $('#mode').val();

  
   $.ajax({
       type: "POST",
       url:basepath+'baritemgroupmaster/checkduplicat',
       data:{item_name:item_name},
       dataType: 'json',
       success: function(result) {

        if(result.msg_status == 1){
            
            if(mode == 'ADD'){

              $("#errormsg").text(result.msg_data);
              $("#baritemsavebtn").attr('disabled',true);	
            }else{
               
                if(item_name.toUpperCase() != validitem_name){

                   $("#errormsg").text(result.msg_data);
                   $("#baritemsavebtn").attr('disabled',true);		

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




 
 //form submit

 $(document).on('submit','#baritemsgroupFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(validateform())
        {   

            var formDataserialize = $("#baritemsgroupFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
            $("#baritemsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
            $.ajax({
                    type: "POST",
                    url: basepath+'baritemgroupmaster/baritems_action',
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    data: formData,
                    
                    success: function (result) {
                        
                        if (result.msg_status == 1) {
                            if(mode == 'EDIT'){
                            $("#baritemsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href=basepath+'baritemgroupmaster';
                            //showMsg();

                            }else{

                            $("#errormsg").removeClass('errormsgcolor');
                            $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                            $("#baritemsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            $('#item_name').val('');                    
                            

                            }

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


})

function validateform (){

    var item_name = $('#item_name').val();
   
    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    $('#errormsg').text();

	if(item_name == ''){

	  $('#errormsg').text('Enter Bar Item Name');
	  $("#item_name").focus();
	  return false;	  

	}

	return true;
}