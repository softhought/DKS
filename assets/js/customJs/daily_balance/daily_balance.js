$(document).ready(function() {

    var basepath = $("#basepath").val();
    var startDate = new Date($("#acstartDate").val());
    var endDate = new Date($("#acendDate").val());
    // $('.timeEntry').timeEntry({ampmPrefix: ' '});

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: startDate,
        endDate: endDate

    });


        $(document).on('change', '#sel_member_code', function() {

        var selectedCode = $('#sel_member_code').find('option:selected');
        $("#member_name").val(selectedCode.data('name'));
        console.log(selectedCode);
      
       


    });


      $('#processing_dt').on('change', function(e) {
        e.preventDefault();

        var processing_dt = $("#processing_dt").val();
        if (processing_dt != '') {

            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'dailybalance/lastDateOfmonth';

            $.ajax({
                type: type,
                url: urlpath,
                data: { processing_dt: processing_dt },
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {

                    $("#billing_month").val(result.billing_month);


                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });


        } else {
            $("#bill_dt").val('');
        }

    });


   // generate bill tennis
$(document).on('click', "#dailybalanceupdatebtn", function(e) {
        e.preventDefault();

       $("#response_msg").html("");
       if (validateDailyBalance()){ 
       		

            var formDataserialize = $("#dailyBalanceFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            console.log("formData");
          
           $("#response_msg").html("Processing please wait...");

           $.ajax({
           type: "POST",
           url: basepath+'dailybalance/dailyBalanceAction',
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




  $(document).on('click', "#dailybalancehowbtn", function(e) {
        e.preventDefault();

       var from_dt =$("#from_dt").val();
       var to_dt =$("#to_dt").val();
       var member_id =$("#sel_member_code").val();
       
     
  if(validate()){
         $('#memberbill_list_data').html('');
         $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'dailybalance/getDailyBalanceMemberList',
                dataType: "html",
                data: {

	                	from_dt:from_dt,
	                	to_dt:to_dt,
	                	member_id:member_id,
	                	
                 },
                
                success: function (result) {
                   $("#loader").hide();
                     $("#memberbill_list_data").html(result);
                    // $(".dataTable").DataTable();
                    
                 
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


function validateDailyBalance(){
  
       var processing_dt =$("#processing_dt").val();

       console.log(processing_dt);

       $("#errormsg").text("");
       $("#processing_dt").removeClass("form_error");

       if (processing_dt=='') {
           $("#processing_dt").addClass("form_error");
              return false;
       }



    return true;
}




function validate(){
  

       var member_id =$("#sel_member_code").val();
       
       $("#errormsg").text("");
       $("#member_drp").removeClass("form_error");

       if (member_id=='') {
           $("#member_drp").addClass("form_error");
              return false;
       }





    
  
    return true;
}