$(document).ready(function(){

 var basepath = $("#basepath").val();


 $(document).on('submit', '#materialTypeFrom', function(e) {
        e.preventDefault();

        $("#errormsg,#response_msg").html('');
        var mode = $("#mode").val();
        if (validateData()) {


            var formDataserialize = $("#materialTypeFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'materialtypeinv/materialtype_action';
            $("#materialtypesavebtn").hide();
            $("#loaderbtn").css('display', 'inline-table');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                        window.location.href = basepath + 'materialtypeinv';

                    } else {
                        $("#response_msg").text(result.msg_data);
                        $("#materialtypesavebtn").show();
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

    var material_type = $("#material_type").val();
 
    $("#material_type").removeClass("form_error");
    $("#errormsg").text('');

    if (material_type == '') {
        $("#material_type").addClass("form_error");      
        return false;
    }


    return true;

}