$(document).ready(function() {

    var basepath = $("#basepath").val();

    $('.onlynumber').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9]/g, '');

    });
    //member deatils if selected

    $(document).on('change', '#existing_code', function() {

        var member_id = $(this).val();

        var type = "POST"; //for creating new resource
        var urlpath = basepath + 'partymember/getmemberdetails';
        // alert(member_id);

        if (member_id > 0) {

            $.ajax({
                type: type,
                url: urlpath,
                data: { member_id: member_id },
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {

                    //console.log(result.details.title_one);
                    //$('#member_name').val(result.details.title_one + ' ' + result.details.member_name);
                    $('#address_one').val(result.details.address_one);
                    $('#address_two').val(result.details.address_two);
                    $('#address_three').val(result.details.address_three);
                    // $('#phone').val(result.details.phone);
                    $('#mobile_no').val(result.details.mobile);



                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });
        }


    });

    $("#refresh").click(function() {

        window.location.href = basepath + 'partymember';
    })

    //form submit

    $(document).on('submit', '#partymemberFrom', function(e) {
        e.preventDefault();

        $("#errormsg").text('');
        var existing_code = $("#existing_code").val();
        var new_partymember_code = $("#new_partymember_code").val();



        if (existing_code != '') {


            $.ajax({
                type: 'POST',
                url: basepath + 'partymember/checkexistingcode',
                data: { new_partymember_code: new_partymember_code },
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                        $("#errormsg").removeClass('succmsg');
                        $("#errormsg").addClass('errormsgcolor');
                        $("#errormsg").text('Error: Party Member Code Already Used Press Refresh Button And Try Again');

                    } else {

                        var formDataserialize = $("#partymemberFrom").serialize();
                        formDataserialize = decodeURI(formDataserialize);
                        console.log(formDataserialize);

                        var formData = { formDatas: formDataserialize };
                        var type = "POST"; //for creating new resource
                        var urlpath = basepath + 'partymember/addparty_action';
                        $("#partysavebtn").css('display', 'none');
                        $("#loaderbtn").css('display', 'inline-table');


                        $.ajax({
                            type: type,
                            url: urlpath,
                            data: formData,
                            dataType: 'json',
                            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                            success: function(result) {
                                if (result.msg_status == 1) {

                                    $("#loaderbtn").css('display', 'none');
                                    $("#partysavebtn").css('display', 'inline-table');
                                    $("#errormsg").text(result.msg_data).addClass('succmsg');
                                    window.location.href = basepath + 'partymember';
                                    // $("#existing_code").val('').change();
                                    // $(".resetval").val('');
                                }

                            },
                            error: function(jqXHR, exception) {
                                var msg = '';
                            }
                        });
                    }

                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });


        } else {

            $("#errormsg").removeClass('succmsg');
            $("#errormsg").addClass('errormsgcolor');
            $("#errormsg").text('Error: Select Existing Member Code');
        }

    });

})