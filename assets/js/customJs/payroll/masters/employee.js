$(document).ready(function() {

    var basepath = $('#basepath').val();
    var mode = $("#mode").val();


    $('.decimalnumber').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');

    });
    $('.numberonly').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9]/g, '');

    });
    $('.showinput').click(function() {

        var showid = $(this).attr('data-showid');

        if ($(this).prop('checked') == false) {

            $('#' + showid).prop('disabled', true);
            $('#' + showid).val('');
            $(this).val('N');

        } else {

            $('#' + showid).prop('disabled', false);
            $(this).val('Y');

        }




    });



    // Add Salary Details
    $(document).on('click', '#addmoresalry', function() {

        // rowNoUpload++;
        // $("#selmens_medicineerr").removeClass("bordererror");

        var rowno = $("#rowno").val();
        var month_id = $("#month_id").val();
        var month_name = $("#month_id option:selected").text();
        var basic_salary = $("#basic_salary").val();
       // var salary_da = $("#salary_da").val();
        var traveling = $("#traveling").val();
        var house_rent = $("#house_rent").val();


        //console.log(basepath);
        if (validateempdtl()) {
            rowno++;
            $.ajax({
                type: "POST",
                url: basepath + 'employee/addemployeeDetail',
                dataType: "html",
                data: {
                    rowNo: rowno,
                    month_id: month_id,
                    month_name: month_name,
                    basic_salary: basic_salary,
                    traveling: traveling,
                    house_rent: house_rent,

                },
                success: function(result) {
                    $("#rowno").val(rowno);
                    $("#detail_employeesalry table").show();
                    $("#detail_employeesalry table tbody").append(result);
                    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

                    $('#basic_salary').val('');
                    $('#salary_da').val('');
                    $('#month_id').val('').change();
                    $('#house_rent').val('');




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

        }

    }); // End Visiting Details  

    //edit Employee salary details
    $(document).on('click', '.editemployeedetails', function() {

        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        var editcheck = $("#editbtncheck_" + rowDtlNo[1]).val();

        $(".showdata_" + rowDtlNo[1]).hide();
        $(".dispblock_" + rowDtlNo[1]).css('display', 'block');
        $(".editemployeedtl_" + rowDtlNo[1]).prop('type', 'text');
        $('.select2').select2();
        $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

        // if(editcheck == 'N'){
        //  $(".showdata_"+rowDtlNo[1]).hide();
        //  $(".dispblock_"+rowDtlNo[1]).css('display','block');
        //  $(".editchilddtl_"+rowDtlNo[1]).prop('type','text');
        //   $('.select2').select2();
        //  $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //  $("#editbtncheck_"+rowDtlNo[1]).val('Y');
        // }else{

        //     $(".showdata_"+rowDtlNo[1]).show();

        //     //$(".valch_"+rowDtlNo[1]).val('');
        //  $(".dispblock_"+rowDtlNo[1]).css('display','none');
        //  $(".editchilddtl_"+rowDtlNo[1]).prop('type','hidden');

        //  $("#editbtncheck_"+rowDtlNo[1]).val('N');

        // }


    });


    // Delete Table Row
    // globle define aarry to store delete id      
    var delIdarr = [];
    $(document).on('click', '.delemployeeDetails', function() {

        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');

        delIdarr.push($("#employeedtlId_" + rowDtlNo[1]).val());
        //console.log(delIdarr);
        $("#delIds").val(delIdarr);
        //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
        $("tr#rowsalarydetails_" + rowDtlNo[1]).remove();
    });

    //form submit


    $(document).on('submit', '#employeeFrom', function(event) {
        event.preventDefault();
        $("#errormsg").text('');

        if (validateform()) {

            // var formDataserialize = $("#stdentregisterForm").serialize();
            // formDataserialize = decodeURI(formDataserialize);

            // var formData = { formDatas: formDataserialize };

            var formData = new FormData($(this)[0]);

            $("#employeesavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');


            $.ajax({
                type: "POST",
                url: basepath + 'employee/addedit_action',
                dataType: "json",
                processData: false,
                contentType: false,
                data: formData,

                success: function(result) {
                    if (result.msg_status == 1) {
                        if (mode == 'ADD') {
                            window.location.href = basepath + 'employee/addeditemployee';
                            $("#errormsg").removeClass('errormsgcolor');
                            $("#errormsg").text(result.msg_data).addClass('succmsg');
                            // $("#employeeFrom .form-control").val('');
                            // $("#employeeFrom .form-control").val('').change();
                            // $("#salarytabl > tbody").html('');


                        } else {
                            window.location.href = basepath + 'employee';
                        }
                        $("#employeesavebtn").css('display', 'inline-block');
                        $("#loaderbtn").css('display', 'none');
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



/* Hra*/

    $(document).on('change input', '#month_id,#basic_salary', function(event) {
        event.preventDefault();
        $("#errormsg").text('');

        var month_id = $("#month_id").val();
        var basic_salary = $("#basic_salary").val();

        if (month_id!='' && basic_salary!='') {



            $.ajax({
                type: "POST",
                url: basepath + 'employee/hra_rate',
                dataType: "json",
                
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: {month_id:month_id,basic_salary:basic_salary},

                success: function(result) {
                    $("#house_rent").val(result.hra);

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




function validateempdtl() {

    var month_id = $("#month_id").val();
    var basic_salary = $("#basic_salary").val();
    var allmonthids = [];
    $('.monthIds').each(function() {
        allmonthids.push($(this).val());

    });

    $('#errormsg').text('');
    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    //alert(jQuery.inArray(month_id, allmonthids));

    $("#montherr,#basicerr").removeClass('form_error');
    if (month_id == '') {
        $("#montherr").addClass('form_error');
        $("#month_id").focus();
        return false;

    } else if ($.inArray(month_id, allmonthids) != -1) {
        $('#montherr').addClass('form_error');
        $('#errormsg').text('This Salary Month Already Added')
        $("#month_id").focus();
        return false;
    } else if (basic_salary == '') {
        $('#basicerr').addClass('form_error');
        $("#basic_salary").focus();
        return false;
    }
    return true;

}

function validateform() {

    var name = $.trim($("#name").val());
    var emp_dob = $("#emp_dob").val();
    var designation_id = $("#designation_id").val();
    var dept_id = $("#dept_id").val();
    var retirement_date = $.trim($("#retirement_date").val());

    var join_date = $.trim($("#join_date").val());
    $("#nameerr,#doberr,#designationerr,#depterr,#retiredateerr,#joindaterr").removeClass('form_error');
    if (name == '') {

        $("#nameerr").addClass('form_error');
        $("#name").focus();
        return false;
    } else if (emp_dob == '') {
        $("#doberr").addClass('form_error');
        $("#emp_dob").focus();
        return false;
    } else if (emp_dob != '' && isDate(emp_dob) == false) {
        $("#doberr").addClass('form_error');
        $("#emp_dob").focus();
        return false;
    } else if (retirement_date != '' && isDate(retirement_date) == false) {
        $("#retiredateerr").addClass('form_error');
        $("#retirement_date").focus();
        return false;
    } else if (join_date != '' && isDate(join_date) == false) {
        $("#joindaterr").addClass('form_error');
        $("#join_date").focus();
        return false;
    } else if (designation_id == '') {
        $("#designationerr").addClass('form_error');
        $("#designation_id").focus();
        return false;
    } else if (dept_id == '') {
        $("#depterr").addClass('form_error');
        $("#dept_id").focus();
        return false;
    }
    return true;


}