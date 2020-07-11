$(document).ready(function(){

 var basepath = $("#basepath").val();

 $(document).on('change','#sel_member_code',function(){
   
  var selectedCode = $('#sel_member_code').find('option:selected');
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
  if(1)
  {
   
       
          var formDataserialize = $("#membercorrectionFrom").serialize();
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