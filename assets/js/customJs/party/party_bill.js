$(document).ready(function() {

    var basepath = $("#basepath").val();

    $(document).on('change', '#sel_member_code', function() {

        var selectedCode = $('#sel_member_code').find('option:selected');
        $("#member_name").val(selectedCode.data('name'));
        console.log(selectedCode);


    });


    $(document).on('change', '#select_item', function() {

        var selectedCode = $('#select_item').find('option:selected');
        $("#item_rate").val(selectedCode.data('rate'));
        $("#hsncode").val(selectedCode.data('hsnno'));

        console.log(selectedCode);


    });



    $(document).on('change', '#select_item_bot', function() {

        var selectedCode = $('#select_item_bot').find('option:selected');
        $("#item_rate_bot").val(selectedCode.data('rate'));
        $("#mrp_bot").val(selectedCode.data('mrp'));

        console.log(selectedCode);


    });

    var total_amt = $("#total_amt").val();
    $("#total_amount_value").html(total_amt);

    // Add Item Details KOT
    $(document).on('click', '.addItem', function() {

        // rowNoUpload++;
        // $("#selmens_medicineerr").removeClass("bordererror");

        var rowno = $("#rowno").val();
        var select_item = $("#select_item").val();
        var hsncode = $("#hsncode").val();
        var itemqty = $("#itemqty").val();
        var itemrate = $("#item_rate").val();
        var itemtaxable = $("#itemtaxable").val();
        var cgstrateid = $("#item_cgst_rate").val();

        var selectedCgst = $('#item_cgst_rate').find('option:selected');
        var cgstrate = parseFloat(selectedCgst.data('rate'));
        var cgstamt = $("#item_cgst_amt").val();
        var sgstrateid = $("#item_sgst_rate").val();
        var selectedSgst = $('#item_sgst_rate').find('option:selected');
        var sgstrate = parseFloat(selectedSgst.data('rate'));
        var sgstamt = $("#item_sgst_amt").val();
        var item_netamt = $("#item_netamt").val();

        console.log(basepath);
        if (validateItemDetails()) {
            rowno++;
            $.ajax({
                type: "POST",
                url: basepath + 'partybill/addItemAmountDetail',
                dataType: "html",
                data: {
                    rowNo: rowno,
                    tennisitem: select_item,
                    hsncode: hsncode,
                    itemqty: itemqty,
                    itemrate: itemrate,
                    itemtaxable: itemtaxable,
                    cgstrateid: cgstrateid,
                    cgstrate: cgstrate,
                    cgstamt: cgstamt,
                    sgstrateid: sgstrateid,
                    sgstrate: sgstrate,
                    sgstamt: sgstamt,
                    item_netamt: item_netamt

                },
                success: function(result) {
                    $("#rowno").val(rowno);
                    $("#detail_itemamt table").show();
                    $("#detail_itemamt table tbody").append(result);


                    $('#itemqty').val('');
                    $('#itemtaxable').val('');
                    $('#select_item').val('').change();
                    $('#item_cgst_rate').val('').change();
                    $('#item_sgst_rate').val('').change();
                    $('#item_cgst_amt').val('');
                    $('#item_sgst_amt').val('');
                    $('#item_netamt').val('');
                    $('#hsncode').val('');
                    $('#item_rate').val('');

                    resetKotTotalAmount();
                    finalTotalAmount();

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

        } else {
            $("#selmens_medicine").focus();
            $("#selmens_medicineerr").addClass("bordererror");

        }

    }); // End Visiting Details


    // Delete Table Row

    $(document).on('click', '.delItenDetails', function() {

        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        // console.log(rowDtlNo[1]);
        console.log(currRowID);

        //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
        $("tr#rowItemdetails_" + rowDtlNo[1]).remove();
        resetKotTotalAmount();
        finalTotalAmount();
    });

    // Add Item Details BOT
    $(document).on('click', '.addItemBOT', function() {

        // rowNoUpload++;
        // $("#selmens_medicineerr").removeClass("bordererror");

        var rowno = $("#botrowno").val();
        var select_item = $("#select_item_bot").val();

        var itemqty = $("#itemqty_bot").val();
        var itemrate = $("#item_rate_bot").val();
        var itemtaxable = $("#itemtaxable_bot").val();
        var cgstrateid = $("#item_cgst_rate_bot").val();

        var selectedCgst = $('#item_cgst_rate_bot').find('option:selected');
        var cgstrate = parseFloat(selectedCgst.data('rate'));
        var cgstamt = $("#item_cgst_amt_bot").val();
        var sgstrateid = $("#item_sgst_rate_bot").val();
        var selectedSgst = $('#item_sgst_rate_bot').find('option:selected');
        var sgstrate = parseFloat(selectedSgst.data('rate'));
        var sgstamt = $("#item_sgst_amt_bot").val();
        var item_netamt = $("#item_netamt_bot").val();
        var mrp_bot = $("#mrp_bot").val();

        console.log(basepath);
        if (validateItemDetailsBOT()) {
            rowno++;
            $.ajax({
                type: "POST",
                url: basepath + 'partybill/addItemBOTAmountDetail',
                dataType: "html",
                data: {
                    rowNo: rowno,
                    tennisitem: select_item,

                    itemqty: itemqty,
                    itemrate: itemrate,
                    itemtaxable: itemtaxable,
                    cgstrateid: cgstrateid,
                    cgstrate: cgstrate,
                    cgstamt: cgstamt,
                    sgstrateid: sgstrateid,
                    sgstrate: sgstrate,
                    sgstamt: sgstamt,
                    item_netamt: item_netamt,
                    mrp_bot: mrp_bot

                },
                success: function(result) {
                    $("#botrowno").val(rowno);
                    $("#detail_itemamt_bot table").show();
                    $("#detail_itemamt_bot table tbody").append(result);


                    $('#itemqty_bot').val('');
                    $('#itemtaxable_bot').val('');
                    $('#select_item_bot').val('').change();
                    $('#item_cgst_rate_bot').val('').change();
                    $('#item_cgst_amt_bot').val('').change();
                    $('#item_sgst_rate_bot').val('');
                    $('#item_sgst_amt_bot').val('');
                    $('#item_netamt_bot').val('');
                    $('#mrp_bot').val('');
                    $('#item_rate_bot').val('');

                    resetBotTotalAmount();
                    finalTotalAmount()

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

        } else {
            $("#selmens_medicine").focus();
            $("#selmens_medicineerr").addClass("bordererror");

        }

    }); // End 



    // Delete Table Row of BOT

    $(document).on('click', '.botdelItenDetails', function() {

        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        // console.log(rowDtlNo[1]);
        console.log(currRowID);

        //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
        $("tr#rowItemdetailsbot_" + rowDtlNo[1]).remove();
        resetBotTotalAmount();
        finalTotalAmount();
    });













    $(document).on('keyup input', '#itemqty,#item_rate', function() {

        calculateItemGst()
        calculateNetAmount();

    });

    $(document).on('change', '#item_cgst_rate', function() {

        getItemCgst();
        calculateNetAmount();

    });

    $(document).on('change', '#item_sgst_rate', function() {

        getItemSgst();
        calculateNetAmount();

    });

    /* Hall Charges gst */

    $(document).on('keyup input', '#hall_charges', function() {

        calculateHallChargesGst();
        calculateHallChargesNetAmount();


    });

    $(document).on('change', '#hall_cgst_rate', function() {

        getHallChargesCgst();
        calculateHallChargesNetAmount();

    });

    $(document).on('change', '#hall_sgst_rate', function() {

        getHallChargesSgst();
        calculateHallChargesNetAmount();

    });



    /*  guest charges */

    $(document).on('keyup input', '#guest_head,#guest_rate', function() {

        var guest_head = parseFloat($("#guest_head").val() || 0);
        var guest_rate = parseFloat($("#guest_rate").val() || 0);
        var amount = (guest_head * guest_rate);

        $("#guest_amt").val(amount.toFixed(2));

        calculateGuestChargesGst();
        calculateGuestChargesNetAmount();

    });


    $(document).on('change', '#guest_cgst_rate', function() {

        getGuestChargesCgst();
        calculateGuestChargesNetAmount();

    });

    $(document).on('change', '#guest_sgst_rate', function() {

        getGuestChargesSgst();
        calculateGuestChargesNetAmount();

    });


    /* deco,electctic,other */

    $(document).on('keyup input', '#deco_chages,#electric_charges,#other_charges', function() {
        finalTotalAmount();
    });

















    /* for BOT */

    $(document).on('keyup input', '#itemqty_bot,#item_rate_bot', function() {

        calculateItemGstBOT()
        calculateNetAmountBot();

    });

    $(document).on('change', '#item_cgst_rate_bot', function() {

        getItemCgstBot();
        calculateNetAmountBot();

    });

    $(document).on('change', '#item_sgst_rate_bot', function() {

        getItemSgstBot();
        calculateNetAmountBot();

    });



    $(document).on('keyup input', '#item_rowtotal_amtkot,#item_rowtotal_botamt', function() {

        finalTotalAmount();

    });


    //form submit

    $(document).on('submit', '#partybillFrom', function(event) {
        event.preventDefault();
        $("#errormsg").text('');
        var mode = $("#mode").val();
        if (validatePartyBill()) {

            var formDataserialize = $("#partybillFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);

            var formData = { formDatas: formDataserialize };

            $("#gstsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');


            $.ajax({
                type: "POST",
                url: basepath + 'partybill/partybill_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,

                success: function(result) {

                    if (result.msg_status == 1) {

                    } else {

                    }

                    window.location.replace(basepath + 'partybill');
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


        } // end master validation


    });




    $(document).on('click', "#partylistshowbtn", function(e) {
        e.preventDefault();


        var from_dt = $("#from_dt").val();
        var to_date = $("#to_date").val();
        var sel_member = $("#sel_member").val();


        if (1) {
            $('#facility_list_data').html('');
            $("#loader").show();

            $.ajax({
                type: "POST",
                url: basepath + 'partybill/getPartyListByDate',
                dataType: "html",
                data: { from_dt: from_dt, to_date: to_date, sel_member: sel_member },

                success: function(result) {
                    $("#loader").hide();
                    $("#facility_list_data").html(result);
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


function validatePartyBill() {

    var party_bill_date = $("#party_bill_date").val();
    var party_date = $("#party_date").val();
    var sel_member_code = $("#sel_member_code").val();
    var hall_charges = $("#hall_charges").val();

    $("#party_bill_date,#party_bill_date,#sel_member_codeerr,#select_cr_acerr,#select_kot_acerr,#select_bot_acerr").removeClass("form_error");
    $('#error_msg').text('');


    if (party_bill_date == '') {

        $("#party_bill_date").addClass("form_error");
        $("#party_bill_date").focus();
        return false;
    }

    if (party_date == '') {
        $("#party_date").addClass("form_error");
        $("#party_date").focus();
        return false;
    }


    if (sel_member_code == '') {
        $("#sel_member_codeerr").addClass("form_error");
        $("#sel_member_codeerr").focus();
        return false;
    }
















    $("#hall_cgst_rateerr,#hall_sgst_rateerr,#guest_cgst_rateerr,#guest_sgst_rateerr").removeClass("form_error");
    $("#select_hall_acerr,#select_guest_acerr,#select_deco_acerr,#select_electric_acerr,#select_other_acerr,#select_dr_acerr,#select_kot_acerr,#select_bot_acerr").removeClass("form_error");


    var hall_charges = $("#hall_charges").val();
    if (hall_charges != '') {

        var hall_cgst_rate = $("#hall_cgst_rate").val();
        var hall_sgst_rate = $("#hall_sgst_rate").val();

        if (hall_cgst_rate == '') {
            $("#hall_cgst_rateerr").addClass("form_error");
            return false;
        }

        if (hall_sgst_rate == '') {
            $("#hall_sgst_rateerr").addClass("form_error");
            return false;
        }


    }

    var guest_head = $("#guest_head").val();
    var guest_rate = $("#guest_rate").val();

    if (guest_head != '' && guest_rate != '') {

        var guest_cgst_rate = $("#guest_cgst_rate").val();
        var guest_sgst_rate = $("#guest_sgst_rate").val();

        if (guest_cgst_rate == '') {
            $("#guest_cgst_rateerr").addClass("form_error");
            return false;
        }

        if (guest_sgst_rate == '') {
            $("#guest_sgst_rateerr").addClass("form_error");
            return false;
        }





    }



    var select_dr_ac = $("#select_dr_ac").val();
    if (select_dr_ac == '') {
        $("#select_dr_acerr").addClass("form_error");
        $("#select_dr_acerr").focus();
        return false;
    }


    var itemnetamtrow = 0;

    $(".itemnetamtrow").each(function() {
        itemnetamtrow = itemnetamtrow + 1;
    });


    if (itemnetamtrow != 0) {

        var select_kot_ac = $("#select_kot_ac").val();

        if (select_kot_ac == '') {

            $("#select_kot_acerr").addClass("form_error");
            $("#select_kot_acerr").focus();
            return false;

        }

    }


    var itemnetamtrowbot = 0;

    $(".botitemnetamtrow").each(function() {

        itemnetamtrowbot = itemnetamtrowbot + 1;
    });


    if (itemnetamtrowbot != 0) {

        var select_bot_ac = $("#select_bot_ac").val();

        if (select_bot_ac == '') {

            $("#select_bot_acerr").addClass("form_error");
            $("#select_bot_acerr").focus();
            return false;

        }

    }


    if (hall_charges != '') {
        var select_hall_ac = $("#select_hall_ac").val();
        if (select_hall_ac == '') {
            $("#select_hall_acerr").addClass("form_error");
            $("#select_hall_acerr").focus();
            return false;
        }

    }


    if (guest_head != '' && guest_rate != '') {
        var select_guest_ac = $("#select_guest_ac").val();
        if (select_guest_ac == '') {
            $("#select_guest_acerr").addClass("form_error");
            $("#select_guest_acerr").focus();
            return false;
        }

    }

    var deco_chages = $("#deco_chages").val();

    if (deco_chages != '') {
        var select_deco_ac = $("#select_deco_ac").val();
        if (select_deco_ac == '') {
            $("#select_deco_acerr").addClass("form_error");
            $("#select_deco_acerr").focus();
            return false;
        }
    }



    var electric_charges = $("#electric_charges").val();

    if (electric_charges != '') {
        var select_electric_ac = $("#select_electric_ac").val();
        if (select_electric_ac == '') {
            $("#select_electric_acerr").addClass("form_error");
            $("#select_electric_acerr").focus();
            return false;
        }
    }




    var other_charges = $("#other_charges").val();

    if (other_charges != '') {
        var select_other_ac = $("#select_other_ac").val();
        if (select_other_ac == '') {
            $("#select_other_acerr").addClass("form_error");
            $("#select_other_acerr").focus();
            return false;
        }
    }













    return true;

}


function validateItemDetails() {

    var select_item = $("#select_item").val();
    var hsncode = $("#hsncode").val();
    var itemqty = $("#itemqty").val();
    var item_rate = $("#item_rate").val();
    var itemtaxable = $("#itemtaxable").val();
    var item_cgst_rate = $("#item_cgst_rate").val();
    var item_sgst_rate = $("#item_sgst_rate").val();

    var item_netamt = $("#item_netamt").val();

    $("#select_itemerr,#hsncode,#itemqty,#item_rate,#itemtaxable,#item_cgst_rateerr,#item_sgst_rateerr").removeClass("form_error");
    $('#error_msg').text('');

    if (select_item == '') {
        $("#select_itemerr").addClass("form_error");
        $("#select_itemerr").focus();
        return false;
    }

    // if (hsncode=='') {
    // 	 $("#hsncode").addClass("form_error");
    //        $("#hsncode").focus();
    //        return false;
    // }

    if (itemqty == '') {
        $("#itemqty").addClass("form_error");
        $("#itemqty").focus();
        return false;
    }

    if (item_rate == '') {
        $("#item_rate").addClass("form_error");
        $("#item_rate").focus();
        return false;
    }

    // if (itemtaxable=='') {
    // 	 $("#itemtaxable").addClass("form_error");
    //        $("#itemtaxable").focus();
    //        return false;
    // }

    if (item_cgst_rate == '') {
        $("#item_cgst_rateerr").addClass("form_error");
        return false;
    }

    if (item_sgst_rate == '') {
        $("#item_sgst_rateerr").addClass("form_error");
        return false;
    }

    // if (item_netamt=='' || item_netamt=='0') {
    // 	 $("#item_netamt").addClass("form_error");
    //        return false;
    // }






    return true;
}




function calculateItemGst() {
    itemTaxable();
    getItemCgst();
    getItemSgst();
}

function itemTaxable() {

    var quantity = parseFloat($("#itemqty").val() || 0);
    var rate = parseFloat($("#item_rate").val() || 0);


    var total_taxable = (quantity * rate);
    console.log("tax" + total_taxable);
    $("#itemtaxable").val(total_taxable.toFixed(2));

}

function getItemCgst() {

    var selected = $('#item_cgst_rate').find('option:selected');
    var rate = parseFloat(selected.data('rate'));
    var taxableAmt = parseFloat($("#itemtaxable").val() || 0);
    var cgst = parseFloat((taxableAmt * rate) / 100);
    $("#item_cgst_amt").val(cgst.toFixed(2));


}

function getItemSgst() {

    var selected = $('#item_sgst_rate').find('option:selected');
    var rate = parseFloat(selected.data('rate'));
    var taxableAmt = parseFloat($("#itemtaxable").val() || 0);
    var sgst = parseFloat((taxableAmt * rate) / 100);
    $("#item_sgst_amt").val(sgst.toFixed(2));

}


function calculateNetAmount() {

    var taxable_amt = parseFloat($("#itemtaxable").val() || 0);
    var cgst_amt = parseFloat($("#item_cgst_amt").val() || 0);
    var sgst_amt = parseFloat($("#item_sgst_amt").val() || 0);

    var net_amount = (taxable_amt + cgst_amt + sgst_amt);
    console.log("Net" + net_amount);
    $("#item_netamt").val(net_amount.toFixed(2));

}


function resetKotTotalAmount() {

    var total_amt = 0;

    $(".itemnetamtrow").each(function() {
        total_amt += parseFloat($(this).val());
        //console.log($(this).val());

    });

    $("#item_rowtotal_amtkot").val(total_amt.toFixed(2));
}


function resetBotTotalAmount() {

    var total_amt = 0;

    $(".botitemnetamtrow").each(function() {
        total_amt += parseFloat($(this).val());
        //console.log($(this).val());

    });

    $("#item_rowtotal_botamt").val(total_amt.toFixed(2));
}




function validateItemDetailsBOT() {

    var select_item = $("#select_item_bot").val();

    var itemqty = $("#itemqty_bot").val();
    var item_rate = $("#item_rate_bot").val();
    var itemtaxable = $("#itemtaxable_bot").val();
    var item_cgst_rate = $("#item_cgst_rate_bot").val();
    var item_sgst_rate = $("#item_sgst_rate_bot").val();

    var item_netamt = $("#item_netamt").val();

    $("#select_item_boterr,#hsncode,#itemqty_bot,#item_rate_bot,#itemtaxable_bot,#item_cgst_rate_boterr,#item_sgst_rate_boterr").removeClass("form_error");
    $('#error_msg').text('');

    if (select_item == '') {
        $("#select_item_boterr").addClass("form_error");
        $("#select_item_boterr").focus();
        return false;
    }

    if (itemqty == '') {
        $("#itemqty_bot").addClass("form_error");
        $("#itemqty_bot").focus();
        return false;
    }

    if (item_rate == '') {
        $("#item_rate_bot").addClass("form_error");
        $("#item_rate_bot").focus();
        return false;
    }

    // if (itemtaxable=='') {
    // 	 $("#itemtaxable").addClass("form_error");
    //        $("#itemtaxable").focus();
    //        return false;
    // }

    // if (item_cgst_rate=='') {
    // 	 $("#item_cgst_rate_boterr").addClass("form_error");
    //        return false;
    // }

    // if (item_sgst_rate=='') {
    // 	 $("#item_sgst_rate_boterr").addClass("form_error");
    //        return false;
    // }

    // if (item_netamt=='' || item_netamt=='0') {
    // 	 $("#item_netamt").addClass("form_error");
    //        return false;
    // }






    return true;
}



function calculateItemGstBOT() {
    itemTaxableBot();
    getItemCgstBot();
    getItemSgstBot();
}



function itemTaxableBot() {
    var quantity = parseFloat($("#itemqty_bot").val() || 0);
    var rate = parseFloat($("#item_rate_bot").val() || 0);
    var total_taxable = (quantity * rate);
    $("#itemtaxable_bot").val(total_taxable.toFixed(2));
}

function getItemCgstBot() {
    var selected = $('#item_cgst_rate_bot').find('option:selected');
    var rate = parseFloat(selected.data('rate'));
    var taxableAmt = parseFloat($("#itemtaxable_bot").val() || 0);
    var cgst = parseFloat((taxableAmt * rate) / 100);
    $("#item_cgst_amt_bot").val(cgst.toFixed(2));

}

function getItemSgstBot() {

    var selected = $('#item_sgst_rate_bot').find('option:selected');
    var rate = parseFloat(selected.data('rate'));
    var taxableAmt = parseFloat($("#itemtaxable_bot").val() || 0);
    var sgst = parseFloat((taxableAmt * rate) / 100);
    $("#item_sgst_amt_bot").val(sgst.toFixed(2));

}


function calculateNetAmountBot() {

    var taxable_amt = parseFloat($("#itemtaxable_bot").val() || 0);
    var cgst_amt = parseFloat($("#item_cgst_amt_bot").val() || 0);
    var sgst_amt = parseFloat($("#item_sgst_amt_bot").val() || 0);

    var net_amount = (taxable_amt + cgst_amt + sgst_amt);
    console.log("Net" + net_amount);
    $("#item_netamt_bot").val(net_amount.toFixed(2));

}



function calculateHallChargesGst() {
    var quantity = parseFloat($("#hall_charges").val() || 0);
    getHallChargesCgst();
    getHallChargesSgst();
}

function getHallChargesCgst() {
    var selected = $('#hall_cgst_rate').find('option:selected');
    var rate = parseFloat(selected.data('rate'));
    var taxableAmt = parseFloat($("#hall_charges").val() || 0);
    var cgst = parseFloat((taxableAmt * rate) / 100);
    $("#hall_cgst_amt").val(cgst.toFixed(2));
}


function getHallChargesSgst() {
    var selected = $('#hall_sgst_rate').find('option:selected');
    var rate = parseFloat(selected.data('rate'));
    var taxableAmt = parseFloat($("#hall_charges").val() || 0);
    var sgst = parseFloat((taxableAmt * rate) / 100);
    $("#hall_sgst_amt").val(sgst.toFixed(2));

}


function calculateHallChargesNetAmount() {

    var taxable_amt = parseFloat($("#hall_charges").val() || 0);
    var cgst_amt = parseFloat($("#hall_cgst_amt").val() || 0);
    var sgst_amt = parseFloat($("#hall_sgst_amt").val() || 0);
    var net_amount = (taxable_amt + cgst_amt + sgst_amt);
    console.log("Net" + net_amount);
    $("#hall_total_amt").val(net_amount.toFixed(2));

    finalTotalAmount();

}

function calculateGuestChargesGst() {
    var guest_head = parseFloat($("#guest_head").val() || 0);
    getGuestChargesCgst();
    getGuestChargesSgst();
}

function getGuestChargesCgst() {
    var selected = $('#guest_cgst_rate').find('option:selected');
    var rate = parseFloat(selected.data('rate'));
    var taxableAmt = parseFloat($("#guest_amt").val() || 0);
    var cgst = parseFloat((taxableAmt * rate) / 100);
    $("#guest_cgst_amt").val(cgst.toFixed(2));
}

function getGuestChargesSgst() {
    var selected = $('#guest_sgst_rate').find('option:selected');
    var rate = parseFloat(selected.data('rate'));
    var taxableAmt = parseFloat($("#guest_amt").val() || 0);
    var cgst = parseFloat((taxableAmt * rate) / 100);
    $("#guest_sgst_amt").val(cgst.toFixed(2));
}


function calculateGuestChargesNetAmount() {

    var taxable_amt = parseFloat($("#guest_amt").val() || 0);
    var cgst_amt = parseFloat($("#guest_cgst_amt").val() || 0);
    var sgst_amt = parseFloat($("#guest_sgst_amt").val() || 0);
    var net_amount = (taxable_amt + cgst_amt + sgst_amt);
    console.log("Net" + net_amount);
    $("#guest_net_amt").val(net_amount.toFixed(2));

    finalTotalAmount();
}



function finalTotalAmount() {

    var item_rowtotal_amtkot = parseFloat($("#item_rowtotal_amtkot").val() || 0);
    var item_rowtotal_botamt = parseFloat($("#item_rowtotal_botamt").val() || 0);
    var hall_total_amt = parseFloat($("#hall_total_amt").val() || 0);
    var guest_net_amt = parseFloat($("#guest_net_amt").val() || 0);
    var deco_chages = parseFloat($("#deco_chages").val() || 0);
    var electric_charges = parseFloat($("#electric_charges").val() || 0);
    var other_charges = parseFloat($("#other_charges").val() || 0);

    var final_amt = (item_rowtotal_amtkot + item_rowtotal_botamt + hall_total_amt + guest_net_amt + deco_chages + electric_charges + other_charges);

    $("#final_total").val(final_amt.toFixed(2));

}