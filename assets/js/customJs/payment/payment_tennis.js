$(document).ready(function(){

  var basepath = $("#basepath").val();
   
 //$("#tennispaymentaftersavemodel").modal();
$(document).on('click','#codegenbtn',function(){
   
  //  $("#firstname").val("test");
    $('#genCodeForm').trigger("reset");


});

$(document).on('change','#sel_student_code',function(){
   
  var selectedCode = $('#sel_student_code').find('option:selected');
  $("#studentname").val(selectedCode.data('name'));
  //console.log(selectedCode);

});


   
    $(document).on('click','#create_code',function(e){
		e.preventDefault();
   
          $("#student_adminfo").css('display', 'none');
          $("#student_adminfo").hide();
		if(validateCreateCode())
		{

			var firstname = $("#firstname").val();
	 		var lastname = $("#lastname").val();
          
            var formDataserialize = $("#genCodeForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize};
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'paymenttennis/generateCode';
         	$("#create_code").attr('disabled', true);
            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
				
					  $("#generatedcode").val(result.new_code);
					  $("#student_code").val(result.new_code);
					  $("#student_name").val(firstname+" "+lastname);
					
                       $("#create_code").attr('disabled',false);
                       $("#student_adminfo").css('display', 'block');
					
                  
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });

		}

    });



/* save admission data */

    $(document).on('submit','#genCodeForm',function(e){
		e.preventDefault();

		if(validateAdmData())
		{

           
            var formDataserialize = $("#genCodeForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'paymenttennis/admission_action';
            $("#albumsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
					if (result.msg_status == 1) {
						resetStudentCodeDropdown(result.student_code);

                
                        $('#codegeneration_modal').modal('hide');

                    } 
					else {
                      //  $("#album_response_msg").text(result.msg_data);
                    }
					
                  //  $("#loaderbtn").css('display', 'none');
					
                   
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });
            
            
            
			
		}

    });



$(document).on('change','#actobedebited',function(){
   
  var selectedMode = $(this).find('option:selected').text();
		  if (selectedMode=='CHEQUE IN HAND') {
		  	$('#cheque_bank_dtl').show();
		  }else{
		  	$('#cheque_bank_dtl').hide();
		  }

});

$(document).on('change','#tran_type',function(){
         
         /*
			RCFS:Receivable From Student
			ORADM:Other Receipts(Admission)
			ORITM:Other Receipts(Item)
         */
          var selectedValue = $(this).val();

		  if (selectedValue=='RCFS') {
		  	$('#receivable_dtl').show();
		  	$('#receivable_from_student_amount').show();
		  	$('#other_recpt_amount_adm').hide();
		  	$('#other_recpt_amount_item').hide();
		  	resetAdmissionAmountDetails();
		  	resetItemAmountDetails();
		  }else if(selectedValue=='ORADM'){
		  	$('#receivable_dtl').hide();
		  	$('#other_recpt_amount_item').hide();
		  	$('#receivable_from_student_amount').hide();
		  	$('#other_recpt_amount_adm').show();
		  	 resetRecivableAmountDetails();
		  	 resetItemAmountDetails();
		  }
		  else if(selectedValue=='ORITM'){
		  	$('#receivable_dtl').hide();
		  	$('#other_recpt_amount_adm').hide();
		  	$('#receivable_from_student_amount').hide();
		  	$('#other_recpt_amount_item').show();
		  	 resetRecivableAmountDetails();
		  	 resetAdmissionAmountDetails();
		  }

		  	//alert($("#receivable_student_cgst_rate").val());

});

$(document).on('change','#tennisitem',function(){
   
  var selectedItem = $('#tennisitem').find('option:selected');
  $("#itemrate").val(selectedItem.data('itemrate'));
  $("#hsncode").val(selectedItem.data('itemhsn'));
   calculateItemGst();
   calculateItemNetAmount();

});

$(document).on('keyup input','#itemqty',function(){



	 calculateItemGst();
	 calculateItemNetAmount();

});

$(document).on('change','#item_cgst_rate',function(){

  getItemCgst();
  calculateItemNetAmount();

});

$(document).on('change','#item_sgst_rate',function(){

  getItemSgst();
  calculateItemNetAmount();

});



       // Add Item Details
    $(document).on('click','.addItem',function(){

          // rowNoUpload++;
         // $("#selmens_medicineerr").removeClass("bordererror");

          var rowno=  $("#rowno").val();
          var tennisitem=  $("#tennisitem").val();
          var hsncode=  $("#hsncode").val();
          var itemqty=  $("#itemqty").val();
          var itemrate=  $("#itemrate").val();
          var itemtaxable=  $("#itemtaxable").val();
          var cgstrateid=  $("#item_cgst_rate").val();

          var selectedCgst = $('#item_cgst_rate').find('option:selected');
          var cgstrate = parseFloat(selectedCgst.data('rate'));
          var cgstamt=  $("#item_cgst_amt").val();
          var sgstrateid=  $("#item_sgst_rate").val();
          var selectedSgst = $('#item_sgst_rate').find('option:selected');
          var sgstrate = parseFloat(selectedSgst.data('rate'));
          var sgstamt=  $("#item_sgst_amt").val();
          var item_netamt=  $("#item_netamt").val();
          
        console.log(basepath);
        if (validateItemAmtDetails()) {
        rowno++;
        $.ajax({
            type: "POST",
            url: basepath+'paymenttennis/addItemAmountDetail',
            dataType: "html",
            data: {
            		rowNo:rowno,
            		tennisitem:tennisitem,
            		hsncode:hsncode,
            		itemqty:itemqty,
	            	itemrate:itemrate,
	            	itemtaxable:itemtaxable,
	            	cgstrateid:cgstrateid,
	            	cgstrate:cgstrate,
	            	cgstamt:cgstamt,
	            	sgstrateid:sgstrateid,
	            	sgstrate:sgstrate,
	            	sgstamt:sgstamt,
	            	item_netamt:item_netamt

	            },
            success: function (result) {
                $("#rowno").val(rowno);
                $("#detail_itemamt table").show(); 
                $("#detail_itemamt table tbody").append(result);   
               

                $('#itemqty').val('');
                $('#itemtaxable').val('');
                $('#tennisitem').val('').change();
                $('#item_cgst_rate').val('').change();
                $('#item_sgst_rate').val('').change();
                $('#item_cgst_amt').val('');
                $('#item_sgst_amt').val('');
                $('#item_netamt').val('');

            
         
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


     // Delete Table Row

    $(document).on('click','.delItenDetails',function(){
        
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
       // console.log(rowDtlNo[1]);
        console.log(currRowID);

        //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
        $("tr#rowItemdetails_"+rowDtlNo[1]).remove();
    });



$(document).on('change','#oth_rec_cgst_rate',function(){

  calculateOtherRecAdmGst();
  calculateOthRecAdmNetAmount();

});

$(document).on('change','#oth_rec_sgst_rate',function(){
     calculateOtherRecAdmGst();
	 calculateOthRecAdmNetAmount();

});

$(document).on('keyup input','#oth_rec_amt',function(){

	 calculateOtherRecAdmGst();
	 calculateOthRecAdmNetAmount();

});



/* Receivable From Student */

$(document).on('keyup input','#receivable_student_amt,#receivable_student_fineamt',function(){

	 calculateReceivableFrmStudentGst();
	 calculateReceivableFrmNetAmount();

});

$(document).on('change','#receivable_student_cgst_rate,#receivable_student_sgst_rate',function(){
calculateReceivableFrmStudentGst();
calculateReceivableFrmNetAmount();

});



/* save tennis payment data */

/* save admission data */

    $(document).on('submit','#tennisPaymentForm',function(e){
		e.preventDefault();


		if(validateTennisPaymentData())
		{

          
            var formDataserialize = $("#tennisPaymentForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'paymenttennis/saveTennisPaymentData';
            $("#albumsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
					if (result.msg_status == 1) {
						resetStudentCodeDropdown(result.student_code);
						
 
						   // $("#tennispaymentaftersavemodel").modal({
         //                    "backdrop": "static",
         //                    "keyboard": true,
         //                    "show": true
         //                });
               // $('#tennisPaymentForm').trigger("reset");
                        $('#codegeneration_modal').modal('hide');

                    } 
					else {
                      //  $("#album_response_msg").text(result.msg_data);
                    }
					
                  //  $("#loaderbtn").css('display', 'none');
					
                   
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });
            
            
            
			
		}

    });






}); // end of document ready


function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}

function validateCreateCode(){

	 var firstname = $("#firstname").val();
	 var lastname = $("#lastname").val();
	  $("#firstname,#lastname").removeClass("form_error");

	 console.log(firstname);

	 if (firstname=='') {
	 	 $("#firstname").addClass("form_error");
        
        return false;
	 }

	 if (lastname=='') {
	 	 $("#lastname").addClass("form_error");
        
        return false;
	 }


	 return true;


}

function resetStudentCodeDropdown(studentcode){

	  var basepath = $("#basepath").val();

	  $.ajax({
            type: "POST",
            url: basepath+'paymenttennis/resetStudentCodeList',
            dataType: "html",
            data: {studentcode:studentcode},
            success: function (result) {
         

              
             $("#resetstudentlist").html(result);

            // $('.select2').select2();
               var selectedCode = $("#sel_student_code").find('option:selected');
                console.log(selectedCode);
               $("#studentname").val(selectedCode.data('name'));
         
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



function validateAdmData(){

     var student_code = $("#student_code").val();
	 var student_name = $("#student_name").val();
	  $("#student_code,#student_name").removeClass("form_error");

	 console.log(student_code);

	 if (student_code=='') {
	 	 $("#student_code").addClass("form_error");
        
        return false;
	 }

	 if (student_name=='') {
	 	 $("#student_name").addClass("form_error");
        
        return false;
	 }


	 return true;
}

function validateTennisPaymentData(){

     var studentcode = $("#sel_student_code").val();
	 var studentname = $("#studentname").val();
	 var payment_dt = $("#payment_dt").val();
	 var tran_type = $("#tran_type").val();
	 var actobeDebited = $("#actobedebited").val();
	 var paymentmode = $("#paymentmode").val();
	 var actobeCredited = $("#actobecredited").val();

	 var oth_rec_amt = $("#oth_rec_amt").val();
	 var oth_rec_cgst_rate = $("#oth_rec_cgst_rate").val();
	 var oth_rec_sgst_rate = $("#oth_rec_sgst_rate").val();

	 $("#error_msg").text('');

	 $("#sel_student_codeerr,#studentname,#payment_dt,#tran_typeerr,#actobedebitederr,#actobecreditederr,#paymentmodeerr").removeClass("form_error");
	 $("#oth_rec_amterr,#oth_rec_cgst_rateerr,#oth_rec_sgst_rateerr").removeClass("form_error");
	 console.log(studentname);

	 if (studentcode=='') {
	 	 $("#sel_student_codeerr").addClass("form_error");
        return false;
	 }

	 if (studentname=='') {
	 	 $("#studentname").addClass("form_error");
         $("#studentname").focus();
        return false;
	 }

	 if (payment_dt=='') {
	 	 $("#payment_dt").addClass("form_error");
         $("#payment_dt").focus();
        return false;
	 }

	 if (tran_type=='') {
	 	 $("#tran_typeerr").addClass("form_error");
         return false;
	 }

	 if (paymentmode=='') {
	 	 $("#paymentmodeerr").addClass("form_error");
         return false;
	 }

	 if (actobeDebited=='') {
	 	 $("#actobedebitederr").addClass("form_error");
         return false;
	 }

	 if (actobeCredited=='') {
	 	 $("#actobecreditederr").addClass("form_error");
         return false;
	}



	/* validate for Other Receipts(Item) */
	console.log("tran_type"+tran_type);
	if (tran_type=='ORITM') {

	   var totalItem =0;
	    $(".tennisitemcls").each(function(){
	      totalItem++;
	    });

		if(totalItem==0){
			$("#error_msg").text("Error : Add Item details")
			return false;
		}
	}else if(tran_type=='ORADM'){

		if (oth_rec_amt=='') {
	 	 $("#oth_rec_amterr").addClass("form_error");
        return false;

	    }
	    if (oth_rec_cgst_rate=='') {
	 	 $("#oth_rec_cgst_rateerr").addClass("form_error");
        return false;
	    }

	    if (oth_rec_sgst_rate=='') {
	 	 $("#oth_rec_sgst_rateerr").addClass("form_error");
        return false;
	    }



	}





	 return true;
}


function validateItemAmtDetails(){

   var tennisitem = $("#tennisitem").val();
   var itemqty = $("#itemqty").val();
   var item_cgst_rate = $("#item_cgst_rate").val();
   var item_sgst_rate = $("#item_sgst_rate").val();

    $("#tennisitem_err,#itemqty,#item_cgst_rateerr,#item_sgst_rateerr").removeClass("form_error");

    if (tennisitem=='') {
	 	 $("#tennisitem_err").addClass("form_error");
        return false;
	 }

   if (itemqty=='') {
	 	 $("#itemqty").addClass("form_error");
        return false;
   }

   if (item_cgst_rate=='') {
	 	 $("#item_cgst_rateerr").addClass("form_error");
        return false;
   }

    if (item_sgst_rate=='') {
	 	 $("#item_sgst_rateerr").addClass("form_error");
        return false;
   }

	return true;
}

function calculateItemNetAmount(){

	var itemtaxable=  parseFloat($("#itemtaxable").val() || 0);
	var cgst = parseFloat($("#item_cgst_amt").val() == "" ? 0 : $("#item_cgst_amt").val());
    var sgst = parseFloat($("#item_sgst_amt").val() == "" ? 0 : $("#item_sgst_amt").val());
  
    var netAmt=parseFloat((itemtaxable+cgst+sgst));
     $("#item_netamt").val(netAmt.toFixed(2));
}

function itemTaxable(){
	  var itemqty=  parseFloat($("#itemqty").val() || 0);
	  var itemrate=  parseFloat($("#itemrate").val() || 0);
	  var taxable = parseFloat((itemqty*itemrate));
	  $("#itemtaxable").val(taxable.toFixed(2));
}

function calculateItemGst(){
	itemTaxable();
	getItemCgst();
	getItemSgst();
}

function getItemCgst(){
  var selected = $('#item_cgst_rate').find('option:selected');
  var rate = parseFloat(selected.data('rate'));
  var taxableAmt=  parseFloat($("#itemtaxable").val() || 0);
  var cgst = parseFloat((taxableAmt * rate)/100);
  $("#item_cgst_amt").val(cgst.toFixed(2));

}
function getItemSgst(){

  var selected = $('#item_sgst_rate').find('option:selected');
  var rate = parseFloat(selected.data('rate'));
  var taxableAmt=  parseFloat($("#itemtaxable").val() || 0);
  var sgst = parseFloat((taxableAmt * rate)/100);
  $("#item_sgst_amt").val(sgst.toFixed(2));

}


function calculateOtherRecAdmGst(){
	getOthRecAdmCgst();
	getOthRecAdmSgst();
}


function getOthRecAdmCgst(){
  var selected = $('#oth_rec_cgst_rate').find('option:selected');
  var rate = parseFloat(selected.data('rate'));
  var taxableAmt=  parseFloat($("#oth_rec_amt").val() || 0);
  var cgst = parseFloat((taxableAmt * rate)/100);
  $("#oth_rec_cgst_amt").val(cgst.toFixed(2));

}

function getOthRecAdmSgst(){
  var selected = $('#oth_rec_sgst_rate').find('option:selected');
  var rate = parseFloat(selected.data('rate'));
  var taxableAmt=  parseFloat($("#oth_rec_amt").val() || 0);
  var sgst = parseFloat((taxableAmt * rate)/100);
  $("#oth_rec_sgst_amt").val(sgst.toFixed(2));

}

function calculateOthRecAdmNetAmount(){

	var itemtaxable=  parseFloat($("#oth_rec_amt").val() || 0);
	var cgst = parseFloat($("#oth_rec_cgst_amt").val() == "" ? 0 : $("#oth_rec_cgst_amt").val());
    var sgst = parseFloat($("#oth_rec_sgst_amt").val() == "" ? 0 : $("#oth_rec_sgst_amt").val());
  
    var netAmt=parseFloat((itemtaxable+cgst+sgst));
     $("#oth_rec_netamt").val(netAmt.toFixed(2));
}


function calculateReceivableFrmStudentGst(){
	taxableReceivableFrmStudent();
	getReceivableFrmCgst();
	getReceivableFrmSgst();

}

function taxableReceivableFrmStudent(){
	  var receivable_student_amt = parseFloat($('#receivable_student_amt').val() || 0);
      var receivable_student_fineamt = parseFloat($('#receivable_student_fineamt').val() || 0);
      var taxableAmt = parseFloat(receivable_student_amt+receivable_student_fineamt);
     $("#receivable_student_taxable").val(taxableAmt.toFixed(2));

}

function getReceivableFrmCgst(){

  var selected = $('#receivable_student_cgst_rate').find('option:selected');
  var rate = parseFloat(selected.data('rate'));
  var taxableAmt=  parseFloat($("#receivable_student_taxable").val() || 0);
  var cgst = parseFloat((taxableAmt * rate)/100);
  $("#receivable_student_cgst_amt").val(cgst.toFixed(2));

}

function getReceivableFrmSgst(){

  var selected = $('#receivable_student_sgst_rate').find('option:selected');
  var rate = parseFloat(selected.data('rate'));
  var taxableAmt=  parseFloat($("#receivable_student_taxable").val() || 0);
  var sgst = parseFloat((taxableAmt * rate)/100);
  $("#receivable_student_sgst_amt").val(sgst.toFixed(2));

}


function calculateReceivableFrmNetAmount(){

	var taxable=  parseFloat($("#receivable_student_taxable").val() || 0);
	var cgst = parseFloat($("#receivable_student_cgst_amt").val() == "" ? 0 : $("#receivable_student_cgst_amt").val());
    var sgst = parseFloat($("#receivable_student_sgst_amt").val() == "" ? 0 : $("#receivable_student_sgst_amt").val());
  
    var netAmt=parseFloat((taxable+cgst+sgst));
     $("#receivable_student_netamt").val(netAmt.toFixed(2));
}


function resetItemAmountDetails(){
	$("#tennisitem").val(null).trigger("change");
	$("#hsncode").val('');
	$("#itemqty").val('');
	$("#itemrate").val('');
	$("#itemtaxable").val('');
	$("#item_cgst_rate").val(null).trigger("change"); 
	$("#item_cgst_amt").val('');
	$("#item_sgst_rate").val(null).trigger("change");  
	$("#item_sgst_amt").val('');
	$("#item_netamt").val('');

    $(".itemDtlCls").each(function(){

	    var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');

        $("tr#rowItemdetails_"+rowDtlNo[1]).remove(); 

	 });


}

function resetAdmissionAmountDetails(){

	$("#oth_rec_amt").val('');
	$("#oth_rec_cgst_rate").val(null).trigger("change");
	$("#oth_rec_cgst_amt").val('');
	$("#oth_rec_sgst_rate").val(null).trigger("change"); 
	$("#oth_rec_sgst_amt").val('');
	$("#oth_rec_netamt").val('');

}
function resetRecivableAmountDetails(){

	$("#receivable_student_amt").val('');
	$("#receivable_student_fineamt").val('');
	$("#receivable_student_taxable").val('');
	$("#receivable_student_cgst_rate").val('');
	$("#receivable_student_cgst_rate").val(null).trigger("change");
	$("#receivable_student_cgst_amt").val('');
	$("#receivable_student_sgst_rate").val(null).trigger("change");
	$("#receivable_student_sgst_amt").val('');
	$("#receivable_student_netamt").val('');

}
