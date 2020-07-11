$(document).ready(function() {

    var basepath = $("#basepath").val();
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,


    });
    $('.onlynumber').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9]/g, '');

    });
    $(document).on("change keyup", ".cal", function() {

        var liquer_vol = parseInt($("#liquer").val());
        var quantity = parseInt($("#quantity").val());

        if ($("#liquer").val() != '' && $("#quantity").val() != '') {
            $("#convar_ml").val((liquer_vol * quantity) / 1000);

        }

    })

    $(document).on("change keyup", ".calconml", function() {

        var rownum = $(this).attr('data-rownum')
        var liquer_vol = parseInt($("#childliquer_vol_name_" + rownum).val());
        var quantity = parseInt($("#childquantity_" + rownum).val());

        if ($("#childliquer_vol_name_" + rownum).val() != '' && $("#childquantity_" + rownum).val() != '') {

            $("#childconve_" + rownum).val((liquer_vol * quantity) / 1000);
        }

    })

    $(document).on("change", ".itemcls", function() {

        var itemid = $(this).attr('id')
        var rownum = $(this).attr('data-rownum');
        // var unitname = $("#"+itemid+" option:selected").attr('data-unitname');
        var unitid = $("#" + itemid + " option:selected").attr('data-unitid');
        var liquer = $("#" + itemid + " option:selected").attr('data-liquer');
        var liquerid = $("#" + itemid + " option:selected").attr('data-liquerid');

        $("#purchaseunit_" + rownum).val(unitid);
        //$("#unit").val(unitname);
        $("#childliquer_vol_id_" + rownum).val(liquerid);
        $("#childliquer_vol_name_" + rownum).val(liquer);

        var liquer_vol = parseInt($("#childliquer_vol_name_" + rownum).val());
        var quantity = parseInt($("#childquantity_" + rownum).val());

        $("#childconve_" + rownum).val((liquer_vol * quantity) / 1000);
    })

    $("#item_name").change(function() {
        var unitname = $("#item_name option:selected").attr('data-unitname');
        var unitid = $("#item_name option:selected").attr('data-unitid');
        var liquer = $("#item_name option:selected").attr('data-liquer');
        var liquerid = $("#item_name option:selected").attr('data-liquerid');

        $("#unit_id").val(unitid);
        $("#unit").val(unitname);
        $("#liquer_id").val(liquerid);
        $("#liquer").val(liquer);
    })


    // Add children Details
    $(document).on('click', '#addpurchageentry', function() {

        // rowNoUpload++;
        // $("#selmens_medicineerr").removeClass("bordererror");

        var rowno = $("#rowno").val();
        var item_id = $("#item_name").val();
        var item_name = $("#item_name option:selected").text();
        var unit = $("#unit").val();
        var unit_id = $("#unit_id").val();
        var liquer_id = $("#liquer_id").val();
        var liquer = $("#liquer").val();
        var quantity = $("#quantity").val();
        var location_id = $("#location_id").val();
        var stock_in_hand = $("#stock_in_hand").val();
        $('#errormsg').text('');
        //console.log(basepath);
        if (valiadtepurchinfo()) {
            rowno++;
            $.ajax({
                type: "POST",
                url: basepath + 'salentryissue/addsalentryissue',
                dataType: "html",
                data: {
                    rowNo: rowno,
                    item_id: item_id,
                    item_name: item_name,
                    unit: unit,
                    unit_id: unit_id,
                    liquer_vol_id: liquer_id,
                    liquername: liquer,
                    quantity: quantity,
                    location_id: location_id,
                    stock_in_hand: stock_in_hand,

                },
                success: function(result) {
                    $("#rowno").val(rowno);
                    $("#detail_saleentryissue table").show();
                    $("#detail_saleentryissue table tbody").append(result);
                    $("#checksalesentryissue").val('Y');
                    $('#item_name').val('').change();
                    $('#unit').val('').change();
                    $('#liquer_vol_id').val('').change();
                    $('#quantity').val('');
                    $('#location_id').val('').change();
                    $('#convar_ml').val('');
                    $('#stock_in_hand').val('');



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

    }); // End Visiting Details

    //edit member children details2
    $(document).on('click', '.editpurchasedetails', function() {

        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        var editcheck = $("#editbtncheck_" + rowDtlNo[1]).val();

        $(".showdata_" + rowDtlNo[1]).hide();
        $(".dispblock_" + rowDtlNo[1]).css('display', 'block');
        $(".editchilddtl_" + rowDtlNo[1]).prop('type', 'text');
        $('.select2').select2();
        $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })




    });

    // Delete Table Row
    // globle define aarry to store delete id      
    var delIdarr = [];
    $(document).on('click', '.delchildsalesissueDetails', function() {

        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');

        delIdarr.push($("#purchaseentryId_" + rowDtlNo[1]).val());
        //console.log(delIdarr);
        $("#delIds").val(delIdarr);
        //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
        $("tr#rowpurchasedetails_" + rowDtlNo[1]).remove();


    });


    //form submit

    $(document).on('submit', '#saleentryissueFrom', function(event) {
        event.preventDefault();
        $("#errormsg").text('');
        var mode = $("#mode").val();
        var rowCount = $('#salesissustable tr').length;
        if (rowCount != 1) {


            var formDataserialize = $("#saleentryissueFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);

            var formData = { formDatas: formDataserialize };

            $("#salesissuedtlsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');


            $.ajax({
                type: "POST",
                url: basepath + 'salentryissue/saleentryissue_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,

                success: function(result) {

                    if (result.msg_status == 1) {
                        if (mode == 'EDIT') {

                            $("#salesissuedtlsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'salentryissue';
                            //showMsg();

                        } else {

                            $("#errormsg").removeClass('errormsgcolor');
                            $("#errormsg").text(result.msg_data).addClass('succmsg');
                            $("#salesissuedtlsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'salentryissue/addeditsaleissuse';

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


        } else {
            $("#errormsg").removeClass('succmsg');
            $("#errormsg").addClass('errormsgcolor');
            $('#errormsg').text('Error:Error:Please Add Issue Item');
        }

    });


})

function valiadtepurchinfo() {

    var item_name = $('#item_name').val();
    var unit = $('#unit').val();
    var liquer_vol_id = $('#liquer_vol_id').val();
    var quantity = $('#quantity').val();
    var location_id = $('#location_id').val();
    // var stock_in_hand = $("#stock_in_hand").val();
    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    $('#errormsg').text();

    if (item_name == '') {

        $('#errormsg').text('Error: Select Item Name');
        $("#item_name").focus();
        return false;


    } // else if (stock_in_hand == '') {

    //     $('#errormsg').text('Error: Enter Stock In Hand');
    //     $("#stock_in_hand").focus();
    //     return false;

    // }
    else if (unit == '') {

        $('#errormsg').text('Error: Enter Unit');
        $("#unit").focus();
        return false;

    } else if (liquer_vol_id == '') {
        $('#errormsg').text('Error: Enter Liquer Vol');
        $("#liquer_vol_id").focus();
        return false;

    } else if (location_id == '') {
        $('#errormsg').text('Error: Select Issue Location');
        $("#location_id").focus();
        return false;

    } else if (quantity == '') {
        $('#errormsg').text('Error: Enter Quantity');
        $("#quantity").focus();
        return false;

    }

    return true;
}