$(document).ready(function(){

  var basepath = $("#basepath").val();
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy'
    
});

 var total_amt = $("#total_amt").val();
 $("#total_amount_value").html(total_amt);

  $(document).on('change','#sel_member_code',function(){
   
  var selectedCode = $('#sel_member_code').find('option:selected');
  //$("#studentname").val(selectedCode.data('name'));
   $("#errormsg,#response_msg").html('');
  var memberName = selectedCode.data('titleone') +" " +selectedCode.data('name');
  $("#membername").val(memberName);
  console.log(memberName);
 

});

$(document).on('input keyup','#tran_dt',function(){
	  var tran_dt= $(this).val();   
	  console.log("tran date :"+tran_dt); 
	  $('#errormsg').text('');
	  if (isDate(tran_dt)) {
	     console.log("payment date is valid:");
	  }else{
	       $('#errormsg').text('Tran. date is not valid');
	  }

});


$(document).on('keyup input','#quantity,#rate,#guest_amt',function(){



	 calculateTaxable();
	 calculateGst();
	 calculateNetAmount();

});



    $(document).on('submit','#memberFacilityFrom',function(e){
		e.preventDefault();

        $("#errormsg,#response_msg").html('');
        var mode = $("#mode").val();
		if(validateFacilityData())
		{
     
         
            var formDataserialize = $("#memberFacilityFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'memberfacility/facility_action';
            $("#facilitysavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-table');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
					if (result.msg_status == 1) {

						if (mode=="ADD") {
						  $('#memberFacilityFrom').trigger("reset");
						  $('#sel_member_code').val(null).trigger("change")
						  $("#facilitysavebtn").show();
						  $("#loaderbtn").hide();
              			  $("#response_msg").text(result.msg_data);
						}else{

						  $("#response_msg").text(result.msg_data);
                          $("#facilitysavebtn").show();
						  $("#loaderbtn").hide();

						}
					
						  
						 

                    } 
					else {
                        $("#response_msg").text(result.msg_data);
                         $("#facilitysavebtn").show();
						  $("#loaderbtn").hide();
                    }
					
                  //  $("#loaderbtn").css('display', 'none');
					
                   
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });

		}

    });


  $(document).on('click', "#facilityshowbtn", function(e) {
        e.preventDefault();


		 var from_dt = $("#from_dt").val();
		 var to_date = $("#to_date").val();
		 var sel_member = $("#sel_member").val();
		 var parameter_id = $("#parameter_id").val();
		 var entry_module = $("#entry_module").val();

  if(1){
  		     $('#facility_list_data').html('');
  			 $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'memberfacility/getFacilistListByDate',
                dataType: "html",
                data: {from_dt:from_dt,to_date:to_date,sel_member:sel_member,parameter_id:parameter_id,entry_module:entry_module},
                
                success: function (result) {
                	 $("#loader").hide();
                     $("#facility_list_data").html(result);
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


function calculateTaxable(){

	var quantity=  parseFloat($("#quantity").val() || 0);
	var rate=  parseFloat($("#rate").val() || 0);
	var guest_amt=  parseFloat($("#guest_amt").val() || 0);

	var total_taxable=(quantity*rate)+guest_amt;

	$("#taxable_amt").val(total_taxable.toFixed(2));

}

function calculateGst(){

	var taxable_amt=  parseFloat($("#taxable_amt").val() || 0);
	var cgst_rate=  parseFloat($("#cgst_rate").val() || 0);
	var sgst_rate=  parseFloat($("#sgst_rate").val() || 0);

	var cgst_amtount=(taxable_amt*cgst_rate)/100;
	var sgst_amtount=(taxable_amt*sgst_rate)/100;

	$("#cgst_amt").val(cgst_amtount.toFixed(2));
	$("#sgst_amt").val(sgst_amtount.toFixed(2));

}


function calculateNetAmount(){

	var taxable_amt=parseFloat($("#taxable_amt").val() || 0);
	var cgst_amt=parseFloat($("#cgst_amt").val() || 0);
	var sgst_amt=parseFloat($("#sgst_amt").val() || 0);

	var net_amount=(taxable_amt+cgst_amt+sgst_amt);

	$("#net_amt").val(net_amount.toFixed(2));

}

function validateFacilityData(){

  var sel_member_code = $("#sel_member_code").val();
  var tran_dt = $("#tran_dt").val();
  var sel_member_code = $("#sel_member_code").val();
  var quantity = $("#quantity").val();
  var rate = $("#rate").val();


    $("#tran_dt,#sel_member_codeerr,#quantity,#rate").removeClass("form_error");
    $("#errormsg").text('');

  	 if (tran_dt=='') {
	 	 $("#tran_dt").addClass("form_error");
	 	 $('#errormsg').text('Error: Enter Tran. Date');
         $("#tran_dt").focus();
        return false;
	 }

     if(inputdatecheck(tran_dt) == 0){   
        $('#errormsg').text('Enter Date Between Accounting Year');
      return false;
     }

     if (sel_member_code=='') {
	 	 $("#sel_member_codeerr").addClass("form_error");
	 	 $('#errormsg').text('Error: Select member');
         $("#sel_member_code").focus();
         return false;
	 }

	 if (quantity=='' || quantity=='0') {
	 	 $("#quantity").addClass("form_error");
	 	 $('#errormsg').text('Error: Enter Qty/Hr');
         $("#quantity").focus();
         return false;
	 }

	  if (rate=='' || rate=='0') {
	 	 $("#rate").addClass("form_error");
	 	 $('#errormsg').text('Error: Enter rate');
         $("#rate").focus();
         return false;
	 }

	 return true;

 }