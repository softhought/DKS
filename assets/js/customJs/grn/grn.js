$(document).ready(function() {

 var basepath = $('#basepath').val();

$(document).on('change','#purchase_order_no',function(){
   
  var selectedCode = $('#purchase_order_no').find('option:selected');
  $("#vendor_name").val(selectedCode.data('vendorname'));
  $("#pur_order_date").val(selectedCode.data('purdate'));
  console.log(selectedCode);
  loadPurchaseOrderDetails();
  

});

$(document).on('keyup input', '.rowquantitycls', function() {

	    var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        
        var rowquantity = parseFloat($("#rowquantity_"+rowDtlNo[1]).val() || 0);
        var rowquantityorg = parseFloat($("#rowquantityorg_"+rowDtlNo[1]).val() || 0);
        console.log("rowquantity: "+rowquantity);
        console.log("rowquantityorg: "+rowquantityorg);

        if (rowquantityorg<rowquantity) {
        	$("#rowquantity_"+rowDtlNo[1]).val('');
        }else{

        }

 });






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




   $(document).on('submit','#goodsReceiptNoteFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(validateMasterData())
        {     $('#entry_mode').attr("disabled", false); 

            var formDataserialize = $("#goodsReceiptNoteFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#patrecsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'goodsreceiptnote/grn_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    if (result.msg_status == 1) {

                       $("#loaderbtn").css('display', 'none');

                  	   window.location.replace(basepath+'goodsreceiptnote');
                   
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


  $(document).on('click', "#grnshowbtn", function(e) {
        e.preventDefault();


     var from_dt = $("#from_dt").val();
     var to_date = $("#to_date").val();
  
     

  if(1){
           $('#grn_list_data').html('');
           $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'goodsreceiptnote/getGrnListByDate',
                dataType: "html",
                data: {from_dt:from_dt,to_date:to_date},
                
                success: function (result) {
                     $("#loader").hide();
                     $("#grn_list_data").html(result);
                     $(".dataTable").DataTable();
                  	 
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



function loadPurchaseOrderDetails(){

     var basepath = $('#basepath').val();
	 var purchase_id= $("#purchase_order_no").val(); 

	 if (purchase_id!='') {
		$("#detail_itemamt table tbody tr").remove();
	    rowno++;
        $.ajax({
            type: "POST",
            url: basepath+'goodsreceiptnote/addRawMeterialDetail',
            dataType: "html",
            data: {
            		purchase_id:purchase_id,
            		
	            },
            success: function (result) {
                $("#rowno").val(rowno);
                $("#detail_itemamt table").show(); 
                $("#detail_itemamt table tbody").append(result);   
              
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

    	$("#detail_itemamt table tbody tr").remove();
    	//$("#detail_itemamt table tbody").append('');  

    }




}


function validateMasterData(){

     var grn_date=$("#grn_date").val();
     var vendor_id= $("#vendor_id").val();
   
        

     $("#grn_date").removeClass("form_error");
	 $('#error_msg').text('');
	 $('#errormsg').text('');

	 if (grn_date=='') {
	 	 $("#grn_date").addClass("form_error");
       
         return false;
	 }

	 if(inputdatecheck(grn_date) == 0){   
        $('#errormsg').text('Enter Date Between Accounting Year');
        return false;
     }






var meteriallist=0;

   $(".rowrawmeteriacls").each(function(){
   
        meteriallist = meteriallist + 1;
    });


    if(meteriallist==0){

       $('#errormsg').text('Add grn List');
         return false;

   }





	return true;
}

function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}