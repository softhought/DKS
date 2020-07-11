$(document).ready(function() {
    var basepath = $("#basepath").val();
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,


    });

    //show list using credentials

    $(document).on('click', "#reprtviewbtn", function(e) {
        e.preventDefault();

        var from_dt = $("#from_dt").val();
        var to_date = $("#to_date").val();
        var selmode = $("#selmode").val();

        $('#report').html('');
        $("#loader").show();

        $.ajax({
            type: "POST",
            url: basepath + 'dailypursalreport/getreportlistbydate',
            dataType: "html",
            data: { from_dt: from_dt, to_date: to_date, selmode: selmode },

            success: function(result) {
                $("#loader").hide();
                $("#report").html(result);
                $(".dataTable").DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'print',
                        title: 'Dakshin Kalikata Sansad',

                    }]
                });

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


    });
})