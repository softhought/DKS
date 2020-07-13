$(document).ready(function(){

 var basepath = $("#basepath").val();


 $(document).on('submit', '#InventoryFrom', function(e) {
        e.preventDefault();

        $("#errormsg,#response_msg").html('');
        var mode = $("#mode").val();
        if (validateData()) {


            var formDataserialize = $("#InventoryFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'inspectorinv/inspector_action';
            $("#inspectorpsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-table');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                        window.location.href = basepath + 'inspectorinv';




                    } else {
                        $("#response_msg").text(result.msg_data);
                        $("#inspectorpsavebtn").show();
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




}); // document ready


function validateData() {

    var inspector_name = $("#inspector_name").val();
 


    $("#inspector_name").removeClass("form_error");
    $("#errormsg").text('');

    if (inspector_name == '') {
        $("#inspector_name").addClass("form_error");
       
        return false;
    }


    return true;

}