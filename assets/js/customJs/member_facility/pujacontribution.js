$(document).ready(function(){

var basepath =$("#basepath").val();


$("#pujacontributionApplybtn").hide();
$("#copy_div").hide();

$(document).on('click','#pujacontributioncopybtn',function(){

console.log($('#cpspan').html());



  $("#add_div").toggle();
  $("#copy_div").toggle();
  $("#response_msg,#errormsg").text('');
});


/* load copy data view on change */

$(document).on('change','#copy_from_month,#copycategory',function(){
    var copy_from_month =$("#copy_from_month").val();
    var copycategory =$("#copycategory").val();

  

   $("#member_list").html('');
    if (copy_from_month!="" && copycategory!="") {
        console.log("m "+copy_from_month);
    console.log("c "+copycategory);
          copyDataView();
    }else{
        /* need to reset list */
         $("#member_list").html('');
    }


});




$(document).on('keyup input','#contribution,#service_tax',function(){
   var contribution=parseFloat($("#contribution").val() || 0);
   var service_tax=parseFloat($("#service_tax").val() || 0);
   var amount=(contribution+service_tax);
    $("#total").val(amount.toFixed(2));

});







    $('#pujacontributionbtn').on('click',function(e){
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
            $("#pujacontributionApplybtn").hide();
            var formDataserialize = $("#pujacontributionFrom").serialize();
            var urlpath = basepath + 'pujacontribution/memberListview';
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
        $("#pujacontributionApplybtn").show();

        }
        else{
        console.log("unchecked");
        $('.rowCheck').prop('checked',false);
        $("#pujacontributionApplybtn").hide();
       
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

       if (flag) { $("#pujacontributionApplybtn").show();}else{ $("#pujacontributionApplybtn").hide();}

 });



     $(document).on('click', "#pujacontributionApplybtn", function(e) {

    	  e.preventDefault();
        
        var Id = $(this).attr('id');
        var detailIdarr = Id.split('_');
        var master_id = detailIdarr[1];
           $("#response_msg").html("");
       if (validatePujacontribution()) { 
            var formDataserialize = $("#pujacontributionFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };

            console.log("formData");
         
     
           $("#pujacontributionApplybtn").hide();
          
           $("#response_msg").html("Processing please wait...");
        $.ajax({
           type: "POST",
           url: basepath+'pujacontribution/pujacontributionAction',
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
  var month_id = $("#month_id").val();


     
        $.ajax({
           type: "POST",
           url: basepath+'pujacontribution/pujacontributionpartiallist',
           dataType: "html",
           data: {member_code:member_code,category_id:category,month_id:month_id},
            success: function(data) { 
             
             $("#pujacontributionlist").html(data);
              $('.dataTable').DataTable();
              $("#total_amount_value").text($("#total_amt").val());

            },

          });
})



  /* insert copy month data */   


  $(document).on('click', "#pujacontributionCopybtn", function(e) {

        e.preventDefault();

           $("#response_msg").html("");
       if (validateCopyData()) { 
            var formDataserialize = $("#pujacontributionFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };

            console.log("formData");
         
     
           $("#pujacontributionCopybtn").hide();
          
           $("#response_msg").html("Processing please wait...");
        $.ajax({
           type: "POST",
           url: basepath+'pujacontribution/pujacontributionCopyMonthAction',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: formData,
            success: function(data) { 
              $("#pujacontributionCopybtn").show();
             if (data.msg_status==1) {
               $("#response_msg").html(data.msg_data);
               $("#member_list").html("");
                 $('#copy_from_month,#copycategory,#copy_to_month').val(null).trigger("change")
               $('#pujacontributionFrom').trigger("reset");
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









}); // end of document ready


function validatePujacontribution(){

  var checkbox = $("input:checkbox:checked").length;
  console.log("C"+checkbox);
  
  var sel_month = $("#sel_month").val();
  var category = $("#category").val();
  var contribution = $("#contribution").val();
  $("#errormsg").text("");
  $("#billing_styleerr,#sel_montherr,#subscriptionerr,#categoryerr,#contributionerr").removeClass("form_error");


    

    if (sel_month=='') {
       $("#sel_montherr").addClass("form_error");
          return false;
     }    

  if (category=='') {
       $("#categoryerr").addClass("form_error");
          return false;
     }


    if(checkbox=="0")
    {
        $("#checkbox").focus().addClass("custom_err");
        $("#errormsg")
        .text("Error : Select Checkbox");
        return false;
    }

    if(contribution=="")
    {
        $("#contribution").focus();
        $("#contributionerr").addClass("custom_err");
        return false;
    }


 
    return true;


}



function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}



function copyDataView(){

  var basepath =$("#basepath").val();

     $("#response_msg,#errormsg").text('');
console.log("copyDataView")


         $("#heads").val('0');
            $("#response_msg").html("Loading please wait...");
            $('#loader').show();
            $("#pujacontributionApplybtn").hide();
            var formDataserialize = $("#pujacontributionFrom").serialize();
            var urlpath = basepath + 'pujacontribution/memberPujaConListviewforCopy';
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

}


function validateCopyData(){
//return true;

          var copy_from_month =$("#copy_from_month").val();
          var copycategory =$("#copycategory").val();
          var copy_to_month =$("#copy_to_month").val();

  $("#copy_from_montherr,#copycategoryerr,#copy_to_montherr").removeClass("form_error");

  $("#errormsg").text("");
       
        
    if (copy_from_month=='') {
       $("#copy_from_montherr").addClass("form_error");
          return false;
     }

    if (copycategory=='') {
       $("#copycategoryerr").addClass("form_error");
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