$(document).ready(function(){

var basepath =$("#basepath").val();
$("#intraturnamentfeeApplybtn").hide();
$("#monthblock,#monthblock2,#quarterblock,#quarterblock2").hide();

   $('#billing_style').on('change',function(e){
        e.preventDefault();

        var billing_style =$("#billing_style").val();
        $("#monthblock,#monthblock2,#quarterblock,#quarterblock2").hide();
      	if (billing_style=='M') {
      		$("#monthblock,#monthblock2").show();
      	}else if (billing_style=='Q') {
      		$("#quarterblock,#quarterblock2").show();
      	}

    });



    $('#intraturnamentbtn').on('click',function(e){
        e.preventDefault();


		 	if (validateShow()) {

            $('#loader').show();

            var formDataserialize = $("#interTournamentFrom").serialize();
            var urlpath = basepath + 'Intratournament/studentListview';
            $("#student_list").html('');
            $.ajax({        
                type: "POST",
                url: urlpath,
                data:formDataserialize,
                dataType: "html",            
                success: function(result) {
                    $('#loader').hide();  
                    $("#student_list").html(result);
                     $('.dataTable').DataTable();

              //  var tripReportProject = $("#tripReportProject").val();

            
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

        }
             
    });






}); // end of document ready



function validateShow(){


    var billing_style =$("#billing_style").val();

    console.log(billing_style);
  $("#errormsg").text("");
  $("#billing_styleerr,#from_montherr,#to_montherr,#quarter_montherr").removeClass("form_error");

	    if (billing_style=='') {
		 	 $("#billing_styleerr").addClass("form_error");
	        return false;
		 }
       
      	if (billing_style=='M') {
      		var from_month =$("#from_month").val();
      		var to_month =$("#to_month").val();

      		 if (from_month=='') {
		 	   $("#from_montherr").addClass("form_error");
	           return false;
		     }

		      if (to_month=='') {
		 	   $("#to_montherr").addClass("form_error");
	           return false;
		     }

      		
      	}else if (billing_style=='Q') {

      		var quarter_month =$("#quarter_month").val();
      		 if (quarter_month=='') {
		 	   $("#quarter_montherr").addClass("form_error");
	           return false;
		     }


      		
      	}


        

   





 
    return true;
}