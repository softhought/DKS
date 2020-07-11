$(document).ready(function(){

 var basepath = $("#basepath").val();


  $(document).on('submit', '#salarycomponentFrom', function(e) {
        e.preventDefault();

        $("#errormsg,#response_msg").html('');
        var mode = $("#mode").val();
        if (validateData()) {


            var formDataserialize = $("#salarycomponentFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'salarycomponent/salarycomponent_action';
            $("#salcomsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-table');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                        window.location.href = basepath + 'salarycomponent';

                    } else {
                        $("#response_msg").text(result.msg_data);
                        $("#salcomsavebtn").show();
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

    var component_name = $("#component_name").val();
    var sel_tag = $("#sel_tag").val();
    
 

    $("#component_name,#sel_tagerr").removeClass("form_error");
    $("#errormsg").text('');

    if (component_name == '') {
        $("#component_name").addClass("form_error");     
        return false;
    }

    if (sel_tag == '') {
        $("#sel_tagerr").addClass("form_error");       
        return false;
    }




    return true;

}



function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
