$(document).ready(function() {

    var basepath = $("#basepath").val();

    $(document).on('keyup', '#location_name', function(e) {

        e.preventDefault();
        $("#locationsavebtn").attr('disabled', false);
        $("#errormsg").text('');
        var location_name = $.trim($(this).val());
        var validlocation = $.trim($('#validlocation').val());
        var mode = $('#mode').val();


        $.ajax({
            type: "POST",
            url: basepath + 'locationmaster/checkexistance',
            data: { location_name: location_name },
            dataType: 'json',
            success: function(result) {

                if (result.msg_status == 1) {

                    if (mode == 'ADD') {

                        $("#errormsg").text(result.msg_data);
                        $("#locationsavebtn").attr('disabled', true);
                    } else {
                        if (location_name.toUpperCase() != validlocation.toUpperCase()) {

                            $("#errormsg").text(result.msg_data);
                            $("#locationsavebtn").attr('disabled', true);

                        }
                    }

                }


            },
            error: function(jqXHR, exception) {
                $('#btnusersaveDiv').css('display', 'none');
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



    });



    //form submit

    $(document).on('submit', '#locationmasterFrom', function(event) {
        event.preventDefault();
        $("#errormsg").text('');
        var mode = $("#mode").val();
        var location_name = $("#location_name").val();
        if (location_name != '') {

            var formDataserialize = $("#locationmasterFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);

            var formData = { formDatas: formDataserialize };

            $("#locationsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');


            $.ajax({
                type: "POST",
                url: basepath + 'locationmaster/addedit_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                success: function(result) {
                    if (result.msg_status == 1) {

                        if (mode == 'EDIT') {
                            $("#locationsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'locationmaster';


                        } else {

                            $("#errormsg").removeClass('errormsgcolor');
                            $("#errormsg").text(result.msg_data).addClass('succmsg');
                            $("#locationsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            $('#location_name').val('');


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




        } else {
            $("#errormsg").removeClass('succmsg');
            $("#errormsg").addClass('errormsgcolor');
            $("#errormsg").text('Error: Enter Location Name');
            $("#location_name").focus();

        }



    });



})