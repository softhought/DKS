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
        $("#member_start_letter").val('');
        console.log(selectedCode);
    });




  $(document).on('click', "#blockunblockshowbtn", function(e) {
        e.preventDefault();

       var member_start_letter =$("#member_start_letter").val();
       var member_id =$("#sel_member_code").val();
       var sel_block_unblock =$("#sel_block_unblock").val();
       var balance =$("#balance").val() || 0;

       
       
     
  if(1){
         $('#member_list_data').html('');
         $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'blockunblockregister/getBlockUnblockMemberList',
                dataType: "html",
                data: {
                        member_start_letter:member_start_letter,
                        sel_block_unblock:sel_block_unblock,
                        member_id:member_id,
                        balance:balance,  
                     },
                
                success: function (result) {
                   $("#loader").hide();
                     $("#member_list_data").html(result);
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




      $(document).on('submit', "#printblockunblockbtn", function(e) {

        e.preventDefault();

 
        $("#response_msg").html("");
        if (1) {
            var formDataserialize = $("#blockunblockFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            console.log("formData");

            
             $("#blockunblockFrom").submit();

          
          

        }


    });



}); // end of document ready