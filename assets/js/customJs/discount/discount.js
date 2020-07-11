$(document).ready(function(){

    var basepath = $('#basepath').val();

    $('.numberwithdecimal').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9\.]/g, '');

  });
    //form submit

    $(document).on('submit', '#discountFrom', function(event) {
        event.preventDefault();
        $("#errormsg").text('');
        var mode = $("#mode").val();
        if (valiadtForm()) {

            var formDataserialize = $("#discountFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);

            var formData = { formDatas: formDataserialize };

            $("#discountsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');


            $.ajax({
                type: "POST",
                url: basepath + 'discount/discount_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,

                success: function(result) {


                    if (result.msg_status == 1) {

                        if (mode == 'EDIT') {


                            $("#discountsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'discount';
                            //showMsg();

                        } else {

                            $("#errormsg").removeClass('errormsgcolor');
                            $("#errormsg").text(result.msg_data).addClass('succmsg');
                            $("#discountsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            $('#discount_rate').val('');
                           
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

})

function valiadtForm() {

    var discount_rate = $('#discount_rate').val();
   

    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    $('#errormsg').text();

    if (discount_rate == '') {

        $('#errormsg').text('Enter Discount Rate');
        $("#discount_rate").focus();
        return false;


    } 
  return true;
}