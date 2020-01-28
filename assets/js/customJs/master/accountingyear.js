$(document).ready(function(){

var basepath = $("#basepath").val();
var mode = $("#mode").val();

var startDate = new Date($("#last_startdate").val());
var endDate = new Date($("#last_enddate").val());


//for exact date choose for accounting year

if(mode == 'ADD'){

var fromdate1 = '01/04/'+(startDate.getFullYear()+1);
var fromdate2 = '01/04/'+(startDate.getFullYear()+1);

var fromdate3 = '31/03/'+(endDate.getFullYear()+1);
var fromdate4 = '31/03/'+(endDate.getFullYear()+1);

}else{

   var fromdate1 = '01/04/'+(startDate.getFullYear());
   var fromdate2 = '01/04/'+(startDate.getFullYear());

   var fromdate3 = '31/03/'+(endDate.getFullYear());
   var fromdate4 = '31/03/'+(endDate.getFullYear());

}



//alert(fromdate3);

$('.datepicker1').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true,
    startDate: fromdate1,
    endDate: fromdate2
    
});

$('.datepicker2').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true,
    startDate: fromdate3,
    endDate: fromdate4
    
});

// $('.datepicker').datepicker({
//     format: 'dd/mm/yyyy',
//     autoclose: true,
//     startDate: startDate
   
    
// });


//form submit

$(document).on('submit','#accountyearForm',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(validateform())
        {   

            var formDataserialize = $("#accountyearForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#accyearsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'accountingyear/accountingyear_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    
                    if (result.msg_status == 1) {

                    	if(mode == 'EDIT'){


                    	 $("#accyearsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'accountingyear';
                         //showMsg();

                    	}else{

                    	 $("#errormsg").removeClass('errormsgcolor');
                         $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                         $("#accyearsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         $('#groupname').val('');                    
                         $('#gropcat').val('').change();                    
                         $('#subgropucat').val('').change();

                    	}

                                             
                  
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


})

function validateform(){

 var startDate = $("#start_date").val();
 var endDate = $("#end_date").val();

  $("#errormsg").text('').removeClass('succmsg');

  if(startDate == ''){

  	 $("#errormsg").text('Select Start Date').addClass('errormsgcolor');
  	 $("#start_date").focus();
  	 return false;
  }else if(endDate == ''){
  	 $("#errormsg").text('Select End Date').addClass('errormsgcolor');
  	 $("#end_date").focus();
  	 return false;
  }

 return true;


}





function accoutingperiod(){

  
  var startDate = $("#start_date").val();
  var endDate = $("#end_date").val();
  

  if(startDate != '' && endDate != ''){

  	    
     startaccperiod = startDate.split('/');
     endaccperiod = endDate.split('/');

   
     $("#acc_period").val(startaccperiod[2] +" - "+ endaccperiod[2]);

  }


}