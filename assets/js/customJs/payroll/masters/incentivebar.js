$(document).ready(function(){

var basepath =$("#basepath").val();
$("#copy_div").hide();


$(document).on('click','#inccopybtn',function(){

  $("#add_div").toggle();
  $("#copy_div").toggle();
  $("#response_msg,#errormsg").text('');
});


 $(document).on('click', "#incentiveBarbtn", function(e) {

    	  e.preventDefault();

    	  var mode = $("#mode").val();

           $("#response_msg").html("");
       if (validateInc()) { 
            var formDataserialize = $("#incentiveBarFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };

            console.log("formData");
         
     
           $("#incentiveBarbtn").hide();
          
           $("#response_msg").html("Processing please wait...");
        $.ajax({
           type: "POST",
           url: basepath+'incentivebar/incentiveAction',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: formData,
            success: function(data) { 
             
             if (data.msg_status==1) {
               $("#response_msg").html(data.msg_data);
              
                 $('#sel_month,#employee').val(null).trigger("change")
               $('#incentiveBarFrom').trigger("reset");
               $("#incentiveBarbtn").show();
               if (mode=='EDIT') { window.location.replace(basepath+'incentivebar'); }
               
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





  /* insert copy month data */   


       $(document).on('click', "#incbarCopybtn", function(e) {

        e.preventDefault();
 	    var month_id = $("#month_id").val();

           $("#response_msg").html("");
       if (validateIncBarCopyData()) { 
            var formDataserialize = $("#incentiveBarFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };

            console.log("formData");
         
     
          $("#incbarCopybtn").hide();
          
           $("#response_msg").html("Processing please wait...");
        $.ajax({
           type: "POST",
           url: basepath+'incentivebar/incBarCopyMonthAction',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: formData,
            success: function(data) { 
              $("#incbarCopybtn").show();
             if (data.msg_status==1) {
               $("#response_msg").html(data.msg_data);
               $("#member_list").html("");
                 $('#copy_from_month,#copycategory,#copy_to_month').val(null).trigger("change");

               $('#incentiveBarFrom').trigger("reset");
             }else{
               $("#response_msg").html(data.msg_data);
               window.location.replace(basepath+'incentivebar');

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



$(document).on("click","#incentivebarviewbtn",function(){


  var month_id = $("#month_id").val();

  $("#month_iderr").removeClass("form_error");
      
	  	if(month_id=="")
	    {
	        $("#month_id").focus();
	        $("#month_iderr").addClass("form_error");
	        return false;
	    }

     
        $.ajax({
           type: "POST",
           url: basepath+'incentivebar/incentivebarListByMonth',
           dataType: "html",
           data: {month_id:month_id},
            success: function(data) { 
             
             $("#incentivebarlist").html(data);
              $('.dataTable').DataTable();
              $("#total_amount_value").text($("#total_amt").val());

            },

          });
})









}); // end of document ready

function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}

function validateInc(){

  var amount = $("#amount").val();
  var sel_month =$("#sel_month").val();
  var employee =$("#employee").val();

     
	  $("#errormsg").text("");

	  $("#sel_montherr,#employeeerr,#amounterr").removeClass("form_error");
      
	  	if(sel_month=="")
	    {
	        $("#sel_month").focus();
	        $("#sel_montherr").addClass("form_error");
	        return false;
	    }

	    if(employee=="")
	    {
	        $("#employeeerr").focus();
	        $("#employeeerr").addClass("form_error");
	        return false;
	    }

	    if(amount=="")
	    {
	        $("#amount").focus();
	        $("#amounterr").addClass("form_error");
	        return false;
	    }







 
    return true;
}


function validateIncBarCopyData(){
//return true;

          var copy_from_month =$("#copy_from_month").val();
        
          var copy_to_month =$("#copy_to_month").val();

  $("#copy_from_montherr,#copycategoryerr,#copy_to_montherr").removeClass("form_error");

  $("#errormsg").text("");
       
        
    if (copy_from_month=='') {
       $("#copy_from_montherr").addClass("form_error");
          return false;
     }



    if (copy_to_month=='') {
       $("#copy_to_montherr").addClass("form_error");
          return false;
     }

      if (copy_from_month==copy_to_month) {
       $("#copy_from_montherr").addClass("form_error");
       $("#copy_to_montherr").addClass("form_error");
       $("#errormsg").text("Error : Copy from month to month same");
          return false;
     }
   
   





 
    return true;
}