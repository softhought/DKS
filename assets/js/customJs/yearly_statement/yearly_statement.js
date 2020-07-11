$(document).ready(function() {

var basepath = $('#basepath').val();

$(document).on('change','#sel_member_code',function(){
   
  var selectedCode = $('#sel_member_code').find('option:selected');
  $("#member_name").val(selectedCode.data('name'));
  $("#member_status").val(selectedCode.data('status'));
  $("#address_one").val(selectedCode.data('addressone'));
  $("#address_two").val(selectedCode.data('addresstwo'));
  $("#address_three").val(selectedCode.data('addressthree'));
  $("#member_phone").val(selectedCode.data('memberphone'));
  $("#member_mobile").val(selectedCode.data('membermobile'));
  console.log(selectedCode);
 
  

});



/* ------------------------------------------------- */


  $(document).on('click', "#yearlystatementshowbtn", function(e) {
        e.preventDefault();

       var from_month =$("#from_month").val();
       var to_month =$("#to_month").val();
       var sel_member_code =$("#sel_member_code").val();
     
  if(validate()){
         $('#memberbill_list_data').html('');
         $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'yearlystatement/getYearlyStatementByMonth',
                dataType: "html",
                data: {from_month:from_month,to_month:to_month,sel_member:sel_member_code},
                
                success: function (result) {
                   $("#loader").hide();
                     $("#memberbill_list_data").html(result);
                    // $(".dataTable").DataTable();
                    
                 
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


$(document).on('click', "#yearlystatementprintbtn", function(e) {

        e.preventDefault();

        var basepath = $('#basepath').val();alert()

        if (validate()) {
         
            $('#yearlystaentFrom').prop('action', basepath+'yearlystatement/print_yearlystatement');
            $("#yearlystaentFrom").submit();

        }


    });





$(document).on('click', "#printbtn", function(e) {
        e.preventDefault();

		printDiv();


});



}); // end of document ready



function validate(){
  
       var from_month =$("#from_month").val();
       var to_month =$("#to_month").val();
       var sel_member_code =$("#sel_member_code").val();
       
       $("#errormsg").text("");
       $("#from_montherr,#to_montherr,#sel_member_codeerr").removeClass("form_error");

       if (from_month=='') {
           $("#from_montherr").addClass("form_error");
              return false;
       }

       if (to_month=='') {
           $("#to_montherr").addClass("form_error");
              return false;
       }

       if (sel_member_code=='') {
           $("#sel_member_codeerr").addClass("form_error");
              return false;
       }



    
  
    return true;
}


function printData()
{
   
    var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode : mode, popClose : close};
        $("div.print_bill_yearly").printArea( options );
}

function printDiv() 
{



   print();
}