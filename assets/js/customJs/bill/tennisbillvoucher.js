$(document).ready(function(){

var basepath =$("#basepath").val();

$("#monthblock,#quarterblock").hide();


   $('#billing_style').on('change',function(e){
        e.preventDefault();
        var billing_style =$("#billing_style").val();
        $("#monthblock,#quarterblock").hide();
      	if (billing_style=='M') {
      		$("#monthblock").show();
      		 $("#quarter_month").val('').change();
      	}else if (billing_style=='Q') {
      		$("#quarterblock").show();
      		 $("#month").val('').change();
      	}

   });



 $('#month,#quarter_month,#billing_style').on('change', function(e) {
        e.preventDefault();

        var billing_style = $("#billing_style").val();
        var month = $("#month").val();
        var quarter_month = $("#quarter_month").val();

        if(billing_style!='') {
        if(month != '' || quarter_month!='') {

            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'tenniscoachingtoaccounts/lastDateOfmonth';

            $.ajax({
                type: type,
                url: urlpath,
                data: { month: month,quarter_month:quarter_month,billing_style:billing_style },
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {

                    $("#voucher_dt").val(result.lastdate);

                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }

            });

		        } else {

		            $("#voucher_dt").val('');

		        }

        }else{

        		 $("#voucher_dt").val('');
        }



    });



 $(document).on('click', "#billVouchergeneratebtn", function(e) {

        e.preventDefault();

        $("#response_msg").html("");
        if (validateBillVoucherGenerate()) {


                var formDataserialize = $("#billVoucherGenerateFrom").serialize();
                formDataserialize = decodeURI(formDataserialize);
                console.log(formDataserialize);
                var formData = { formDatas: formDataserialize };
                console.log("formData");

                $("#response_msg").html("Processing please wait...");
                $.ajax({
                    type: "POST",
                    url: basepath + 'tenniscoachingtoaccounts/generateBillVoucherAction',
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    data: formData,
                    success: function(data) {

                        if (data.msg_status == 1) {
                            $("#response_msg").html(data.msg_data);
                            $("#student_list").html("");
                            // $('#membillGenerateFrom').trigger("reset");
                        } else {
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


function validateBillVoucherGenerate() {



    var billing_style = $("#billing_style").val();
    var month = $("#month").val();
    var quarter_month = $("#quarter_month").val();

    var bill_dt = $("#bill_dt").val();

    console.log(month);



    $("#errormsg").text("");

    $("#billing_styleerr,#bill_dterr,#montheerr,#quarter_montherr").removeClass("form_error");



      if (billing_style == '') {

        $("#billing_styleerr").addClass("form_error");

        return false;

     }


     if (billing_style == 'M') {

     	    if (month == '') {
		        $("#montheerr").addClass("form_error");
		        return false;
		    }

     }else{

     	    if (quarter_month == '') {
		        $("#quarter_montherr").addClass("form_error");
		        return false;
		    }

     }










    return true;

}
