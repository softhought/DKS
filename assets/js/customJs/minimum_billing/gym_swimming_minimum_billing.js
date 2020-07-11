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


    $(document).on('click', "#gymswmshowbtn", function(e) {
        e.preventDefault();

        var sel_member = $("#sel_member").val();
        var month = $("#month").val();
        var account = $("#account").val();

        if (1) {
            $('#gymswimming_list_data').html('');
            $("#loader").show();

            $.ajax({
                type: "POST",
                url: basepath + 'gymswimmingbill/gymswimmingbillFilter',
                dataType: "html",
                data:{month:month,account:account,sel_member:sel_member},

                success: function(result) {
                    $("#loader").hide();
                    $("#gymswimming_list_data").html(result);
                    $('.dataTable2').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'pdf', 'print'
                        ]
                    });
                    var total_amt = $("#total_amt").val();
                    $("#total_amount_value").html(total_amt);
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
            }); /*end ajax call*/

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
