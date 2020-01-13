$(document).ready(function(){

var basepath =$("#basepath").val();

$("#monthblock,#quarterblock").hide();


   $('#billing_style').on('change',function(e){
        e.preventDefault();

        var billing_style =$("#billing_style").val();
        $("#monthblock,#quarterblock").hide();
      	if (billing_style=='M') {
      		$("#monthblock").show();
      	}else if (billing_style=='Q') {
      		$("#quarterblock").show();
      	}
         resetStudentDropdown(billing_style);

   });


    // generate bill tennis
    $(document).on('click', "#billgeneratebtn", function(e) {
        e.preventDefault();

           $("#response_msg").html("");
       if (validateBillGenerate()) { 
            var formDataserialize = $("#billGenerateFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };

            console.log("formData");
         
     
           $("#intraturnamentfeeApplybtn").hide();
          
           $("#response_msg").html("Processing please wait...");
        $.ajax({
           type: "POST",
           url: basepath+'billgeneratetennis/generateBillAction',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: formData,
            success: function(data) { 
             
             if (data.msg_status==1) {
               $("#response_msg").html(data.msg_data);
               $("#student_list").html("");
               $('#interTournamentFrom').trigger("reset");
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


function validateBillGenerate(){
  
       var billing_style =$("#billing_style").val();
       var bill_dt =$("#bill_dt").val();
       console.log(billing_style);

       $("#errormsg").text("");
       $("#billing_styleerr,#bill_dterr,#montheerr,#quarter_montherr").removeClass("form_error");

       var billing_style =$("#billing_style").val();

       if (billing_style=='') {
           $("#billing_styleerr").addClass("form_error");
              return false;
       }

       if (bill_dt=='') {
           $("#bill_dterr").addClass("form_error");
              return false;
       }

       if (billing_style=='M') {
             var month =$("#month").val();
             if (month=='') {
             $("#montheerr").addClass("form_error");
             return false;
             }         
        }else if (billing_style=='Q') {
            var quarter_month =$("#quarter_month").val();
            if (quarter_month=='') {
            $("#quarter_montherr").addClass("form_error");
             return false;
            }        
        }

    return true;
}


function resetStudentDropdown(billing_style){

    var basepath = $("#basepath").val();

    $.ajax({
            type: "POST",
            url: basepath+'billgeneratetennis/resetStudentList',
            dataType: "html",
            data: {billing_style:billing_style},
            success: function (result) {
         

              
             $("#student_drp").html(result);

            // $('.select2').select2();
          
         
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




}



