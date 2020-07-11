$(document).ready(function(){

 var basepath = $("#basepath").val();


  $(document).on('submit', '#salaryaccountFrom', function(e) {
        e.preventDefault();

        $("#errormsg,#response_msg").html('');
        var mode = $("#mode").val();
        if (validateData()) {


            var formDataserialize = $("#salaryaccountFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'salaryaccounts/salaryaccount_action';
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

                        window.location.href = basepath + 'salaryaccounts';

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

    var sel_component = $("#sel_component").val();
    var sel_department = $("#sel_department").val();
    var sel_account = $("#sel_account").val();
 

    $("#sel_componenterr,#sel_departmenterr,#sel_accounterr").removeClass("form_error");
    $("#errormsg").text('');

    if (sel_component == '') {
        $("#sel_componenterr").addClass("form_error");     
        return false;
    }

    if (sel_department == '') {
        $("#sel_departmenterr").addClass("form_error");       
        return false;
    }

    if (sel_account == '') {
        $("#sel_accounterr").addClass("form_error");       
        return false;
    }


    return true;

}



function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
