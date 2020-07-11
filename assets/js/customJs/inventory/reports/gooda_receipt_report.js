$(document).ready(function() {
    var basepath = $("#basepath").val();

    var startdt = new Date($("#acstartDate").val());
    var enddt = new Date($("#acendDate").val());

    //alert(startdt);
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: startdt,
        endDate: enddt,
        autoclose: true

    });


    $(document).on('click', ".rowCheckAll", function() {
        var i = 0;


        if ($("#rowCheckAll").is(':checked')) {
            console.log("checked");
            $('.rowCheck').prop('checked', true);

        } else {
            console.log("unchecked");
            $('.rowCheck').prop('checked', false);

        }
        $(".rowCheck").each(function() {

            console.log(i++)
        });
        var checkbox = $("input:checkbox.rowCheck:checked").length;
        $("#heads").val(checkbox);

    });


    $(document).on('click', "#goodsreceiptprint", function(e) {
        e.preventDefault();
        var data = [];
        $(".rowCheck").each(function() {
            row = $(this).val();
            if ($(this).is(':checked')) {

                data.push($("#vendorid_" + row).val());
                //var fulldata = data.toString();
            }
        });
        $("#selectvendor").val(data.toString());
        var fromdate = $("#from_date").val().replace(/\//g, '-');
        var todate = $("#to_date").val().replace(/\//g, '-');
        // console.log(data.toString());
        //    $("#response_msg").html("");
        if (validatevender()) {

            var URL = basepath + "goodsreceiptreport/goodsreceiptreport/" + fromdate + "/" + todate + "/" + encodeURIComponent(data.toString());
            var w = window.open(URL, '_blank');
            $(w.document).find('html').append('<head><title>Goods Receipt Report</title></head>');

        }


    });


}); // end of document ready 



function validatevender() {

    $("#errormsg").text('');
    var flag = 0;
    $(".rowCheck").each(function() {
        row = $(this).val();
        if ($(this).is(':checked')) {

            flag = 1;
            //var fulldata = data.toString();
        }
    });

    $("#vendor_drp").removeClass("form_error");

    if (flag == 0) {
        $("#errormsg").text('Check At Least One Vendor')
        $("#vendor_drp").addClass("form_error");
        return false;
    }

    return true;
}