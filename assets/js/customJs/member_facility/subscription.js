$(document).ready(function(){

var basepath =$("#basepath").val();

$("#subscriptionAmountApplybtn").hide();
$("#copy_div").hide();



    $('#subscriptionfeestbtn').on('click',function(e){
        e.preventDefault();

        var category =$("#category").val();
         $("#categoryerr").removeClass("form_error");
	    if (category=='') {
		 	 $("#categoryerr").addClass("form_error");
	        return false;
		 }
		 	   $("#heads").val('0');
            $("#response_msg").html("Processing please wait...");
            $('#loader').show();
            $("#subscriptionAmountApplybtn").hide();
            var formDataserialize = $("#subscriptionFrom").serialize();
            var urlpath = basepath + 'membersubscription/memberListview';
            $("#member_list").html('');
            $.ajax({        
                type: "POST",
                url: urlpath,
                data:formDataserialize,
                dataType: "html",            
                success: function(result) {
                    $('#loader').hide();  
                    $("#member_list").html(result);
                   //  $('.dataTable').DataTable();
                    $('.dataTable').DataTable( {
				        "paging":   false,
				        "ordering": false,
				        "info":     false
				    } );

        

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


     $(document).on('click', ".rowCheckAll", function() {     
       var i=0;

     
        if($("#rowCheckAll").is(':checked')){
        console.log("checked");
        $('.rowCheck').prop('checked', true);
        $("#subscriptionAmountApplybtn").show();

        }
        else{
        console.log("unchecked");
        $('.rowCheck').prop('checked',false);
        $("#subscriptionAmountApplybtn").hide();
       
        }

        $(".rowCheck").each(function(){

        	console.log(i++)
          });
   var checkbox = $("input:checkbox.rowCheck:checked").length;  
   $("#heads").val(checkbox);

 }); 


 $(document).on('click', ".rowCheck", function() {     
   
   var flag=0;  
    var checkbox = $("input:checkbox.rowCheck:checked").length; 
   $("#heads").val(checkbox);
       $(".rowCheck").each(function(){

        if($(this).is(':checked')){
        console.log("checkedsingle");
          flag=1;
        }

       });

       if (flag) { $("#subscriptionAmountApplybtn").show();}else{ $("#subscriptionAmountApplybtn").hide();}

 });



     $(document).on('click', "#subscriptionAmountApplybtn", function(e) {

    	  e.preventDefault();
        
        var Id = $(this).attr('id');
        var detailIdarr = Id.split('_');
        var master_id = detailIdarr[1];
           $("#response_msg").html("");
       if (validateSubscriptionFees()) { 
            var formDataserialize = $("#subscriptionFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };

            console.log("formData");
         
     
           $("#subscriptionAmountApplybtn").hide();
          
           $("#response_msg").html("Processing please wait...");
        $.ajax({
           type: "POST",
           url: basepath+'membersubscription/subscriptionFeeAction',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: formData,
            success: function(data) { 
             
             if (data.msg_status==1) {
               $("#response_msg").html(data.msg_data);
               $("#member_list").html("");
                 $('#sel_month,#category').val(null).trigger("change")
               $('#developmentFrom').trigger("reset");
             }else{
               $("#response_msg").html(data.msg_data);
             }
            
           
            },
            complete: function() {
                // $("#stock_loader").hide();

            },
            error: function(e) {
                //called when there is an error
                console.log(e.message);
            }
        });

    }

      
    });




$("#total_amount_value").text($("#total_amt").val());

$(document).on("change",".searchdata",function(){

  var member_code = $("#member_code").val();
  var category = $("#category").val();


     
        $.ajax({
           type: "POST",
           url: basepath+'membersubscription/subscriptionfeespartiallist',
           dataType: "html",
           data: {member_code:member_code,category_id:category},
            success: function(data) { 
             
             $("#subscriptionlist").html(data);
              $('.dataTable').DataTable();
              $("#total_amount_value").text($("#total_amt").val());

            },

          });
})



}); // end of document ready


function validateSubscriptionFees(){

  var checkbox = $("input:checkbox:checked").length;
  console.log("C"+checkbox);
  var subscription = $("#subscription").val();
  $("#errormsg").text("");
  $("#billing_styleerr,#sel_montherr,#subscriptionerr").removeClass("form_error");


    if(checkbox=="0")
    {
        $("#checkbox").focus().addClass("custom_err");
        $("#errormsg")
        .text("Error : Select Checkbox");
        return false;
    }

    if(subscription=="")
    {
        $("#subscription").focus();
        $("#subscriptionerr").addClass("custom_err");
        return false;
    }


 
    return true;
}



function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}