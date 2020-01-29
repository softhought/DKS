$(document).ready(function(){

  var basepath = $("#basepath").val();
 
  var startDate = new Date($("#acstartDate").val());
  var endDate = new Date($("#acendDate").val());
 // $('.timeEntry').timeEntry({ampmPrefix: ' '});
  
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true,
    startDate: startDate,
    endDate: endDate
    
});

 $("#total_amount_value").html($("#total_amt").val());




  $(document).on('change','#sel_member_id',function(){
    
   var selectedCode = $('#sel_member_id').find('option:selected');
   //$("#studentname").val(selectedCode.data('name'));
    $("#errormsg,#response_msg").html('');
   var memberName = selectedCode.data('titleone') +" " +selectedCode.data('name');
   $("#membername").val(memberName);
   console.log(memberName);
  
 
 });
 
 $(document).on('input keyup','#correction_dt',function(){
   var correction_date= $(this).val();   
   
   $('#errormsg').text('');
   if (isDate(correction_date) == false) {
    
         $('#errormsg').text('Correction date is not valid');
   }
 
 });
 
 $(document).on('keyup input','#amount',function(){
 
 
   calculateGst();
   calculateNetAmount();
 
 });
 
 
 //form submit
 
 $(document).on('submit','#membercorrectionFrom',function(e){
   e.preventDefault();
 
       $("#errormsg,#response_msg").html('');
       var mode = $("#mode").val();
   if(validateCorrectionData())
   {
    
        
           var formDataserialize = $("#membercorrectionFrom").serialize();
           formDataserialize = decodeURI(formDataserialize);
           //console.log(formDataserialize);
 
           var formData = { formDatas: formDataserialize };
           var type = "POST"; //for creating new resource
           var urlpath = basepath + 'membercorrection/correctionentry_action';
           $("#correctionsavebtn").css('display', 'none');
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
             $('#membercorrectionFrom').trigger("reset");
             $('#sel_member_id').val(null).trigger("change")
             $("#correctionsavebtn").show();
             $("#loaderbtn").hide();
                     $("#response_msg").text(result.msg_data);
           }else{
 
             $("#response_msg").text(result.msg_data);
                         $("#correctionsavebtn").show();
             $("#loaderbtn").hide();
 
           }
         
             
            
 
                   } 
         else {
                       $("#response_msg").text(result.msg_data);
                        $("#correctionsavebtn").show();
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

//show list using credentials

$(document).on('click', "#correctionshowbtn", function(e) {
  e.preventDefault();


var from_dt = $("#from_dt").val();
var to_date = $("#to_date").val();
var sel_member = $("#sel_member").val();



  $('#Correction_list_data').html('');
   $("#loader").show();

$.ajax({
          type: "POST",
          url: basepath+'membercorrection/getCorrectionListByDate',
          dataType: "html",
          data: {from_dt:from_dt,to_date:to_date,sel_member:sel_member},
          
          success: function (result) {
             $("#loader").hide();
               $("#Correction_list_data").html(result);
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


});

 
 
 })
 
 
 function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
 }
 
 
 
 
 function calculateGst(){
 
  var amount=  parseFloat($("#amount").val() || 0);
  var cgst_rate=  parseFloat($("#cgst_rate").val() || 0);
  var sgst_rate=  parseFloat($("#sgst_rate").val() || 0);
 
  var cgst_amtount=(amount*cgst_rate)/100;
  var sgst_amtount=(amount*sgst_rate)/100;
 
  $("#cgst_amt").val(cgst_amtount.toFixed(2));
  $("#sgst_amt").val(sgst_amtount.toFixed(2));
 
 }
 
 
 function calculateNetAmount(){
 
  var amount=parseFloat($("#amount").val() || 0);
  var cgst_amt=parseFloat($("#cgst_amt").val() || 0);
  var sgst_amt=parseFloat($("#sgst_amt").val() || 0);
 
  var net_amount=(amount+cgst_amt+sgst_amt);
 
  $("#net_amt").val(net_amount.toFixed(2));
 
 }


 function validateCorrectionData(){

  var sel_member_id = $("#sel_member_id").val();
  var correction_dt = $("#correction_dt").val();  
  var description = $("#description").val();  
  var amount = $("#amount").val();
  

    $("#tran_date,#sel_member_codeerr,#description_err,#amount").removeClass("form_error");
    $("#errormsg").text('');

  	 if (correction_dt=='') {
        $("#correction_dt").addClass("form_error");
        $('#errormsg').text('Error: Enter Correction Date');
            $("#correction_dt").focus();
            return false;
   	 }

     if(inputdatecheck(correction_dt) == 0){   
        $('#errormsg').text('Error: Enter Date Between Accounting Year');
        return false;
     }

     
   if (sel_member_id=='') {
    $("#sel_member_codeerr").addClass("form_error");
    $('#errormsg').text('Error: Select member');
       $("#sel_member_id").focus();
       return false;
 }

  if (description=='') {
    $("#description_err").addClass("form_error");
    $('#errormsg').text('Error: Select Description');
    $("#description").focus();
    return false;
  }
   
   if (amount=='') {
    $("#amount").addClass("form_error");
    $('#errormsg').text('Error: Enter Amount');
       $("#amount").focus();
       return false;
   }

	 

	 return true;

 }