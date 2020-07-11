$(document).ready(function(){

    var basepath = $("#basepath").val();

   $(document).on('click', "#salarypayslipbtn", function(e) {
        e.preventDefault();

       var month_id =$("#month_id").val();
       var dept_id =$("#dept_id").val();
       var emp_id =$("#emp_id").val();
      
     
  if(1){
         $('#salary_register_data').html('');
         $("#salryprintbtn").css("display","none");
         $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'salarypayslip/getSalaryregisterlist',
                dataType: "html",
                data: {
                    month_id:month_id,
                    dept_id:dept_id,
                    emp_id:emp_id,
                        
                     },
                
                success: function (result) {
                   $("#loader").hide();
                     $("#salary_register_data").html(result);
                  
                    if($("#salaryreg tbody tr").length >= 1){
                        $("#salryprintbtn").css("display","block");
                    }                                        
                    
                    $(".dataTable").DataTable();
                    
                 
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


$(document).on('click', "#printsalarykbtn", function(e) {
    e.preventDefault();
      
    var monthid = ($("#month_id").val() == '') ? 0:$("#month_id").val(); 
    var dept_id = ($("#dept_id").val() == '') ? 0:$("#dept_id").val(); 
    var empid = ($("#emp_id").val() == '') ? 0:$("#emp_id").val(); 
       
    //  alert(monthid);   
    //  alert(dept_id);   
    //  alert(empid);   
       
        var URL= basepath+'salarypayslip/salarysliprintJasper/'+monthid+'/'+dept_id+'/'+empid;
        var w=window.open(URL,'_blank');
        $(w.document).find('html').append('<head><title>Salary Payslip</title></head>');


  
});


}); //end document ready

