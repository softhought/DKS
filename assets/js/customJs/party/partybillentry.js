$(document).ready(function() {

    var basepath = $("#basepath").val();

    $('.numberonly').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9/.]/g, '');

    });



    //form submit

    $(document).on('submit', '#partybillentryform', function(event) {
        event.preventDefault();
        $("#errormsg").text('');
        var mode = $("#mode").val();

        if (valiadtform()) {


            var formDataserialize = $("#partybillentryform").serialize();
            formDataserialize = decodeURI(formDataserialize);

            var formData = { formDatas: formDataserialize };

            $("#billentrysavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');


            $.ajax({
                type: "POST",
                url: basepath + 'partybillentry/partybillentry_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,

                success: function(result) {

                    if (result.msg_status == 1) {
                        if (mode == 'EDIT') {

                            $("#billentrysavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'partybillentry';
                            //showMsg();

                        } else {

                            $("#errormsg").removeClass('errormsgcolor');
                            $("#errormsg").text(result.msg_data).addClass('succmsg');
                            $("#billentrysavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'partybillentry/addPartyBillEntry';

                        }



                    } else {

                    }


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


});


function valiadtform() {

    var mode = $("#mode").val();
    var bill_no = $('#bill_no').val();
    var bill_date = $('#bill_date').val();
    var vender_account_id = $('#vender_account_id').val();
    var bill_amount = $.trim($('#bill_amount').val());
    var account_id = $('#account_id').val();
    // var stock_in_hand = $("#stock_in_hand").val();

    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    $('#errormsg').text();

    if (bill_no == '') {
        $('#errormsg').text('Error: Enter Bill No.');
        $("#bill_no").focus();
        return false;
    } else if (bill_date == '') {
        $('#errormsg').text('Error: Enter Bill Date');
        $("#bill_date").focus();
        return false;
    } else if (isDate(bill_date) == false) {
        $('#errormsg').text('Error: Enter Correct Bill Date');
        $("#bill_date").focus();
        return false;
    } else if (vender_account_id == '') {
        $('#errormsg').text('Error: Select Party');
        $("#vender_account_id").focus();
        return false;

    } else if (bill_amount == '') {
        $('#errormsg').text('Error: Enter Bill Amount');
        $("#bill_amount").focus();
        return false;

    } else if (account_id == '') {
        $('#errormsg').text('Error: Select Account To Be Debited');
        $("#account_id").focus();
        return false;

    }
    if (mode == 'ADD' && Validitebillno(bill_no, vender_account_id)) {

        $('#errormsg').text('Error: Bill No. Already Used');
        $("#bill_no").focus();
        return false;


    }

    return true;
}

function Validitebillno(bill_no, vender_account_id) {
    var basepath = $("#basepath").val();
    var txt = 0;

    $.ajax({
        type: "POST",
        url: basepath + 'partybillentry/checkbillno',
        dataType: "json",
        data: { bill_no: bill_no, vender_account_id: vender_account_id },
        async: false,
        success: function(result) {

            txt = result.msg_status;

        }
    });

    return txt;

}