$(document).ready(function() {



    var basepath = $("#basepath").val();



    $('.numberwithdecimal').bind('keyup paste', function() {

        this.value = this.value.replace(/[^0-9\.]/g, '');



    });



    $('.onlynumber').bind('keyup paste', function() {

        this.value = this.value.replace(/[^0-9]/g, '');



    });







    $('#memberlist').DataTable({



        "orderCellsTop": true,

        language: {

            search: "_INPUT_",

            searchPlaceholder: "Search..."

        },

        'aoColumnDefs': [{

            'bSortable': false,

            'aTargets': [-1, -2] /* 1st one, start by the right */

        }],

        initComplete: function() {

            this.api().columns([5]).every(function() {

                var column = this;

                var select = $('<select class="form_input_text select2"><option value="">Show all</option></select>')

                    .appendTo($(column.footer()).empty())

                    .on('change', function() {

                        var val = $.fn.dataTable.util.escapeRegex(

                            $(this).val()

                        );



                        column

                            .search(val ? '^' + val + '$' : '', true, false)

                            .draw();

                    });



                column.data().unique().sort().each(function(d, j) {

                    select.append('<option value="' + d + '">' + d + '</option>')

                });

            });

        }







    });



    $('#memberlist tfoot tr').insertAfter($('#memberlist thead tr'));





    // Add children Details

    $(document).on('click', '#addchilddtl', function() {



        // rowNoUpload++;

        // $("#selmens_medicineerr").removeClass("bordererror");





        var rowno = $("#rowno").val();

        var children_name = $("#children_name").val();

        var child_dob = $("#child_dob").val();

        var child_occupation = $("#child_occupation").val();

        var occup_name = $("#child_occupation option:selected").text();



        var children_gender = $("#children_gender").val();

        var gendername = $("#children_gender option:selected").text();



        var child_mobile = $("#child_mobile").val();





        //console.log(basepath);

        if (validatechilddtl()) {

            rowno++;

            $.ajax({

                type: "POST",

                url: basepath + 'membermaster/addchildrenDetail',

                dataType: "html",

                data: {

                    rowNo: rowno,

                    children_name: children_name,

                    child_dob: child_dob,

                    child_occupation: child_occupation,

                    occup_name: occup_name,

                    children_gender: children_gender,

                    gendername: gendername,

                    child_mobile: child_mobile,



                },

                success: function(result) {

                    $("#rowno").val(rowno);

                    $("#detail_memberchild table").show();

                    $("#detail_memberchild table tbody").append(result);

                    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });



                    $('#children_name').val('');

                    $('#child_dob').val('');

                    $('#child_occupation').val('').change();

                    $('#children_gender').val('').change();

                    $('#child_mobile').val('');









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



    //edit member children details



    // $(document).on('click','.editchilddetails',function(){



    //         var currRowID = $(this).attr('id');

    //         var rowDtlNo = currRowID.split('_');

    //        // console.log(rowDtlNo[1]);

    //         //console.log(currRowID);

    //        $("#children_name").val($('#child_name_'+rowDtlNo[1]).val());

    //        $("#child_dob").val($('#children_dob_'+rowDtlNo[1]).val());

    //        $("#child_occupation").val($('#children_occup_'+rowDtlNo[1]).val()).change();

    //        $("#children_gender").val($('#children_gender_'+rowDtlNo[1]).val()).change();

    //        $("#child_mobile").val($('#children_mobile_'+rowDtlNo[1]).val());

    //         //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();

    //          $("tr#rowchilddetails_"+rowDtlNo[1]).remove();





    // });



    //edit member children details2

    $(document).on('click', '.editchilddetails', function() {



        var currRowID = $(this).attr('id');

        var rowDtlNo = currRowID.split('_');

        var editcheck = $("#editbtncheck_" + rowDtlNo[1]).val();



        $(".showdata_" + rowDtlNo[1]).hide();

        $(".dispblock_" + rowDtlNo[1]).css('display', 'block');

        $(".editchilddtl_" + rowDtlNo[1]).prop('type', 'text');

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

    $(document).on('click', '.delchildDetails', function() {



        var currRowID = $(this).attr('id');

        var rowDtlNo = currRowID.split('_');





        delIdarr.push($("#childdtlId_" + rowDtlNo[1]).val());

        //console.log(delIdarr);

        $("#delIds").val(delIdarr);

        //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();

        $("tr#rowchilddetails_" + rowDtlNo[1]).remove();

    });



    //form submit





    $(document).on('submit', '#memberregistration', function(event) {

        event.preventDefault();

        $("#errormsg").text('');



        if (validateform()) {



            // var formDataserialize = $("#stdentregisterForm").serialize();

            // formDataserialize = decodeURI(formDataserialize);



            // var formData = { formDatas: formDataserialize };



            var formData = new FormData($(this)[0]);



            $("#membersavebtn").css('display', 'none');

            $("#loaderbtn").css('display', 'inline-block');





            $.ajax({

                type: "POST",

                url: basepath + 'membermaster/registration_action',

                dataType: "json",

                processData: false,

                contentType: false,

                data: formData,



                success: function(result) {





                    if (result.msg_status == 1) {





                        $("#membersavebtn").css('display', 'inline-block');

                        $("#loaderbtn").css('display', 'none');

                        window.location.href = basepath + 'membermaster';







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







function numericFilter(txt) {

    txt.value = txt.value.replace(/[^0-9]/g, '');

}







function readURL(input) {



    $("#isImage").val('Y');



    if (input.files && input.files[0]) {

        var reader = new FileReader();



        reader.onload = function(e) {

            $('#showimage')

                .attr('src', e.target.result)

                .width(120)

                .height(125);

        };



        reader.readAsDataURL(input.files[0]);

    }





}

function readCommanURL(input) {

   
    var id = $(input).attr('data-showId');
    var isimage = $(input).attr('data-isimage');
  
    $("#"+isimage).val('Y');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#'+id)
                .attr('src', e.target.result)
                .width(120)
                .height(125);
        };

        reader.readAsDataURL(input.files[0]);

    }

}

// 


function validateform() {



    var title_one = $('#title_one').val();

    var member_name = $('#member_name').val();

    var mem_dob = $('#mem_dob').val();

    var member_occupation = $('#member_occupation').val();

    var mem_category = $('#mem_category').val();

    var mobile_no = $('#mobile_no').val();

    var email = $('#email').val();

    var address_one = $('#address_one').val();

    var city = $('#city').val();

    var pincode = $('#pincode').val();

    var status = $('#status').val();

    var admission_date = $('#admission_date').val();

    var closing_dt = $('#closing_dt').val();

    var spouse_dob = $('#spouse_dob').val();



    $("#membernameerr,#memberdoberr,#memberoccuperr,#membercatperr,#mobileerr,#emailerr,#cityerr,#addressoneerr,#pincodeerr,#statuserr").text('');

    $("#addmissionerr,#closdterr,#spousedobdterr").text('');

    if (title_one == '') {



        $("#membernameerr").text('Select Member Title');

        $("#title_one").focus();

        return false;

    } else if (member_name == '') {

        $("#membernameerr").text('Enter Member Name');

        $("#member_name").focus();

        return false;

    } else if (mem_dob == '') {

        $("#memberdoberr").text('Enter Member DOB');

        $("#mem_dob").focus();

        return false;

    } else if (mem_dob != '' && isDate(mem_dob) == false) {



        $("#memberdoberr").text('Enter Correct Date');

        $("#mem_dob").focus();

        return false;



    } else if (member_occupation == '') {

        $("#memberoccuperr").text('Select Member Occupation');

        $("#member_occupation").focus();

        return false;

    } else if (mem_category == '') {

        $("#membercatperr").text('Select Member Category');

        $("#mem_category").focus();

        return false;

    } else if (mobile_no == '') {

        $("#mobileerr").text('Enter Mobile No.');

        $("#mobile_no").focus();

        return false;

    } else if (mobile_no.length < 10) {

        $("#mobileerr").text('Enter 10 digit Mobile No.');

        $("#mobile_no").focus();

        return false;

    } else if (email == '') {

        $("#emailerr").text('Enter Proper Email ');

        $("#email").focus();

        return false;

    } else if (address_one == '') {

        $("#addressoneerr").text('Enter Address ');

        $("#address_one").focus();

        return false;

    } else if (city == '') {

        $("#cityerr").text('Enter City ');

        $("#city").focus();

        return false;

    } else if (pincode == '') {

        $("#pincodeerr").text('Enter Pincode ');

        $("#pincode").focus();

        return false;

    } else if (status == '') {

        $("#statuserr").text('Select Status ');

        $("#status").focus();

        return false;

    } else if (admission_date != '' && isDate(admission_date) == false) {

        $("#addmissionerr").text('Enter Correct Admission Date ');

        $("#admission_date").focus();

        return false;



    } else if (closing_dt != '' && isDate(closing_dt) == false) {

        $("#closdterr").text('Enter Correct CLosing Date ');

        $("#closing_dt").focus();

        return false;



    } else if (spouse_dob != '' && isDate(spouse_dob) == false) {

        $("#spousedobdterr").text('Enter Correct Spouse DOB Date ');

        $("#spouse_dob").focus();

        return false;



    }



    return true;





}



function validatechilddtl() {



    var childname = $("#children_name").val();

    var children_gender = $("#children_gender").val();

    var child_mobile = $("#child_mobile").val();

    var child_dob = $("#child_dob").val();





    $('.childnameerr,#childdoberr,#childgenerr,.childmobileerr').removeClass('form_err2');



    if (childname == '') {

        $(".childnameerr").addClass('form_err2');

        $("#children_name").focus();

        return false;



    } else if (child_dob != '' && isDate(child_dob) == false) {





        $("#childdoberr").addClass('form_err2');

        $("#child_dob").focus();

        return false;



    } else if (children_gender == '') {



        $("#childgenerr").addClass('form_err2');

        $("#children_gender").focus();

        return false;



    } else if (child_mobile != '' && child_mobile.length < 10) {





        $(".childmobileerr").addClass('form_err2');

        $("#child_mobile").focus();

        return false;



    }



    return true;





}