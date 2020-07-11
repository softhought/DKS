$(document).ready(function(){

var basepath = $("#basepath").val();


    //form submit

    $(document).on('submit','#salaryParameterFrom',function(event)
        {
            event.preventDefault();
              $("#errormsg").text('');
              var mode = $("#mode").val();
            
            if(validate())
            {   
    
                var formDataserialize = $("#salaryParameterFrom").serialize();
                formDataserialize = decodeURI(formDataserialize);
               
                var formData = { formDatas: formDataserialize };
                        
                 $("#salparamsavebtn").css('display', 'none');
                $("#loaderbtn").css('display', 'inline-block');
            
                   
            $.ajax({
                    type: "POST",
                    url: basepath+'salaryparameter/salaryparameter_action',
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    data: formData,
                    success: function (result) {
                        if (result.msg_status == 1) {
    
                          
                             $("#salparamsavebtn").css('display', 'inline-block');
                             $("#loaderbtn").css('display', 'none');
                             window.location.href=basepath+'salaryparameter';
                             
    
                           
                       
                      
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
    
            
                
    
            }
    
    
            
        });

  $(document).on("change","#month",function(event){
   
    event.stopPropagation();
    var month = $("#month").val();
    
    });



}); // end of document ready


function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}


function validate(){
	  var month = $("#month").val();
	  var pf_rate = $("#pf_rate").val();
	  var esi_rate = $("#esi_rate").val();
	  var hra_rate = $("#hra_rate").val();
      var esi_limit = $("#esi_limit").val();
      var monthtxt = $("#month option:selected").text();
      var mode = $("#mode").val();
      var orgmonth = $("#orgmonth").val();
     
	   $("#errormsg").text("");
       $("#montheerr,#pf_rate,#esi_rate,#hra_rate,#esi_limit").removeClass("form_error");

       if (month=='') {
           $("#montheerr").addClass("form_error");
              return false;
       }  
        if(orgmonth != month){
            if(validatemonthfun(month) == 1){
            
                $("#errormsg").text(monthtxt+" Month Already Added");
                return false;
            }   
        }
     

       if (pf_rate=='') {
           $("#pf_rate").addClass("form_error");
              return false;
       }

       if (esi_rate=='') {
           $("#esi_rate").addClass("form_error");
              return false;
       }

       if (hra_rate=='') {
           $("#hra_rate").addClass("form_error");
              return false;
       }

       if (esi_limit=='') {
           $("#esi_limit").addClass("form_error");
              return false;
       }

        return true;

}

function validatemonthfun(month){

  
    var basepath = $("#basepath").val();
    var txt = 0;
    $.ajax({
        type: "POST",
        url: basepath+'salaryparameter/validatemonth',
        dataType: "json",
        async:false,
        data: {month:month},
        success: function (result) {
             txt = result.msg_status;
            
        },
    
    });
    return txt;
} 

