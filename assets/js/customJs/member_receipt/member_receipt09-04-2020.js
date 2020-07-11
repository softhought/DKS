$(document).ready(function() {

    var basepath = $('#basepath').val();
    $("#adm_block").hide();
    $("#receivable_amt_block").hide();

    $(document).on('change', '#sel_member_code', function() {

        var selectedCode = $('#sel_member_code').find('option:selected');
        $("#member_name").val(selectedCode.data('name'));
        console.log(selectedCode);
        var mode = $('#mode').val();
        if (mode=='ADD') {
             resetNewMember();
        }
       


    });


$(document).on('change', '#sel_tran_related', function() {

        var tran_related = $("#sel_tran_related").val();
         $('#total_amount').prop('readonly', true);
         $('#adm_fees,#sub_coach_fees').prop('readonly', false);
          $('#member_name').prop('readonly', true);

        if (tran_related=='O') {

             $('#total_amount').prop('readonly', false);
             $('#adm_fees,#sub_coach_fees').prop('readonly', true);
             $('#member_name').prop('readonly', false);

        }
       
   


    });









    var total_amt = $("#total_amt").val();
    $("#total_amount_value").html(total_amt);

    var ac_deb = $('select[name="actobedebited"] option:selected').text();

    if (ac_deb == "CHEQUE IN HAND") {
        $('#cheque_bank_dtl').show();
    }

    var mode = $('#mode').val();

    if(mode=='EDIT'){

         var tran_type = $('#tran_type').val();
         $('#adm_fees,#sub_coach_fees').prop('readonly', false);
           $('#sel_tran_related').prop('disabled', false);

      if (tran_type == "ORITM") {

            $('#adm_block').css({ backgroundColor: '#fff' });
            $('#receivable_block').css({ backgroundColor: '#f7eeee' });
            $('#item_block').css({ backgroundColor: '#f7eeee' });
            $("#adm_block").hide();
            $("#receivable_amt_block").hide();
           
        } else if (tran_type == "RCFM") {

            $('#receivable_block').css({ backgroundColor: '#f7eeee' });
            $('#adm_block').css({ backgroundColor: '#fff' });
            $('#item_block').css({ backgroundColor: '#fff' });
            $("#adm_block").hide();
            $("#receivable_amt_block").show();
            $('#adm_fees,#sub_coach_fees').prop('readonly', true);
             $('#sel_tran_related').prop('disabled', true);

        }else if (tran_type == "ORADM") {
            $("#adm_block").show();
            $("#receivable_amt_block").hide();
            $('#receivable_block').css({ backgroundColor: '#ffff' });
            $('#adm_block').css({ backgroundColor: '#f7eeee' });
            $('#item_block').css({ backgroundColor: '#f7eeee' });


        }


            var tran_related = $("#sel_tran_related").val();
         $('#total_amount,member_name').prop('readonly', true);
         $('#adm_fees,#sub_coach_fees').prop('readonly', false);

        if (tran_related=='O') {
             $('#member_name').prop('readonly', false);
             $('#total_amount').prop('readonly', false);
             $('#adm_fees,#sub_coach_fees').prop('readonly', true);

        }







    }




    $(document).on('change', '#tran_type', function() {

        var tran_type = $(this).val();
        $('#adm_fees,#sub_coach_fees').prop('readonly', false);
          $('#sel_member_code,#sel_tran_related').prop('disabled', false);
          $('#total_amount').prop('readonly', true);
         $('#adm_fees,#sub_coach_fees').prop('readonly', false);

        if (tran_type == "ORITM") {

            $('#adm_block').css({ backgroundColor: '#fff' });
            $('#receivable_block').css({ backgroundColor: '#f7eeee' });
            $('#item_block').css({ backgroundColor: '#f7eeee' });
            $("#adm_block").hide();
            $("#receivable_amt_block").hide();
            $('#narration').val('Being the amount received against');

         var tran_related = $("#sel_tran_related").val();
         $('#total_amount').prop('readonly', true);
         $('#adm_fees,#sub_coach_fees').prop('readonly', false);

        if (tran_related=='O') {

             $('#total_amount').prop('readonly', false);
             $('#adm_fees,#sub_coach_fees').prop('readonly', true);

        }


        } else if (tran_type == "RCFM") {

            $('#receivable_block').css({ backgroundColor: '#f7eeee' });
            $('#adm_block').css({ backgroundColor: '#fff' });
            $('#item_block').css({ backgroundColor: '#fff' });
            $("#adm_block").hide();
            $("#receivable_amt_block").show();
            $('#narration').val('Being the amount received from member');
            $('#adm_fees,#sub_coach_fees').prop('readonly', true);
            $('#sel_tran_related').prop('disabled', true);

        }else if (tran_type == "ORADM") {
            $("#adm_block").show();
            $("#receivable_amt_block").hide();
            $('#receivable_block').css({ backgroundColor: '#ffff' });
            $('#adm_block').css({ backgroundColor: '#f7eeee' });
            $('#item_block').css({ backgroundColor: '#f7eeee' });
            $('#narration').val('Being the amount received against');
            $('#sel_member_code,#sel_tran_related').prop('disabled', true);

        }



       


    });

    $(document).on('change', '#actobedebited', function() {

        var selectedMode = $(this).find('option:selected').text();
        if (selectedMode == 'CHEQUE IN HAND') {
            $('#cheque_bank_dtl').show();
        } else {

            $('#bank,#branch,#cheque_no,#cheque_dt').val('');
            $('#cheque_bank_dtl').hide();


        }

    });


    $(document).on('input keyup', '#adm_fees,#sub_coach_fees,#service_tax', function() {

        CalculateAdmissionTotal();
    });



    $(document).on('input keyup', '#receipt_dt', function() {

        var receipt_dt = $(this).val();

        console.log("receipt date :" + receipt_dt);

        $('#error_msg').text('');
        if (isDate(receipt_dt)) {
            console.log("receipt date is valid:");

            if (inputdatecheck(receipt_dt) == 0) {
                $('#error_msg').text('Enter Date Between Accounting Year');
                return false;
            }

        } else {
            $('#error_msg').text('Payment date is not valid');
        }

        // isDate(txtDate)


    });


    $(document).on('click', '#create_code', function(e) {
        e.preventDefault();


        if (validateCreateCode()) {
            var member_category = $("#sel_member_category").val();
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();


            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'memberreceipt/generateCode';
            //$("#create_code").attr('disabled', true);
            $.ajax({
                type: type,
                url: urlpath,
                data: { firstname: first_name, lastname: last_name, member_category: member_category },
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {


                    // resetMemberCodeDropdown(result.member_id);
                    $("#new_member_code").val(result.new_code);
                    //resetRegularMember();

                    //  $("#create_code").attr('disabled',false);



                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });

        }

    });


    // Swal.fire({
    //     title: 'Receipt No : ',
    //     text: "Want to print",
    //     icon: 'info',
    //     width: 350,
    //     padding: '1em',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: 'btn btn-danger',
    //     confirmButtonText: 'Yes',
    //     cancelButtonText: 'No',
    //     customClass: {
    //         title: 'alerttitale',
    //         content: 'alerttext',
    //         confirmButton: 'btn tbl-action-btn padbtn',
    //         cancelButton: 'btn tbl-action-btn padbtn',
    //     },
    // }).then((result) => {
    //     if (result.value) {

    //     } else {

    //     }

    // });

    /* save member receipt data */

    $(document).on('submit', '#memberreceiptForm', function(e) {
        e.preventDefault();

         var mode = $('#mode').val();

        $("#error_msg").html('');
        if (validateMemberReceipt()) {

            $('#sel_member_code,#sel_tran_related').prop('disabled', false);

            var formDataserialize = $("#memberreceiptForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'memberreceipt/saveMemberReceiptData';
            $("#memberreceiptsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-table');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(data) {
                    if (data.msg_status == 1) {



                        $('#memberreceiptForm').trigger("reset");

                        if (mode=='ADD') {
                        Swal.fire({
                            title: 'Receipt No : ' + data.receipt_no,
                            text: "Want to print",
                            icon: 'info',
                            width: 350,
                            padding: '1em',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: 'btn btn-danger',
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            customClass: {
                                title: 'alerttitale',
                                content: 'alerttext',
                                confirmButton: 'btn tbl-action-btn padbtn',
                                cancelButton: 'btn tbl-action-btn padbtn',
                            },
                        }).then((result) => {
                            if (result.value) {
                                window.open(basepath + 'memberreceipt/receiptprintJasper/' + data.receipt_id, '_blank');
                                window.location.replace(basepath + 'memberreceipt/addReceipt');

                            } else {
                                window.location.replace(basepath + 'memberreceipt/addReceipt');
                            }
                        });


                    }




                    } else {

                    }
                    //window.open(basepath + 'memberreceipt', '_blank');
                    //window.location.replace(basepath + 'memberreceipt/receiptprintJasper/' + result.receiptid);
                    //window.location.replace(basepath + 'memberreceipt');


                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });




        }

    });


    /* ------------------------------------------------- */


    $(document).on('click', "#receiptlistshowbtn", function(e) {
        e.preventDefault();


        var from_dt = $("#from_dt").val();
        var to_date = $("#to_date").val();
        var sel_member = $("#sel_member").val();


        if (1) {
            $('#receipt_list_data').html('');
            $("#loader").show();

            $.ajax({
                type: "POST",
                url: basepath + 'memberreceipt/getMemberReceiptListByDate',
                dataType: "html",
                data: { from_dt: from_dt, to_date: to_date, sel_member: sel_member },

                success: function(result) {
                    $("#loader").hide();
                    $("#receipt_list_data").html(result);
                    $(".dataTable").DataTable();
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







}); // end of document ready


function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}

function validateCreateCode() {

    var sel_member_category = $("#sel_member_category").val();
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    $("#new_member_code,#sel_member_categoryerr,#first_name,#last_name").removeClass("form_error");


    console.log(first_name);


    if (sel_member_category == '') {
        $("#sel_member_categoryerr").addClass("form_error");

        return false;
    }

    if (first_name == '') {
        $("#first_name").addClass("form_error");

        return false;
    }

    if (last_name == '') {
        $("#last_name").addClass("form_error");

        return false;
    }


    return true;


}


function resetMemberCodeDropdown(memberid) {

    var basepath = $("#basepath").val();

    $.ajax({
        type: "POST",
        url: basepath + 'memberreceipt/resetMemberCodeList',
        dataType: "html",
        data: { memberid: memberid },
        success: function(result) {



            $("#resetmemberlist").html(result);

            // $('.select2').select2();
            var selectedCode = $('#sel_member_code').find('option:selected');
            console.log(selectedCode);
            $("#member_name").val(selectedCode.data('name'));
            console.log(selectedCode);

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


function validateMemberReceipt() {

    var receipt_dt = $("#receipt_dt").val();
    var tran_type = $("#tran_type").val();
    var sel_member_code = $("#sel_member_code").val();
    var amount = $("#amount").val();

    var adm_fees = $("#adm_fees").val();
    var new_member_code = $("#new_member_code").val();
    var sel_member_category = $("#sel_member_category").val();
    var total_amount = $("#total_amount").val();


    var actobedebited = $("#actobedebited").val();
    var actobecredited = $("#actobecredited").val();

    $("#receipt_dt,#tran_typeerr,#sel_member_codeerr,#amount,#adm_fees,#sel_member_categoryerr,#actobedebitederr,#actobecreditederr").removeClass("form_error");
    $('#error_msg').text('');



    if (receipt_dt == '') {
        $("#receipt_dt").addClass("form_error");
        $("#receipt_dt").focus();
        return false;
    }

    if (inputdatecheck(receipt_dt) == 0) {
        $('#error_msg').text('Enter Date Between Accounting Year');
        return false;
    }


    if (tran_type == '') {
        $("#tran_typeerr").addClass("form_error");
        return false;
    }


    if (actobedebited == '') {
        $("#actobedebitederr").addClass("form_error");
        return false;
    }


    if (actobecredited == '') {
        $("#actobecreditederr").addClass("form_error");

        return false;
    }



    if (tran_type == 'RCFM') {

          var tran_related = $("#sel_tran_related").val();


        if (sel_member_code == '') {
            $("#sel_member_codeerr").addClass("form_error");
            return false;
        }

        if (amount == '') {
            $("#amount").addClass("form_error");
            $("#amount").focus();
            return false;
        }

    } else if (tran_type == 'ORADM') {

        if (sel_member_category == '') {
            $("#sel_member_categoryerr").addClass("form_error");
            return false;
        }

        if (new_member_code == '') {
            $("#new_member_code").addClass("form_error");
            $("#new_member_code").focus();
            return false;
        }

        if (adm_fees == '') {
            $("#adm_fees").addClass("form_error");
            $("#adm_fees").focus();
            return false;
        }


    } else if (tran_type == 'ORITM') {

         $("#sel_member_codeerr,#adm_fees,#member_name,#total_amount").removeClass("form_error");

        var tran_related = $("#sel_tran_related").val();
                if (tran_related=='M') {
                     if (sel_member_code == '') {
                     $("#sel_member_codeerr").addClass("form_error");
                     return false;
                }

                if (adm_fees == '') {
                $("#adm_fees").addClass("form_error");
                $("#adm_fees").focus();
                return false;
                }

        }else{
            var member_name = $("#member_name").val();
            var total_amount = $("#total_amount").val();

            if (member_name == '') {
                $("#member_name").addClass("form_error");
                $("#member_name").focus();
                return false;
                }

             if (total_amount == '') {
                $("#total_amount").addClass("form_error");
                $("#total_amount").focus();
                return false;
                }

        }

       




    }



    // if (total=='') {
    // 	 $("#total").addClass("form_error");  
    // 	 $("#total").focus(); 
    //        return false;
    // }







    return true;
}


function resetRegularMember() {

    $('#sel_member_code').val('').change();
    $('#member_name').val('');

}


function resetNewMember() {

    $('#sel_member_category').val('').change();
    $('#first_name,#last_name,#new_member_code').val('');
    $('#adm_fees,#sub_coach_fees,#cgst_amt,#sgst_amt,#total_amount').val('');

}


function CalculateAdmissionTotal() {

    var adm_fees = parseFloat($("#adm_fees").val() || 0);
    var sub_coach_fees = parseFloat($("#sub_coach_fees").val() || 0);

    var taxable_amt = (adm_fees + sub_coach_fees);
    var cgst_rate = parseFloat($("#cgst_rate").val() || 0);
    var sgst_rate = parseFloat($("#sgst_rate").val() || 0);

    var cgst_amtount = (taxable_amt * cgst_rate) / 100;
    var sgst_amtount = (taxable_amt * sgst_rate) / 100;

    $("#cgst_amt").val(cgst_amtount.toFixed(2));
    $("#sgst_amt").val(sgst_amtount.toFixed(2));

    var total_amt = (taxable_amt + cgst_amtount + sgst_amtount);
    $("#total_amount").val(total_amt.toFixed(2));

}