$(document).ready(function() {

    var basepath = $('#basepath').val();
    var startDate = new Date($("#acstartDate").val());

  	var endDate = new Date($("#acendDate").val());

      var total_amt = $("#total_amt").val();
    $("#total_amount_value").html(total_amt);

  

  $('.datepicker').datepicker({

    format: 'dd/mm/yyyy',
    orientation: 'bottom',

    startDate: startDate,

    endDate: endDate

    

 });





    $(document).on('click', "#receiptlistshowbtn", function(e) {
        e.preventDefault();


        var from_dt = $("#from_dt").val();
        var to_date = $("#to_date").val();
        var payment_mode = $("#payment_mode").val();


        if (1) {
            $('#receipt_list_data').html('');
            $("#loader").show();

            $.ajax({
                type: "POST",
                url: basepath + 'dailyreceipttennis/getTennisReceiptListByDate',
                dataType: "html",
                data: { from_dt: from_dt, to_date: to_date, payment_mode: payment_mode },

                success: function(result) {
                    $("#loader").hide();
                    $("#receipt_list_data").html(result);
                    $(".dataTable").DataTable();
                    var total_amt = $("#total_amt").val();
                    $("#total_amount_value").html(total_amt);
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




  $(document).on('click', "#dailyprintbtn", function(e) {

        e.preventDefault();

        var basepath = $('#basepath').val();

        if (1) {
         
            $('#tennisDailyBalanceFrom').prop('action', basepath+'dailyreceipttennis/getDailyPaymentDetailstPrint');
            $("#tennisDailyBalanceFrom").submit();

        }


   });








}); // end of class


