$(document).ready(function() {

    var basepath = $("#basepath").val();

    var startDate = new Date($("#acstartDate").val());
    var endDate = new Date($("#acendDate").val());

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        startDate: startDate,
        endDate: endDate


    });

    //show list using credentials

    // $(document).on('click', "#reprtviewbtn", function(e) {
    //     e.preventDefault();

    //     var from_dt = $("#from_dt").val();
    //     var to_date = $("#to_date").val();

    //     $('#stockregisterlist').html('');
    //     $("#loader").show();

    //     $.ajax({
    //         type: "POST",
    //         url: basepath + 'dailystockregisterbar/getstockregisterlistbydate',
    //         dataType: "html",
    //         data: { from_dt: from_dt, to_date: to_date },

    //         success: function(result) {
    //             $("#loader").hide();
    //             $("#stockregisterlist").html(result);
    //             $(".dataTable").DataTable({
    //                 dom: 'Bfrtip',
    //                 buttons: [{
    //                     extend: 'print',
    //                     title: 'Dakshin Kalikata Sansad',

    //                 }]
    //             });

    //         },
    //         error: function(jqXHR, exception) {
    //             var msg = '';
    //             if (jqXHR.status === 0) {
    //                 msg = 'Not connect.\n Verify Network.';
    //             } else if (jqXHR.status == 404) {
    //                 msg = 'Requested page not found. [404]';
    //             } else if (jqXHR.status == 500) {
    //                 msg = 'Internal Server Error [500].';
    //             } else if (exception === 'parsererror') {
    //                 msg = 'Requested JSON parse failed.';
    //             } else if (exception === 'timeout') {
    //                 msg = 'Time out error.';
    //             } else if (exception === 'abort') {
    //                 msg = 'Ajax request aborted.';
    //             } else {
    //                 msg = 'Uncaught Error.\n' + jqXHR.responseText;
    //             }
    //             // alert(msg);  
    //         }
    //     }); /*end ajax call*/


    // });

    $("#reprtviewbtn").click(function() {
        var fromdate = $("#from_dt").val().replace(/\//g, '-');
        var todate = $("#to_date").val().replace(/\//g, '-');
        $("#fromdate,#todate").removeClass("form_error");
        if (fromdate == "") {
            $("#fromdate").addClass("form_error");
            return false;
        }
        if (todate == "") {
            $("#todate").addClass("form_error");
            return false;
        }
        // var values = $("#trialbalance").serialize();
        var URL = basepath + "dailystockregisterbar/barstockJasper/" + fromdate + "/" + todate;
        var w = window.open(URL, '_blank');
        $(w.document).find('html').append('<head><title>Bar Stock Group Leadger</title></head>');



    });

})