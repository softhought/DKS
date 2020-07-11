$(document).ready(function() {

 var basepath = $('#basepath').val();

     var startDate = new Date($("#acstartDate").val());
    var endDate = new Date($("#acendDate").val());
    // $('.timeEntry').timeEntry({ampmPrefix: ' '});

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: startDate,
        endDate: endDate

    });

$(document).on('input keyup','#voucher_dt',function(){

  var voucher_dt= $(this).val();
   
  console.log("voucher date :"+voucher_dt);
  
  $('#errormsg').text('');
  if (isDate(voucher_dt)) {
     console.log("payment date is valid:");
    
     if(inputdatecheck(voucher_dt) == 0){   
        $('#errormsg').text('Enter Date Between Accounting Year');
      return false;
     }

  }else{
       $('#errormsg').text('Payment date is not valid');
  }

 // isDate(txtDate)


});



 $(document).on('change','.selcrdr',function(){

 		 resetDrCrAmount();
});

$(document).on('keyup input','.listamounted',function(){

 		 resetDrCrAmount();
     checkDrCrAmount();
});

 $(document).on('change','#account_id',function(){

 
        checkDrCrAmount();
   

     
});




 $(document).on('click','.addAmount',function(e){
           e.preventDefault();

          var rowno= $("#rowno").val(); 
          var tran_type=$("#tran_type").val();
          var account_id=$("#account_id").val();
          var account_name = $("#account_id option:selected").text();
          var amount= $("#amount").val();
        

        console.log(basepath);
        if(validateDetails()) {

        rowno++;
        $.ajax({
            type: "POST",
            url: basepath+'voucherentry/addAmountDetail',
            dataType: "html",
            data: {
            		rowNo:rowno,
            		tran_type:tran_type,
            		account_id:account_id,
            		account_name:account_name,
            		amount:amount,
            
	            },
            success: function (result) {
                $("#rowno").val(rowno);
                $("#detail_itemamt table").show(); 
                $("#detail_itemamt table tbody").append(result);   
               

                $('#amount').val('');
                $('#tran_type').val('').change();
                $('#account_id').val('').change();
           
                resetDrCrAmount();
                resetSerial();
           
         
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

        }else{
            $("#selmens_medicine").focus();
            $("#selmens_medicineerr").addClass("bordererror");
           
        }
  
    }); // End Visiting Details


 $(document).on('click','.delDetails',function(){
        
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
       // console.log(rowDtlNo[1]);
        console.log(currRowID);

        //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
        $("tr#rowItemdetails_"+rowDtlNo[1]).remove();
       resetDrCrAmount();
       resetSerial();
    });


    //edit member children details2
  $(document).on('click', '.editchilddetails', function(e) {


 				 e.preventDefault();			
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        var editcheck = $("#editbtncheck_" + rowDtlNo[1]).val();

        $(".showdata_" + rowDtlNo[1]).hide();
        $(".showdata2_" + rowDtlNo[1]).hide();
        $(".showdata3_" + rowDtlNo[1]).hide();
        $(".dispblock_" + rowDtlNo[1]).css('display', 'block');
        $('.select2').select2();
    });



  $(document).on('submit','#voucherEntryFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(validateMasterData())
        {     $('#entry_mode').attr("disabled", false); 

            var formDataserialize = $("#voucherEntryFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#patrecsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'voucherentry/voucherentry_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    if (result.msg_status == 1) {
                       $("#loaderbtn").css('display', 'none');


                   // window.location.replace(basepath+'voucherentry');
                   if (mode=='ADD') {
                           $("#voucher_no").val(result.voucher_no);
                           $("#response_msg").text(result.msg_data);
                           $("#voucher_no").focus();
                        }else{
                            window.location.replace(basepath+'voucherentry');
                        }

                    } 
                    else {
                     
                    }
                   
                   
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



$(document).on('click', "#voucherentryshowbtn", function(e) {
        e.preventDefault();


        var from_dt = $("#from_dt").val();
        var to_date = $("#to_date").val();
     

        if (1) {
            $('#voucherentry_list_data').html('');
            $("#loader").show();

            $.ajax({
                type: "POST",
                url: basepath + 'voucherentry/getVoucherEntryByDate',
                dataType: "html",
                data: { from_dt: from_dt, to_date: to_date},

                success: function(result) {
                    $("#loader").hide();
                    $("#voucherentry_list_data").html(result);
                    $('.dataTable').DataTable();
                   
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





}); // end of document ready

function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}



function validateDetails(){

     var tran_type=$("#tran_type").val();
     var account_id=$("#account_id").val();
     var amount= $("#amount").val();
        

   	 $("#tran_typeerr,#account_iderr,#amount").removeClass("form_error");
	 $('#error_msg').text('');

	 if (tran_type=='') {
	 	 $("#tran_typeerr").addClass("form_error");
         $("#tran_typeerr").focus();
         return false;
	 }

	 if (account_id=='') {
	 	 $("#account_iderr").addClass("form_error");
         $("#account_iderr").focus();
         return false;
	 }

	 if (amount=='') {
	 	 $("#amount").addClass("form_error");
         $("#amount").focus();
         return false;
	 }



	return true;
}


function resetSerial(){
    var n=1;

  $(".listamounted").each(function(){
      var currRowID = $(this).attr('id');
      var rowDtlNo = currRowID.split('_');
        console.log("-> "+n); 
      $("#serial_"+rowDtlNo[1]).text(n++);
    
   });

}


 function resetDrCrAmount(){

	var total_dr_amt=0;
	var total_cr_amt=0;

	$(".listamounted").each(function(){

	  var currRowID = $(this).attr('id');
      var rowDtlNo = currRowID.split('_');
      var tran_type=$("#selcrdr_"+rowDtlNo[1]).val();
	    
	      if (tran_type=='Dr') {
	      		total_dr_amt+=parseFloat($(this).val());
	      }else{
	      	    total_cr_amt+=parseFloat($(this).val());
	      }

    });

	$("#total_dr").val(total_dr_amt);
	$("#total_cr").val(total_cr_amt);
}


function checkDrCrAmount(){

   var account_id=$("#account_id").val();

    if (account_id=='') {
        $("#amount").val('');
    }else{

  var total_dr = parseFloat($("#total_dr").val() || 0);
  var total_cr = parseFloat($("#total_cr").val() || 0);

  var diffdrcr = Math.abs(total_dr-total_cr);

    console.log(diffdrcr);
    $("#amount").val(diffdrcr);

   }
}



function validateMasterData(){

     var voucher_dt=$("#voucher_dt").val();
     var total_dr= $("#total_dr").val();
     var total_cr= $("#total_cr").val();
        

   $("#voucher_dt,#total_cr,#total_cr").removeClass("form_error");
	 $('#error_msg').text('');
	 $('#errormsg').text('');

	 if (voucher_dt=='') {
	 	 $("#voucher_dt").addClass("form_error");
       
         return false;
	 }

	 if(inputdatecheck(voucher_dt) == 0){   
        $('#errormsg').text('Enter Date Between Accounting Year');
      return false;
     }




	 if (total_dr!=total_cr) {
	 	 $("#total_dr,#total_cr").addClass("form_error");
     $('#errormsg').text('Please maintain equivalent debit and credit amount');
       
      return false;
	 }



var accountlist=0;

   $(".listamount").each(function(){
   
        accountlist = accountlist + 1;
    });


    if(accountlist==0){

       $('#errormsg').text('Add account head list');
         return false;

   }

     if(total_dr==''){   
         $("#total_dr").addClass("form_error");
      return false;
     } 

     if(total_cr==''){   
         $("#total_cr").addClass("form_error");
      return false;
     } 



	return true;
}