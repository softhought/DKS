$(document).ready(function(){

	var basepath =$('#basepath').val();

	


 // generate bill tennis
$(document).on('click', "#billgeneratebtn", function(e) {
        e.preventDefault();

       $("#response_msg").html("");
       if (validateMinBill()){ 
       		

            var formDataserialize = $("#minimumbillingFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            console.log("formData");
          
           $("#response_msg").html("Processing please wait...");

           $.ajax({
           type: "POST",
           url: basepath+'minimumbilling/minimumeBillAction',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
           data: formData,
            success: function(data) { 
             
             if (data.msg_status==1) {
               $("#response_msg").html(data.msg_data);
               $("#student_list").html("");
              // $('#membillGenerateFrom').trigger("reset");
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



function validateMinBill(){
  
       var month =$("#month").val();

       console.log(month);

       $("#errormsg").text("");
       $("#montheerr").removeClass("form_error");

       if (month=='') {
           $("#montheerr").addClass("form_error");
              return false;
       }



    return true;
}



