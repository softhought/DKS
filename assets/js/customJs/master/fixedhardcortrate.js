$(document).ready(function(){
    var basepath = $("#basepath").val()

    $('.numberwithdecimal').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9\.]/g, '');

  });
    //form Submit

$(document).on('submit','#fixedhardcourtFrom',function(event)
{
    event.preventDefault();
      $("#errormsg").text('');
      var mode = $("#mode").val();
    if(validateform())
    {   

        var formDataserialize = $("#fixedhardcourtFrom").serialize();
        formDataserialize = decodeURI(formDataserialize);
       
        var formData = { formDatas: formDataserialize };
                
         $("#fixedhardbtn").css('display', 'none');
        $("#loaderbtn").css('display', 'inline-block');
    
           
    $.ajax({
            type: "POST",
            url: basepath+'fixedhardcourtrate/fixedhardcort_action',
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: formData,                
            success: function (result) {
                
                     $("#fixedhardbtn").css('display', 'inline-block');
                     $("#loaderbtn").css('display', 'none');
                     window.location.href=basepath+'fixedhardcourtrate';
                  
               
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
})

function validatecode(){


    var from_dt = $("#from_dt").val();
    var to_date = $("#to_date").val();
    var student_id = $("#student_code").val();
   
     $("#fromdaterr,#todateerr,#studenterr").text('').removeClass('perrmsg');
   
     if(student_id == ''){
   
        if(from_dt == ''){
   
          $("#fromdaterr").text('Enter From Date').addClass('perrmsg');
          $("#from_dt").focus();
          return false;
        }   
   
       else if(to_date == ''){
   
          $("#todateerr").text('Enter To Date').addClass('perrmsg');
          $("#to_date").focus();
          return false;
          } 
     } 
   
     
     return true;
   
   
   }
   
   function validateform(){
   
   
    var rate = $("#rate").val();
   
     $("#errormsg").text('');
   
     
       if(rate == ''){
   
          $("#errormsg").text('Enter Rate');
          $("#rate").focus();
          return false;
        }
     
   
     return true;
   
   
   }