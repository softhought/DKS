$(document).ready(function(){

	var basepath =$('#basepath').val();

    $('#department').on('change', function(e) {
        e.preventDefault();

        var department = $("#department").val();
        

       //  resetEmployeeList(department);
        

    });


$(document).on('change','#department',function(e){

        e.preventDefault();
        $("#salaryprocessbtn").attr('disabled',false);   
        $("#errormsg").text('');
        var department = $.trim($(this).val());
      
        var mode = $('#mode').val();
   
      if(department!=''){
         $("#salaryprocessbtn").attr('disabled',true);  
       $.ajax({
           type: "POST",
           url:basepath+'Salaryprocess/checkexistanceDeptComponentWiseAccount',
           data:{department:department},
           dataType: 'json',
           success: function(result) {
   
            if(result.msg_status == 0){

               $("#errormsg").text(result.msg_data);
               $("#salaryprocessbtn").attr('disabled',true);  
                
                
            }else{
              $("#salaryprocessbtn").attr('disabled',false);  
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
   
       }
   
    });

	


 // generate bill tennis
$(document).on('click', "#salaryprocessbtn", function(e) {
        e.preventDefault();

       $("#response_msg").html("");
       if (validateSalaryProcess()){ 
       		

            var formDataserialize = $("#salaryProcessFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            console.log("formData");
          
           $("#response_msg").html("Processing please wait...");

           $.ajax({
           type: "POST",
           url: basepath+'salaryprocess/salaryProcessAction',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
           data: formData,
            success: function(data) { 
             
             if (data.msg_status==1) {
               $("#response_msg").html(data.msg_data);
              // $("#student_list").html("");
              // $('#membillGenerateFrom').trigger("reset");
             }else{
               $("#response_msg").html(data.msg_data);
             }
            
           
            },
            complete: function() {
                // $("#stock_loader").hide();

            },
            error: function(e) {
                //called when there is an error
                console.log(e.message);
            }

        });


 


    }

      
    });




}); // end of document ready



function validateSalaryProcess(){
  
       var month =$("#month").val();
       var department =$("#department").val();
       var cash_bank_ac =$("#cash_bank_ac").val();

       console.log(month);

       $("#errormsg").text("");
       $("#montheerr,#departmenterr,#cash_bank_acerr").removeClass("form_error");

       if (month=='') {
           $("#montheerr").addClass("form_error");
              return false;
       }

      if (department=='') {
           $("#departmenterr").addClass("form_error");
              return false;
      }

      if (cash_bank_ac=='') {
           $("#cash_bank_acerr").addClass("form_error");
              return false;
      }



    return true;
}


function resetEmployeeList(department) {

    var basepath = $("#basepath").val();

    $.ajax({
        type: "POST",
        url: basepath + 'salaryprocess/resetEmployeeList',
        dataType: "html",
        data: { department: department },
        success: function(result) {

            $("#emp_drp").html(result);
            $('.select2').select2();

        },
        error: function(jqXHR, exception) {
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




}



