$(document).ready(function(){
    var basepath =$("#basepath").val();

    $("#monthblock,#quarterblock").hide();
    // $("#student_id").select2({
    //     multiple: true,
    // });

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
        
    });

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
    $(document).on('click', "#billprintbtn", function(e) {
        e.preventDefault();

        //    $("#response_msg").html("");
       if (validateBillGenerate()) { 
            var billing_style =$("#billing_style").val();
            var QM="";
            if(billing_style=='M')
            {
                QM =$("#month").val();
            }else if(billing_style=='Q'){
                QM =$("#quarter_month").val();
            }            
            var student_id =$("#student_id").val();
           
            var URL= basepath+'billprint/billPrintPdf/'+billing_style+'/'+QM+'/'+encodeURIComponent(student_id);
            var w=window.open(URL,'_blank');
            $(w.document).find('html').append('<head><title>Bill Print</title></head>');
    }

      
    });
});// end of document ready 



function validateBillGenerate(){
  
    var billing_style =$("#billing_style").val();
    var bill_dt =$("#bill_dt").val();
    var studentId =$("#student_id option:selected").val();
    console.log(studentId);

    $("#errormsg").text("");
    $("#billing_styleerr,#bill_dterr,#student_id,#montheerr,#quarter_montherr").removeClass("form_error");

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
     if (studentId==0 || studentId==null ) {
        $("#student_drp").css({"border": "1px solid red"});
           return false;
    }

 return true;
}


function resetStudentDropdown(billing_style){

    var basepath = $("#basepath").val();

    $.ajax({
            type: "POST",
            url: basepath+'billprint/getStudentList',
            dataType: "html",
            data: {billing_style:billing_style},
            success: function (result) {
         

              
             $("#student_id").html(result);

             $('.selectpicker').selectpicker();
             $('.selectpicker').selectpicker('refresh');
         
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

