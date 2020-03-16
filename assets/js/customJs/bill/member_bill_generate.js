$(document).ready(function() {

    var basepath = $("#basepath").val();

    var total_amt = $("#total_amt").val();
    $("#total_amount_value").html(total_amt);


    $('#category').on('change', function(e) {
        e.preventDefault();

        var category = $("#category").val();
        if (category != '') {

            resetMemberDropdown(category);
        }

    });


    $('#month').on('change', function(e) {
        e.preventDefault();

        var month = $("#month").val();
        if (month != '') {

            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'memberbillgenerate/lastDateOfmonth';

            $.ajax({
                type: type,
                url: urlpath,
                data: { month: month },
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {

                    $("#bill_dt").val(result.lastdate);


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

    $(document).on('click', "#billgeneratebtn", function(e) {
        e.preventDefault();

        $("#response_msg").html("");
        if (validateBillGenerate()) {
            if (checkMonthProcess()) {

                var formDataserialize = $("#membillGenerateFrom").serialize();
                formDataserialize = decodeURI(formDataserialize);
                console.log(formDataserialize);

                var formData = { formDatas: formDataserialize };

                console.log("formData");

                $("#response_msg").html("Processing please wait...");
                $.ajax({
                    type: "POST",
                    url: basepath + 'memberbillgenerate/generateBillAction',
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


        }


    });


    $(document).on('click', "#memberbillshowbtn", function(e) {
        e.preventDefault();


        var category = $("#category").val();
        var sel_member = $("#sel_member").val();
        var month = $("#month").val();

        if (1) {
            $('#memberbill_list_data').html('');
            $("#loader").show();

            $.ajax({
                type: "POST",
                url: basepath + 'memberbillgenerate/getBillingdataByMonth',
                dataType: "html",
                data: { sel_member: sel_member, category: category, month: month },

                success: function(result) {
                    $("#loader").hide();
                    $("#memberbill_list_data").html(result);
                    $('.dataTable2').DataTable();
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


    $(document).on('click', '#bill_dtl_btn', function(e) {
        e.preventDefault();

        var bill_id = $(this).data("billid");

        if (1) {

            console.log(bill_id);

            $("#bill_details_data").html('');

            $.ajax({
                type: "POST",
                url: basepath + 'memberbillgenerate/getbillDetailsModelData',
                dataType: "html",
                data: { bill_id: bill_id },
                success: function(result) {

                    $("#billModalDetails").modal({ backdrop: false });

                    $("#bill_details_data").html(result);

                    // $('.select2').select2();
                    var selectedCode = $("#sel_student_code").find('option:selected');
                    //console.log(selectedCode);

                    $("#studentname").val(selectedCode.data('name'));

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


    //multiple bill print added by anil on 12-03-2020


    $(document).on('click', "#multiplebillprint", function(e) {
        e.preventDefault();

        var category = $("#category").val();
        var sel_member = $("#sel_member").val();
        var month = $("#month").val();

        if (category == '') {
            category = 0;
        }
        if (sel_member == '') {
            sel_member = 0;
        }
        if (month == '') {
            month = 0;
        }

        var URL = basepath + 'memberbillgenerate/multibillprintJasper/' + sel_member + '/' + category + '/' + month;
        var w = window.open(URL, '_blank');
        $(w.document).find('html').append('<head><title>Multiple Bill Print</title></head>');



    });



}); // end of class


function validateBillGenerate() {

    var month = $("#month").val();
    var bill_dt = $("#bill_dt").val();
    console.log(month);

    $("#errormsg").text("");
    $("#billing_styleerr,#bill_dterr,#montheerr,#quarter_montherr").removeClass("form_error");


    if (month == '') {
        $("#montheerr").addClass("form_error");
        return false;
    }



    // if (bill_dt=='') {
    //     $("#bill_dterr").addClass("form_error");
    //        return false;
    // }



    return true;
}





function resetMemberDropdown(category) {

    var basepath = $("#basepath").val();

    $.ajax({
        type: "POST",
        url: basepath + 'memberbillgenerate/resetMemberList',
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


function checkMonthProcess() {

    var month = $("#month").val();
    var basepath = $("#basepath").val();

    $("#response_msg").html("");

    if (month != '3') {
        return true
    } else {
        console.log(month);
        var status = false;

        $.ajax({
            url: basepath + "memberbillgenerate/chechnextYearData",
            type: "POST",
            dataType: 'json',
            data: { month: month },
            success: function(result) {

                if (result.status == 1) {
                    var status = true;
                } else {
                    var status = false;
                    $("#response_msg").html("Please create next accounting year first.");
                }


            },
            async: false
        });


    }

    return status;


}