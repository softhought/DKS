$(document).ready(function(){

	var basepath =$('#basepath').val();


// generate bill tennis

$(document).on('click', "#generateKotbtn", function(e) {
        e.preventDefault();

       $("#response_msg").html("");
       if (validate()){ 
       		

            var formDataserialize = $("#kotGenerateFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            console.log("formData");
          
           $("#response_msg").html("Processing please wait...");

           $.ajax({
           type: "POST",
           url: basepath+'gymswimmingbill/minimumeBillAction',
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




}); // end of class




function validate(){
  
       var month =$("#month").val();
       var account =$("#account").val();
       var kot_type = $("input[name='kot_type']:checked").length;

       console.log(kot_type);

       $("#errormsg").text("");
       $("#montheerr,#accounterr").removeClass("form_error");

        if (month=='') {
           $("#montheerr").addClass("form_error");
              return false;
       }

       if (account=='') {
           $("#accounterr").addClass("form_error");
              return false;
       }

       if (kot_type=='0') {
       	$("#errormsg").text("Select Monthly/Yearly KOT");return false;
       }



    return true;
}
