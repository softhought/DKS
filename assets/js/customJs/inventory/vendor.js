$(document).ready(function(){

 var basepath = $("#basepath").val();


  $(document).on('submit', '#vendorFrom', function(e) {
        e.preventDefault();

        $("#errormsg,#response_msg").html('');
        var mode = $("#mode").val();
        if (validateData()) {


            var formDataserialize = $("#vendorFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'vendor/vendor_action';
            $("#vendorsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-table');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                        window.location.href = basepath + 'vendor';

                    } else {
                        $("#response_msg").text(result.msg_data);
                        $("#vendorsavebtn").show();
                        $("#loaderbtn").hide();
                    }

                    //  $("#loaderbtn").css('display', 'none');


                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });

        }

    });




});  // end of document ready




function validateData() {

    var vendor_name = $("#vendor_name").val();
    var address = $("#address").val();
    var sel_state = $("#sel_state").val();
 

    $("#vendor_name,#address,#sel_staterr").removeClass("form_error");
    $("#errormsg").text('');

    if (vendor_name == '') {
        $("#vendor_name").addClass("form_error");     
        return false;
    }

    if (address == '') {
        $("#address").addClass("form_error");       
        return false;
    }

    if (sel_state == '') {
        $("#sel_staterr").addClass("form_error");       
        return false;
    }


    return true;

}



function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
