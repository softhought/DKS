$(document).ready(function(){

 var basepath = $("#basepath").val();

$("#isopeningadvance").change(function() {
        if($(this).prop('checked')) {
            //alert("Checked Box Selected");
            $('.accrow').hide();
        } else {
           // alert("Checked Box deselect");
           $('.accrow').show();
        }
    });


 var mode = $("#mode").val();

 if (mode=='EDIT') {

 	   if($("#isopeningadvance").prop('checked')){
            //alert("Checked Box Selected");
            $('.accrow').hide();
            $("#cheque_no").val("");
        }else{
           // alert("Checked Box deselect");
           $('.accrow').show();
        }

 }






$(document).on('click','.editadj',function(event)
    {
        event.preventDefault();

            $("#emp_name,#rowid,#newadjamt,#oldadjamt").val("");
           

            var row = $(this).attr('id');
            var arrayId = row.split("_");
            var employeename = $("#employeename_"+arrayId[1]).val();
            var adjAmt = $("#adjAmt_"+arrayId[1]).val();

            $("#emp_name").val(employeename);
            $("#rowid").val(arrayId[1]);
            $("#newadjamt").val(adjAmt);
            $("#oldadjamt").val(adjAmt);
           
                
    });



$(document).on('click','#updatebtn',function(event)
    {
        event.preventDefault();

         var rowid = $("#rowid").val();
         var newadjamt = $("#newadjamt").val()||0;

         $("#adjAmt_"+rowid).val(newadjamt);
         $("#monthdeduction_"+rowid).text(newadjamt);

         $("#emp_name,#rowid,#newadjamt,#oldadjamt").val("");

                
    });









$(document).on('submit','#paymentAdvanceFrom',function(event)
    {
        event.preventDefault();

          $("#errormsg").text('');
          var mode = $("#mode").val();

        if(validateMasterData())
        {     
        	$('#entry_mode').attr("disabled", false); 

            var formDataserialize = $("#paymentAdvanceFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#loansavebtn").css('display', 'none');
             $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'paymentadvance/paymentadvance_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    if (result.msg_status == 1) {
                       $("#loaderbtn").css('display', 'none');

                   			 window.location.replace(basepath+'paymentadvance');
                 
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


$(document).on('click','#showloanbtn',function(event)
    {
        event.preventDefault();

        

        var month = $("#month").val();
        $("#montherr").removeClass("form_error");
        if (month == '') {
            $("#montherr").addClass("form_error");
            return false;
        }
        $("#heads").val('0');
        $("#response_msg").html("Processing please wait...");
        $('#loader').show();
      
       
        var urlpath = basepath + 'paymentadvance/loanListview';
        $("#employee_list").html('');
        $.ajax({
            type: "POST",
            url: urlpath,
            data: {month:month},
            dataType: "html",
            success: function(result) {
                $('#loader').hide();
                $("#employee_list").html(result);
                //  $('.dataTable').DataTable();
                // $('.dataTable').DataTable({
                //     "paging": false,
                //     "ordering": false,
                //     "info": false

                // });



                //  var tripReportProject = $("#tripReportProject").val();
                $("#response_msg").html("");

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
        });

    });



$(document).on('click','#loanadjustsavebtn',function(event)
    {
        event.preventDefault();

          $("#errormsgsave").text('');
          var mode = $("#mode").val();
         

        if(1)
        {     

            var formDataserialize = $("#loanAdjustmentFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#loanadjustsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'paymentadvance/loanadjustment_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    if (result.msg_status == 1) {
                       $("#loaderbtn").css('display', 'none');

                       $("#errormsgsave").text(result.msg_data);
                 
                    } 
                    else {
                         
                      $("#errormsgsave").text(result.msg_data);
                     
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



$(document).on('click', "#loanprintbtn", function(e){

      
        e.preventDefault();
        e.stopImmediatePropagation();

        var basepath = $('#basepath').val();
        var month = $('#month').val();
         $("#montherr").removeClass("form_error");

        if (month == '') {
            $("#montherr").addClass("form_error");
            return false;
        }
        else{
            $('#loanAdjustmentFrom').prop('action', basepath+'paymentadvance/getLoanAdjustmentListPrint');
            $("#loanAdjustmentFrom").submit();
        }


});










}); // end of document ready

function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}


function validateMasterData(){

     var advance_date=$("#advance_date").val();
     var employee=$("#employee").val();
     var advance_amount=$("#advance_amount").val();
     var monthly_deduction=$("#monthly_deduction").val();
     var actobe_debited=$("#actobe_debited").val();
     var actobe_credited=$("#actobe_credited").val();


   	 $("#advance_date,#employeeerr,#advance_amount,#monthly_deduction,#actobe_debitederr,#actobe_creditederr").removeClass("form_error");
	 $('#error_msg').text('');
	 $('#errormsg').text('');

	 if (advance_date=='') {
	 	 $("#advance_date").addClass("form_error");
       
         return false;
	 }

	 if(inputdatecheck(advance_date) == 0){   
        $('#errormsg').text('Enter Date Between Accounting Year');
      return false;
     }

     if (employee=='') {
	 	 $("#employeeerr").addClass("form_error");
         return false;
	 }

	 if (advance_amount=='') {
	 	 $("#advance_amount").addClass("form_error");
         return false;
	 }

	 if (monthly_deduction=='') {
	 	 $("#monthly_deduction").addClass("form_error");
         return false;
	 }

	    if($("#isopeningadvance").prop('checked')) {
            //alert("Checked Box Selected");
           // $('.accrow').hide();
        } else {

        	 if (actobe_debited=='') {
			 	 $("#actobe_debitederr").addClass("form_error");
		         return false;
			 }


			  if (actobe_credited=='') {
			 	 $("#actobe_creditederr").addClass("form_error");
		         return false;
			 }
          



        }






	return true;
}