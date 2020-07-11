$(document).ready(function(){

var basepath = $("#basepath").val();


    $('#month').on('change', function(e) {
        e.preventDefault();

        var month = $("#month").val();
        if (month != '') {

            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'employeeattendance/lastDayOfmonth';

            $.ajax({
                type: type,
                url: urlpath,
                data: { month: month },
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {

                    $("#attendance_days").val(result.lastdate);


                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });


        } else {
            $("#bill_dt").val('');
        }

    });





$(document).on('submit','#employeeattendanceFrom',function(event)
    {
        event.preventDefault();

          $("#errormsg").text('');
          var mode = $("#mode").val();

        if(validateMasterData())
        {     $('#entry_mode').attr("disabled", false); 

            var formDataserialize = $("#employeeattendanceFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#attendancesavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'employeeattendance/attendanceAction',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    if (result.msg_status == 1) {
                       $("#loaderbtn").css('display', 'none');

                   			 window.location.replace(basepath+'employeeattendance');
                 
                    } 
                    else {
                     
                    }
                   
                   
                }, 
                error: function (jqXHR, exception) {
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
                

        }   // end master validation

       
    });



$(document).on('click','#showloanbtn',function(event)
    {
        event.preventDefault();

       

        var month = $("#month").val();
        $("#montherr").removeClass("form_error");
        if (month == '') {
            $("#montherr").addClass("form_error");
            return false;
        }
        $("#heads").val('0');
        $("#response_msg").html("Processing please wait...");
        $('#loader').show();
      
       
        var urlpath = basepath + 'employeeattendance/EmployeeAttendanceListview';
        $("#employee_list").html('');
        $.ajax({
            type: "POST",
            url: urlpath,
            data: {month:month},
            dataType: "html",
            success: function(result) {
                $('#loader').hide();
                $("#employee_list").html(result);
                  $('.dataTable').DataTable();
                // $('.dataTable').DataTable({
                //     "paging": false,
                //     "ordering": false,
                //     "info": false

                // });



                //  var tripReportProject = $("#tripReportProject").val();
                $("#response_msg").html("");

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
        });

    });






}); // end of document ready




function validateMasterData(){

     var month=$("#month").val();
     var attendance_days=$("#attendance_days").val();
    


   	 $("#montherr").removeClass("form_error");
	 $('#error_msg').text('');
	 $('#errormsg').text('');

	 if (month=='') {
	 	 $("#montherr").addClass("form_error");
          return false;
	 }

	 if (attendance_days=='') {
	 	 $("#attendance_days").addClass("form_error");
          return false;
	 }





	return true;
}

