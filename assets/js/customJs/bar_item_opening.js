$(document).ready(function() {

    var basepath = $('#basepath').val();

    $('.number_only').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9]/g, '');

    });

    $(document).on("change keyup", ".calconml", function() {

        var liquer_vol = parseInt($("#liquer_vol_id option:selected").text());
        var opening_bal_botl = parseInt($("#opening_bal_botl").val());
        var opening_bal_ml = $.trim($("#opening_bal_ml").val());
        if (liquer_vol != '' && opening_bal_botl != '' && opening_bal_ml == '') {
            $("#convar_ml").val(liquer_vol * opening_bal_botl);
        } else {
            $("#convar_ml").val((liquer_vol * opening_bal_botl) + parseInt(opening_bal_ml));
        }



    })


    //form submit

    $(document).on('submit', '#baritemopeningFrom', function(event) {
        event.preventDefault();
        $("#errormsg").text('');
        var mode = $("#mode").val();
        if (valiadteform()) {

            var formDataserialize = $("#baritemopeningFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);

            var formData = { formDatas: formDataserialize };

            $("#baritemsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');


            $.ajax({
                type: "POST",
                url: basepath + 'baritemopeningmaster/baritemopening_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,

                success: function(result) {

                    if (result.msg_status == 1) {

                        if (mode == 'EDIT') {


                            $("#baritemsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'baritemopeningmaster';
                            //showMsg();

                        } else {

                            $("#errormsg").removeClass('errormsgcolor');
                            $("#errormsg").text(result.msg_data).addClass('succmsg');
                            $("#baritemsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            // $('#groupname').val('');
                            // $('#gropcat').val('').change();
                            // $('#subgropucat').val('').change();

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




        } // end master validation



    });

});


function valiadteform() {

    var item_name = $('#item_name').val();
    var group_id = $('#group_id').val();
    var unit = $('#unit').val();
    var liquer_vol_id = $('#liquer_vol_id').val();
    var opening_bal_botl = $('#opening_bal_botl').val();

    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    $('#errormsg').text();

    if (item_name == '') {

        $('#errormsg').text('Error: Enter Item Name');
        $("#item_name").focus();
        return false;


    } else if (group_id == '') {

        $('#errormsg').text('Error: Select Group Name');
        $("#group_id").focus();
        return false;

    } else if (unit == '') {
        $('#errormsg').text('Error: Select Unit');
        $("#unit").focus();
        return false;

    } else if (liquer_vol_id == '') {
        $('#errormsg').text('Error: Select Liquer Vol');
        $("#liquer_vol_id").focus();
        return false;

    } else if (opening_bal_botl == '') {
        $('#errormsg').text('Error: Enter Opening Balance BOT');
        $("#opening_bal_botl").focus();
        return false;

    }

    return true

}