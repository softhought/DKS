$(document).ready(function() {

 var basepath = $('#basepath').val();

   $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,


    });


 var total_amt = $("#total_amt").val();
 $("#total_amount_value").html(total_amt);


$(document).on('change','#raw_meterial,#vendor_id',function(){

 		    var raw_meterial = $('#raw_meterial').val();
 		    var vendor_id = $('#vendor_id').val();

 		    if (raw_meterial!='' && vendor_id!='') {
 		    		rawMeterialRateData();
 		    }else{

 		    }

});



$(document).on('keyup input', '#quantity,#rate', function() {

console.log("quantity rate");

        calculateTaxable();
        calculateGst();
        calculateNetAmount();

    });

$(document).on('keyup input', '#roundoff', function() {
	 roundOff();console.log('fcs');
});



 $(document).on('click','.addrawMeterial',function(e){
           e.preventDefault();

          var rowno= $("#rowno").val(); 
          var raw_meterial=$("#raw_meterial").val();
          var raw_meterial_name = $("#raw_meterial option:selected").text();
          var unit= $("#unit").val();
          var quantity= $("#quantity").val();
          var rate= $("#rate").val();
          var taxable_amt= $("#taxable_amt").val();
          var cgst_rate_id= $("#cgst_rate_id").val();
          var sgst_rate_id= $("#sgst_rate_id").val();
          var cgst_rate= $("#cgst_rate").val();
          var cgst_amt= $("#cgst_amt").val();
          var sgst_rate= $("#sgst_rate").val();
          var sgst_amt= $("#sgst_amt").val();
          var net_amt= $("#net_amt").val();
        

        console.log(basepath);
        if(validateDetails()) {

        rowno++;
        $.ajax({
            type: "POST",
            url: basepath+'purchaseorder/addRawMeterialDetail',
            dataType: "html",
            data: {
            		rowNo:rowno,
            		raw_meterial:raw_meterial,
            		raw_meterial_name:raw_meterial_name,
            		unit:unit,
            		quantity:quantity,
            		rate:rate,
            		taxable_amt:taxable_amt,
            		cgst_rate_id:cgst_rate_id,
            		sgst_rate_id:sgst_rate_id,
            		cgst_rate:cgst_rate,
            		cgst_amt:cgst_amt,
            		sgst_rate:sgst_rate,
            		sgst_amt:sgst_amt,
            		net_amt:net_amt,
	            },
            success: function (result) {
                $("#rowno").val(rowno);
                $("#detail_itemamt table").show(); 
                $("#detail_itemamt table tbody").append(result);   
               

                
                $('#raw_meterial').val('').change();
                $('#unit,#quantity,#rate,#taxable_amt,#cgst_rate_id,#sgst_rate_id').val('');
                $('#cgst_rate,#cgst_amt,#sgst_rate,#sgst_amt,#net_amt').val('');
                $('#account_id').val('').change(); 
                  resetTotalAmount();
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
     
         resetSerial();
         resetTotalAmount();
    });



 $(document).on('submit','#purchaseOrderFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(validateMasterData())
        {     $('#entry_mode').attr("disabled", false); 

            var formDataserialize = $("#purchaseOrderFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#patrecsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'purchaseorder/purchase_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    if (result.msg_status == 1) {

                       $("#loaderbtn").css('display', 'none');

                  	   window.location.replace(basepath+'purchaseorder');
                   
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




  $(document).on('click', "#purchaseordershowbtn", function(e) {
        e.preventDefault();


     var from_dt = $("#from_dt").val();
     var to_date = $("#to_date").val();
  
     

  if(1){
           $('#purchaseorder_list_data').html('');
           $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'purchaseorder/getPurchaseOrderByDate',
                dataType: "html",
                data: {from_dt:from_dt,to_date:to_date},
                
                success: function (result) {
                     $("#loader").hide();
                     $("#purchaseorder_list_data").html(result);
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

function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}

function validateDetails(){

	var raw_meterial=$("#raw_meterial").val();
	var vendor_id=$("#vendor_id").val();
	var unit=$("#unit").val();
	var quantity=$("#quantity").val();

	$("#vendor_iderr,#raw_meterialerr,#unit").removeClass("form_error");
	$('#error_msg').text('');

	if (vendor_id=='') {
	 $("#vendor_iderr").addClass("form_error");
     $("#vendor_iderr").focus();
         return false;
	 }

	if (raw_meterial=='') {
	 $("#raw_meterialerr").addClass("form_error");
     $("#raw_meterialerr").focus();
         return false;
	 }

	 if (unit=='') {
	 $("#unit").addClass("form_error");
     $("#unit").focus();
         return false;
	 }

	 if (quantity=='') {
	 $("#quantity").addClass("form_error");
     $("#quantity").focus();
         return false;
	 }


	return true;

}


function resetSerial(){
    var n=1;

  $(".rowrawmeteriacls").each(function(){
      var currRowID = $(this).attr('id');
      var rowDtlNo = currRowID.split('_');
        console.log("-> "+n); 
      $("#serial_"+rowDtlNo[1]).text(n++);
    
   });

}


function rawMeterialRateData(){

	var raw_meterial = $('#raw_meterial').val();
 	var vendor_id = $('#vendor_id').val();
 	var basepath = $('#basepath').val();

 	        $.ajax({
                type: "POST",
                url: basepath+'purchaseorder/rawmeterialRateDetails',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: {raw_meterial:raw_meterial,vendor_id:vendor_id},
                
                success: function (result) {

                    if (result.msg_status == 1) {
                      

                    	//console.log(result.msg_data);
                    	console.log(result.msg_data.item_unit_name);
                    	$('#unit').val(result.msg_data.item_unit_name);
                    	$('#rate').val(result.msg_data.rate);
                    	$('#cgst_rate').val(result.msg_data.cgst_rate);
                    	$('#sgst_rate').val(result.msg_data.sgst_rate);
                    	$('#cgst_rate_id').val(result.msg_data.cgst_id);
                    	$('#sgst_rate_id').val(result.msg_data.sgst_id);

                    	  calculateTaxable();
       					  calculateGst();
        				  calculateNetAmount();
                 

                    } 
                    else {

                      $('#unit').val('');
                      $('#rate').val('');
                      $('#cgst_rate').val('');
                      $('#sgst_rate').val('');
                      $('#cgst_rate_id').val('');
                      $('#sgst_rate_id').val('');
                     
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

}

function calculateTaxable() {

    var quantity = parseFloat($("#quantity").val() || 0);
    var rate = parseFloat($("#rate").val() || 0);

    var total_taxable = (quantity * rate);

    $("#taxable_amt").val(total_taxable.toFixed(2));

}

function calculateGst() {

    var taxable_amt = parseFloat($("#taxable_amt").val() || 0);
    var cgst_rate = parseFloat($("#cgst_rate").val() || 0);
    var sgst_rate = parseFloat($("#sgst_rate").val() || 0);

    var cgst_amtount = (taxable_amt * cgst_rate) / 100;
    var sgst_amtount = (taxable_amt * sgst_rate) / 100;

    $("#cgst_amt").val(cgst_amtount.toFixed(2));
    $("#sgst_amt").val(sgst_amtount.toFixed(2));

}

function calculateNetAmount() {

    var taxable_amt = parseFloat($("#taxable_amt").val() || 0);
    var cgst_amt = parseFloat($("#cgst_amt").val() || 0);
    var sgst_amt = parseFloat($("#sgst_amt").val() || 0);
    var net_amount = (taxable_amt + cgst_amt + sgst_amt);
    $("#net_amt").val(net_amount.toFixed(2));

}


 function resetTotalAmount(){

	var total_amount=0;
	var roundoff = parseFloat($("#roundoff").val() || 0);

$(".rowrawmeteriacls").each(function(){
	  var currRowID = $(this).attr('id');
      var rowDtlNo = currRowID.split('_');
      var net_amount=parseFloat($("#item_netamtrow_"+rowDtlNo[1]).val()); 
	  total_amount=total_amount + net_amount;
});

    var total_amount_round=total_amount + roundoff;

	$("#total_amt").val(total_amount.toFixed(2));
	$("#net_amount").val(total_amount_round.toFixed(2));
	
}


function roundOff(){

	var total_amount = parseFloat($("#total_amt").val() || 0);
	var roundoff = parseFloat($("#roundoff").val() || 0);
	var total_amount_round=total_amount + roundoff;
	$("#net_amount").val(total_amount_round.toFixed(2));

}





function validateMasterData(){

     var order_date=$("#order_date").val();
     var vendor_id= $("#vendor_id").val();
   
        

   $("#order_date,#total_cr,#total_cr").removeClass("form_error");
	 $('#error_msg').text('');
	 $('#errormsg').text('');

	 if (order_date=='') {
	 	 $("#order_date").addClass("form_error");
       
         return false;
	 }

	 if(inputdatecheck(order_date) == 0){   
        $('#errormsg').text('Enter Date Between Accounting Year');
      return false;
     }


     if (vendor_id=='') {
	 $("#vendor_iderr").addClass("form_error");
     $("#vendor_iderr").focus();
         return false;
	 }



var meteriallist=0;

   $(".rowrawmeteriacls").each(function(){
   
        meteriallist = meteriallist + 1;
    });


    if(meteriallist==0){

       $('#errormsg').text('Add raw meterial list');
         return false;

   }





	return true;
}


