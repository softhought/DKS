$(document).ready(function(){
 	
 var basepath = $("#basepath").val();



 $(document).on('submit', '#rawMeterialFrom', function(e) {
        e.preventDefault();

        $("#errormsg,#response_msg").html('');
        var mode = $("#mode").val();
        if (validateData()) {


            var formDataserialize = $("#rawMeterialFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'rawmeterial/rawmeterial_action';
            $("#rawmeterialsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-table');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                        window.location.href = basepath + 'rawmeterial';




                    } else {
                        $("#response_msg").text(result.msg_data);
                        $("#rawmeterialsavebtn").show();
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









}); // end of document ready


function numericFilter(txb) {

	txb.value = txb.value.replace(/[^\0-9]/ig, "");

}



function validateData() {

    var name = $("#name").val();
    var sel_group = $("#sel_group").val();
    var sel_unit = $("#sel_unit").val();

    $("#name,#sel_grouperr,#sel_uniterr").removeClass("form_error");
    $("#errormsg").text('');

    if (name == '') {
        $("#name").addClass("form_error");
       
        return false;
    }

    if (sel_group == '') {

        $("#sel_grouperr").addClass("form_error");
        return false;
    }

    if (sel_unit == '') {
    	
        $("#sel_uniterr").addClass("form_error");
        return false;
    }


    return true;

}
