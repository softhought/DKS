$(document).ready(function(){



  var basepath = $("#basepath").val();

  var startDate = new Date($("#acstartDate").val());

  var endDate = new Date($("#acendDate").val());

  

  

  $('.datepicker').datepicker({

    format: 'dd/mm/yyyy',

    startDate: startDate,

    endDate: endDate

    

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




$(document).on('click', ".delReceipt", function(e) {
  e.preventDefault();

  //alert($(this).data("paymentid"));exit;

  var checkstr =  confirm('are you sure you want to delete this?');
    if(checkstr == true){
     //alert($(this).data("billid"));

     var paymentid=$(this).data("paymentid");
           $.ajax({
           type: "POST",
           url: basepath+'deletedata/deleteTennisReceipt',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
           data: {paymentid:paymentid},

            success: function(data) { 

             if (data.msg_status==1) {
              
                 location.reload(); 

             }else{

                  alert(data.msg_data);

             }


            },

            complete: function() {

            },

            error: function(e) {
                //called when there is an error
                console.log(e.message);
            }

        });


    }else{
    return false;
    }


});





});// end of document ready