$(document).ready(function() {

 var basepath = $('#basepath').val();

 $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true       


});


 $(document).on('change','#actobedebited',function(){
   
  var selectedMode = $(this).find('option:selected').text();
		  if (selectedMode=='CHEQUE IN HAND') {
		  	$('#cheque_bank_dtl').show();
		  }else{
		  	
        $('#bank,#branch,#cheque_no,#cheque_dt').val('');
        $('#cheque_bank_dtl').hide();

  }

});

  var total_amt = $("#total_amt").val();
 $("#total_amount_value").html(total_amt);


 $(document).on('change','#sel_member_code',function(){
   
  var selectedCode = $('#sel_member_code').find('option:selected');
  $("#member_name").val(selectedCode.data('name'));
  console.log(selectedCode);
  
     getBookingDetails();
});

 var ac_deb =$('select[name="actobedebited"] option:selected').text();

 if (ac_deb=="CHEQUE IN HAND") {
    $('#cheque_bank_dtl').show();
 }



 $(document).on('submit','#partyreceiptForm',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(validatePartyReceipt())
        {   

            var formDataserialize = $("#partyreceiptForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#partyreceiptsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'partyreceipt/receipt_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (data) {

                    if (data.msg_status == 1) {

                        if (mode=='ADD') {
                            Swal.fire({    
                                title: 'Receipt No : ' + data.receipt_no,    
                                text: "Want to print",    
                                icon: 'info',    
                                width: 350,    
                                padding: '1em',    
                                showCancelButton: true,    
                                confirmButtonColor: '#3085d6',    
                                cancelButtonColor: 'btn btn-danger',    
                                confirmButtonText: 'Yes',    
                                cancelButtonText: 'No',    
                                customClass: {    
                                    title: 'alerttitale',    
                                    content: 'alerttext',    
                                    confirmButton: 'btn tbl-action-btn padbtn',    
                                    cancelButton: 'btn tbl-action-btn padbtn',    
                                },    
                            }).then((result) => {    
                                if (result.value) {    
                                    window.open(basepath + 'partyreceipt/partyreceiptprintJasper/' + data.receipt_id, '_blank');    
                                    window.location.replace(basepath + 'partyreceipt/addReceipt');       
    
                                } else {    
                                    window.location.replace(basepath + 'partyreceipt/addReceipt');    
                                }    
                            });    
                        }    
                        else {
                            window.location.replace(basepath+'partyreceipt');
                        }

                    } 
                    
                //        $("#loaderbtn").css('display', 'none');
                //    window.location.replace(basepath+'partyreceipt');
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


$(document).on('input keyup','#amount,#service_charges',function(){

     CalculateNetTotal()
});



  $(document).on('click', "#partyreceiptlistshowbtn", function(e) {
        e.preventDefault();


     var from_dt = $("#from_dt").val();
     var to_date = $("#to_date").val();
     var sel_member = $("#sel_member").val();
     

  if(1){
           $('#receipt_list_data').html('');
         $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'partyreceipt/getPartyrReceiptListByDate',
                dataType: "html",
                data: {from_dt:from_dt,to_date:to_date,sel_member:sel_member},
                
                success: function (result) {
                   $("#loader").hide();
                     $("#receipt_list_data").html(result);
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

//daily party receipt 

$(document).on('click', "#dailypartyreceiptshowbtn", function(e) {
    e.preventDefault();


 var from_dt = $("#from_dt").val();
 var to_date = $("#to_date").val();
 var payment_id = $("#payment_id").val();
 

if(1){
       $('#dailyreceipt_list_data').html('');
     $("#loader").show();

$.ajax({
            type: "POST",
            url: basepath+'Dailypartyreceipt/getPartyrReceiptListByDate',
            dataType: "html",
            data: {from_dt:from_dt,to_date:to_date,payment_id:payment_id},
            
            success: function (result) {
               $("#loader").hide();
                 $("#dailyreceipt_list_data").html(result);
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



}); // end of document ready


function CalculateNetTotal(){

  var amount=parseFloat($("#amount").val() || 0);
  var service_charges=parseFloat($("#service_charges").val() || 0);
 
  var total_amt =(amount+service_charges);
  $("#net_amount").val(total_amt.toFixed(2));

}



function getBookingDetails(){


 var basepath = $('#basepath').val();

var sel_member_code=$("#sel_member_code").val();
$("#booking_details").html('');
if (sel_member_code!='') {

$("#booking_details").html('<center>Loading please wait.....</center>');
	  $.ajax({
            type: "POST",
            url: basepath+'partyreceipt/addPartyBookingDetail',
            dataType: "html",
            data: {
            		sel_member_code:sel_member_code
            	

	            },
            success: function (result) {
             
         			$("#booking_details").html(result);
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

}





function validatePartyReceipt(){

	 var receipt_dt = $("#receipt_dt").val();
	 var sel_member_code = $("#sel_member_code").val();
     var amount = $("#amount").val();
     var net_amount = $("#net_amount").val(); 
	 var actobedebited = $("#actobedebited").val();
	 var actobecredited = $("#actobecredited").val();
	 
	 $("#receipt_dt,#tran_typeerr,#sel_member_codeerr,#amount,#actobedebitederr,#actobecreditederr").removeClass("form_error");
	 $('#error_msg').text('');



	  if (receipt_dt=='') {
	 	 $("#receipt_dt").addClass("form_error");
         $("#receipt_dt").focus();
         return false;
	 }

     if(inputdatecheck(receipt_dt) == 0){   
        $('#error_msg').text('Enter Date Between Accounting Year');
        return false;
     }



	 if (actobedebited=='') {
	 	 $("#actobedebitederr").addClass("form_error");  
         return false;
	 }


	  if (actobecredited=='') {
	 	 $("#actobecreditederr").addClass("form_error");  
	 	
         return false;
	 }

	 if (sel_member_code=='') {
	 	 $("#sel_member_codeerr").addClass("form_error");  
	 	
         return false;
	 }



	 if (amount=='') {
	 	 $("#amount").addClass("form_error");  
	 	 $("#amount").focus(); 
         return false;
	 }


	 return true;
}


function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}