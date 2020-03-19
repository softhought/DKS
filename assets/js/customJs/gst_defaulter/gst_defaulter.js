$(document).ready(function() {

	var basepath = $('#basepath').val();
	$("#noticeApplybtn").hide();


    $('#category').on('change', function(e) {
        e.preventDefault();
        var category = $("#category").val();
        if (category != '') {

            resetMemberDropdown(category);
        }

    });



  $(document).on('click', "#defaultershowbtn", function(e) {
        e.preventDefault();

       var category =$("#category").val();
       var billing_upto =$("#billing_upto").val();
       var notice_date =$("#notice_date").val();
       var member_id =$("#member_id").val();
       var equal_above =$("#equal_above").val();
     
  if(validate()){
         $('#memberbill_list_data').html('');
         $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'gstdefaulter/getDefaluterMemberList',
                dataType: "html",
                data: {
	                	category:category,
	                	billing_upto:billing_upto,
	                	notice_date:notice_date,
	                	member_id:member_id,
	                	equal_above:equal_above,
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




$(document).on('click', "#defaulterprintbtn", function(e) {
        e.preventDefault();

       var category =$("#category").val();
       var billing_upto =$("#billing_upto").val();
       var notice_date =$("#notice_date").val();
       var member_id =$("#member_id").val();
       var equal_above =$("#equal_above").val();
     
  if(validate()){
         $('#memberbill_list_data').html('');
         $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'gstdefaulter/getDefaluterMemberList',
                dataType: "html",
                data: {
                    category:category,
                    billing_upto:billing_upto,
                    notice_date:notice_date,
                    member_id:member_id,
                    equal_above:equal_above,
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








    $(document).on('click', ".rowCheckAll", function() {
        var i = 0;


        if ($("#rowCheckAll").is(':checked')) {
            console.log("checked");
            $('.rowCheck').prop('checked', true);
            $("#noticeApplybtn").show();

        } else {
            console.log("unchecked");
            $('.rowCheck').prop('checked', false);
            $("#noticeApplybtn").hide();

        }

        $(".rowCheck").each(function() {

            console.log(i++)
        });
        var checkbox = $("input:checkbox.rowCheck:checked").length;
        $("#heads").val(checkbox);

    });


    $(document).on('click', ".rowCheck", function() {

        var flag = 0;
        var checkbox = $("input:checkbox.rowCheck:checked").length;
        $("#heads").val(checkbox);
        $(".rowCheck").each(function() {

            if ($(this).is(':checked')) {
                console.log("checkedsingle");
                flag = 1;
            }

        });

        if (flag) { $("#noticeApplybtn").show(); } else { $("#noticeApplybtn").hide(); }

    });




    $(document).on('submit', "#noticeApplybtn", function(e) {

        e.preventDefault();

        var Id = $(this).attr('id');
        var detailIdarr = Id.split('_');
        var master_id = detailIdarr[1];
        $("#response_msg").html("");
        if (validateDefaulterNotice()) {
            var formDataserialize = $("#gstDefaulterFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            console.log("formData");

			
             $("#gstDefaulterFrom").submit();

            $("#noticeApplybtn").hide();

            $("#response_msg").html("Processing please wait...");
          

        }


    });




	


}); // end of document ready


function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}

function resetMemberDropdown(category) {

    var basepath = $("#basepath").val();

    $.ajax({
        type: "POST",
        url: basepath + 'gstdefaulter/resetMemberList',
        dataType: "html",
        data: { category: category },
        success: function(result) {

            $("#member_drp").html(result);
            $('.select2').select2();

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



function validate(){
  
       var category =$("#category").val();
       var billing_upto =$("#billing_upto").val();
       var notice_date =$("#notice_date").val();
       var member_id =$("#member_id").val();
       var equal_above =$("#equal_above").val();
       
       $("#errormsg").text("");
       $("#categoryerr,#billing_uptoerr,#notice_date,#equal_above").removeClass("form_error");

       if (billing_upto=='') {
           $("#billing_uptoerr").addClass("form_error");
              return false;
       }

       if (notice_date=='') {
           $("#notice_date").addClass("form_error");
              return false;
       }

       if (equal_above=='') {
           $("#equal_above").addClass("form_error");
              return false;
       }




    
  
    return true;
}



function validateDefaulterNotice() {

    var checkbox = $("input:checkbox:checked").length;

    var billing_upto =$("#billing_upto").val();
    var notice_date =$("#notice_date").val();
    var equal_above =$("#equal_above").val();

    $("#errormsg").text("");
    $("#categoryerr,#billing_uptoerr,#notice_date,#equal_above").removeClass("form_error");


    if (checkbox == "0") {
        $("#checkbox").focus().addClass("custom_err");
        $("#errormsg")
            .text("Error : Select Checkbox");
        return false;
    }


    return true;
}