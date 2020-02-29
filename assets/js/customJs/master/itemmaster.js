$(document).ready(function() {

    var basepath = $("#basepath").val();

    $('.numberwithdecimal').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');

    });

    $("#item_cat").change(function() {


            if ($("#item_cat option:selected ").text() == 'BAR') {

                $(".barsubgroupitem").css("display", "block");
            } else {
                $(".barsubgroupitem").css("display", "none");
                $("#item_sub_group_cat").val('').change();
                $("#liquer_vol").val('').change();

            }

        })
        //form submit

    $(document).on('submit', '#itemmasterFrom', function(event) {
        event.preventDefault();
        $("#errormsg").text('');
        var mode = $("#mode").val();
        if (validateform()) {

            var formDataserialize = $("#itemmasterFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);

            var formData = { formDatas: formDataserialize };

            $("#itemmastersavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');


            $.ajax({
                type: "POST",
                url: basepath + 'itemmaster/addedit_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,

                success: function(result) {

                    if (result.msg_status == 1) {
                        if (mode == 'EDIT') {
                            $("#itemmastersavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'itemmaster';
                            //showMsg();

                        } else {

                            $("#errormsg").removeClass('errormsgcolor');
                            $("#errormsg").text(result.msg_data).addClass('succmsg');
                            $("#itemmastersavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            $("#itemmasterFrom .form-control").val('');
                            $("#itemmasterFrom .form-control").val('').change();


                        }

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


        } // end master validation


    });



})



function validateform() {

    var item_name = $.trim($("#item_name").val());
    var item_short_name = $.trim($("#item_short_name").val());
    var item_cat = $("#item_cat").val();
    var item_group_cat = $("#item_group_cat").val();
    var opening_bal = $.trim($("#opening_bal").val());
    var item_rate = $.trim($("#item_rate").val());
    var cgst = $("#cgst").val();
    var sgst = $("#sgst").val();
    var mrp_rate = $.trim($("#mrp_rate").val());


    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    $('#errormsg').text();

    if (item_name == '') {

        $('#errormsg').text("Enter Item Name");
        $("#item_name").focus();
        return false;

    } else if (item_short_name == '') {

        $('#errormsg').text("Enter Item Short Name");
        $("#item_short_name").focus();
        return false;
    } else if (item_cat == '') {

        $('#errormsg').text("Select Item Category");
        $("#item_cat").focus();
        return false;
    } else if (item_group_cat == '') {

        $('#errormsg').text("Select Item Group Category");
        $("#item_group_cat").focus();
        return false;
    }
    if (opening_bal == '') {
        $('#errormsg').text("Enter Opening Balance");
        $("#opening_bal").focus();
        return false;
    } else if (item_rate == '') {
        $('#errormsg').text("Enter Item Rate");
        $("#item_rate").focus();
        return false;
    } else if (cgst == '') {

        $('#errormsg').text("Select CGST Rate");
        $("#cgst").focus();
        return false;
    } else if (sgst == '') {
        $('#errormsg').text("Select SGST Rate");
        $("#sgst").focus();
        return false;
    } else if (mrp_rate == '') {
        $('#errormsg').text("Enter MRP Rate");
        $("#mrp_rate").focus();
        return false;
    }
    return true;
}