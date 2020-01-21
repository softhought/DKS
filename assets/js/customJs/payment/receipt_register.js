$(document).ready(function(){

var basepath = $("#basepath").val();
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy'
    
});

 var total_amt = $("#total_amt").val();
 $("#total_amount_value").html(total_amt);
// show correction list using from and to date


$(document).on('click', "#billshowbtn", function(e) {
        e.preventDefault();


 var from_dt = $("#from_dt").val();
 var to_date = $("#to_date").val();
 var tran_type = $("#tran_type").val();

  if(1){

   $.ajax({
                type: "POST",
                url: basepath+'receiptregister/getallcorrectionbydate',
                dataType: "html",
                data: {from_dt:from_dt,to_date:to_date,tran_type:tran_type},
                
                success: function (result) {

                     $("#bill_list_details").html(result);
                     $(".dataTable").DataTable();
                   var total_amt = $("#total_amt").val();
                   $("#total_amount_value").html(total_amt);
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

});


});// end of document ready