$(document).ready(function(){

    basepath = $("#basepath").val();

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

   $(document).on('click', "#listshowbtn", function(e) {
    e.preventDefault();

    var billing_style =$("#billing_style").val();
    var student_id =$("#studid").val();
    if(billing_style=='M')
    {
        QM =$("#month").val();
    }else if(billing_style=='Q'){
        QM =$("#quarter_month").val();
    }  
    if(validateBillGenerate()){
    $('#bill_list_details').html('');
    $("#loaderbtn").show();

    
    $.ajax({
        type: "POST",
        url: basepath + 'studoutstandingreport/getpartiallist',
        dataType: "html",
        data: { billing_style: billing_style, QM: QM,student_id:student_id},

        success: function(result) {
            $("#loaderbtn").hide();
            $("#bill_list_details").html(result);
            $("#printbtn").removeClass('dispnone');
            $("#total_bill_amt").text($("#totalbill_amt").val());
            $("#total_pay_amt").text($("#total_payment_amt").val());
            $("#total_outstandig_amt").text($("#total_outstand_amt").val());
            $(".dataTable").DataTable();

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


});

   
    $(document).on('click', "#printbtn", function(e) {
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
            var student_id =$("#studid").val();
           
            var URL= basepath+'studoutstandingreport/studotstandingreport/'+billing_style+'/'+QM+'/'+student_id;
            var w=window.open(URL,'_blank');
            $(w.document).find('html').append('<head><title>Student Outstanding Report</title></head>');
    }

      
    });

})

function validateBillGenerate(){
  
    
   // var studentId =$("#student_id option:selected").val();
    //console.log(studentId);

    $("#errormsg").text("");
    $("#billing_styleerr,#bill_dterr,#student_id,#montheerr,#quarter_montherr").removeClass("form_error");

    var billing_style =$("#billing_style").val();

    if (billing_style=='') {
        $("#billing_styleerr").addClass("form_error");
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
    //  if (studentId==0 || studentId==null ) {
    //     $("#student_drp").css({"border": "1px solid red"});
    //        return false;
    // }

 return true;
}

function resetStudentDropdown(billing_style){

    var basepath = $("#basepath").val();

    $.ajax({
            type: "POST",
            url: basepath+'studoutstandingreport/resetStudentList',
            dataType: "html",
            data: {billing_style:billing_style},
            success: function (result) {
         

              
             $("#student_drp").html(result);

             $('.select2').select2();
          
         
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