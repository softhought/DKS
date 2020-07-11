$(document).ready(function(){

    basepath = $("#basepath").val();


    $(document).on('click', "#listshowbtn", function(e) {
        e.preventDefault();
    
        var category =$("#category").val();
        var status =$("#status").val();
        
        if(validateform()){
        $('#student_list').html('');
        $("#loaderbtn").show();
    
        
        $.ajax({
            type: "POST",
            url: basepath + 'studentstatus/getpartiallist',
            dataType: "html",
            data: { category: category, status: status},
    
            success: function(result) {
                $("#loaderbtn").hide();
                $("#student_list").html(result);
                $("#printbtn").removeClass('dispnone');
                $("#total_amount_value").text($("#total_sub").val());
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
    
    }
    
    
    });


    $(document).on('click', "#printbtn", function(e) {
        e.preventDefault();

        //    $("#response_msg").html("");
       if (validateform()) { 
        var category =$("#category").val();
        var status =$("#status").val();
           
            var URL= basepath+'studentstatus/studentstatusreport/'+category+'/'+status;
            var w=window.open(URL,'_blank');
            $(w.document).find('html').append('<head><title>Student Status Report</title></head>');
    }

      
    });

    


});


function validateform(){
  
    
     $("#caterr,#statuserr").removeClass("form_error");
 
     var category =$("#category").val();
     var status =$("#status").val();
 
     if (category=='') {
         $("#caterr").addClass("form_error");
            return false;
     }else if(status == ""){
        $("#statuserr").addClass("form_error");
        return false;
     }
    
 
  return true;
 }