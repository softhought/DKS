$(document).ready(function(){



var basepath =$("#basepath").val();



var total_amt = $("#total_amt").val();
var total_subscription_amt = $("#total_subscription_amt").val();
var total_turnament_amt = $("#total_turnament_amt").val();
var total_opening_amt = $("#total_opening_amt").val();

 $("#total_amount_value").html(total_amt);
 $("#total_turna_value").html(total_turnament_amt);
 $("#total_subcrp_value").html(total_subscription_amt);
 $("#total_opining_value").html(total_opening_amt);





  

// $('.datepicker').datepicker({

//     format: 'dd/mm/yyyy',

//     autoclose: true

    

// });



var startDate = new Date($("#acstartDate").val());

var endDate = new Date($("#acendDate").val());

  

$('.datepicker').datepicker({

    format: 'dd/mm/yyyy',

    autoclose: true,

    startDate: startDate,

    endDate: endDate,

    orientation: 'bottom'

    

});





  



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





$(document).on('click','#listshowbtn',function(){

  var from_dt = $('#from_dt').val();

  var to_date = $('#to_date').val();

  var billstyle = $('#billstyle').val();

  var studcode = $('#studcode').val();



  $("#bill_list_details").html('');

  $("#loaderbtn").css('display','block');



    $.ajax({

           type: "POST",

           url: basepath+'billgeneratetennis/generatelistpartialview',

           dataType: "html",

           data: {from_dt:from_dt,to_date:to_date,billstyle:billstyle,studcode:studcode},

            success: function(data) { 

              

                $("#loaderbtn").css('display','none');

                $("#bill_list_details").html(data);

  

               $('.dataTable').DataTable();

               var total_amt = $("#partial_total_amt").val();

              

              var total_subscription_amt = $("#total_subscription_amt").val();
              var total_turnament_amt = $("#total_turnament_amt").val();
              var total_opening_amt = $("#total_opening_amt").val();

                $("#total_amount_value").html(total_amt);
               $("#total_turna_value").html(total_turnament_amt);
               $("#total_subcrp_value").html(total_subscription_amt);
               $("#total_opining_value").html(total_opening_amt);


           

            }



     });

 

})




$(document).on('click', ".delBill", function(e) {
  e.preventDefault();

  //alert($(this).data("billid"));

  var checkstr =  confirm('are you sure you want to delete this?');
    if(checkstr == true){
     //alert($(this).data("billid"));

     var billid=$(this).data("billid");
           $.ajax({
           type: "POST",
           url: basepath+'billgeneratetennis/deleteBill',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
           data: {billid:billid},

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




 $(document).on('click', "#billprintbtn", function(e) {

        e.preventDefault();

        var basepath = $('#basepath').val();

        if (1) {
         
            $('#billGenListFrom').prop('action', basepath+'billgeneratetennis/getBillGenerateListPrint');
            $("#billGenListFrom").submit();

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







