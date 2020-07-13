$(document).ready(function() {

    var basepath = $("#basepath").val();
    //$('#calender').fullCalendar('destroy');
    fullcalender();

    $('[data-toggle="tooltip"]').tooltip();

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,


    });

    $('.numberonly').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9]/g, '');

    });


    $("#mem_booking_id").change(function() {

        $("#mem_booking_code").val($("#mem_booking_id option:selected").text());

        $("#member_name").val($(this).find(':selected').attr('data-membername'));

    })


    //form submit

    $(document).on('submit', '#partybookingFrom', function(event) {
        event.preventDefault();
        $("#errormsg").text('');
        var mode = $("#mode").val();

        if (formvalidate()) {

            // var formDataserialize = $("#partybookingFrom").serialize();
            //formDataserialize = decodeURI(formDataserialize);

            var formData = new FormData($(this)[0]);

            $("#bookingsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');


            $.ajax({
                type: "POST",
                url: basepath + 'partybooking/addedit_action',
                dataType: "json",
                processData: false,
                contentType: false,
                data: formData,
                success: function(result) {
                    if (result.msg_status == 1) {

                        if (mode == 'EDIT') {
                            $("#bookingsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'partybooking';

                        } else {

                            $("#errormsg").removeClass('errormsgcolor');
                            $("#errormsg").text(result.msg_data).addClass('succmsg');
                            $("#bookingsavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href = basepath + 'partybooking/addeditpartybooking';


                        }

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


        }


    })

    //show list using credentials

    $(document).on('click', "#bookingshowbtn", function(e) {
        e.preventDefault();


        var from_dt = $("#from_dt").val();
        var to_date = $("#to_date").val();
        var timeslot = $("#timeslot").val();
        var location = $("#location").val();



        $('#bookinglistid').html('');
        $("#loader").show();

        $.ajax({
            type: "POST",
            url: basepath + 'partybooking/getparbookinglistbydate',
            dataType: "html",
            data: { from_dt: from_dt, to_date: to_date, timeslot: timeslot, location_id: location },

            success: function(result) {
                $("#loader").hide();
                $("#bookinglistid").html(result);
                $(".dataTable").DataTable();

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

    $(document).on("click", ".cancelbtn", function() {

        var uid = $(this).data("bookingid");
        var status = $(this).data("iscancel");
        var url = basepath + 'partybooking/bookingcancel';
        setActiveStatus(uid, status, url);


    });

    //calender view

    // $('#calender').fullCalendar({

    //     // header: {
    //     //     left: 'prev,next today',
    //     //     center: 'title',
    //     //     right: 'month,agendaWeek,agendaDay,listWeek'
    //     // },
    //     // defaultDate: new Date(),
    //     // navLinks: true, // can click day/week names to navigate views
    //     // editable: false,
    //     // eventLimit: 3, // allow "more" link when too many events        
    //     // events: { url: basepath + 'calender/getbookingdata' },
    //     // displayEventTime: false,

    //     // eventRender: function(event, element, view) {
    //     //     if (event.allDay === 'true') {
    //     //         event.allDay = true;
    //     //     } else {
    //     //         event.allDay = false;
    //     //     }
    //     // },



    // });





    //fullcalender();
    $("#datebooking").click(function() {


        //$('#calender').fullCalendar({ events: {} });
        $('#calender').fullCalendar('destroy');
        fullcalender();
    })



});


function fullcalender() {

    var basepath = $("#basepath").val();
    var location = $("#location").val();
    $("#calender").html('');
    $("#loader").css("display", "block");
    $.ajax({
        type: "POST",
        url: basepath + 'calender/getbookingdata',
        dataType: "json",
        //contentType: false,
        data: { location: location },
        success: function(result) {
            //console.log(result);
            //$('#calender').css('display', 'block');
            // $('#calendar').fullCalendar('removeEvents');
            // $('#calendar').fullCalendar('addEventSource', result);
            // $('#calendar').fullCalendar('rerenderEvents');
            $("#loader").css("display", "none");
            $('#calender').fullCalendar({
                displayEventTime: false,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,listWeek'
                },
                defaultDate: new Date(),
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                eventLimit: 3, // allow "more" link when too many events        
                events: result,


            });



        }

    });
}





function formvalidate() {

    var mem_booking_id = $("#mem_booking_id").val();
    var booking_date = $("#booking_date").val();
    var party_date = $("#party_date").val();
    var time_slot = $("#time_slot").val();
    var party_location = $("#party_location").val();
    var no_of_heads = $.trim($("#no_of_heads").val());


    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    $("#errormsg").text();

    if (mem_booking_id == '') {
        $("#errormsg").text('Error : Select Member Code');
        $("#mem_booking_id").focus();
        return false;
    } else if (booking_date == '') {
        $("#errormsg").text('Error : Enter Booking Date');
        $("#booking_date").focus();
        return false;
    } else if (isDate(booking_date) == false) {
        $("#errormsg").text('Error : Enter Correct Booking Date');
        $("#booking_date").focus();
        return false;
    } else if (party_date == '') {
        $("#errormsg").text('Error : Enter Party Date');
        $("#party_date").focus();
        return false;
    } else if (isDate(party_date) == false) {
        $("#errormsg").text('Error : Enter Correct Party Date');
        $("#party_date").focus();
        return false;
    } else if (time_slot == '') {
        $("#errormsg").text('Error : Select Time Slot');
        $("#time_slot").focus();
        return false;

    } else if (party_location == '') {
        $("#errormsg").text('Error : Select Party Location');
        $("#party_location").focus();
        return false;

    } else if (no_of_heads == '') {
        $("#errormsg").text('Error : Enter No. Of  Heads');
        $("#no_of_heads").focus();
        return false;

    }
    return true;
}