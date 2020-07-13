$(document).ready(function() {

    var basepath = $("#basepath").val();
    var startDate = new Date($("#acstartDate").val());
    var endDate = new Date($("#acendDate").val());
    
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      startDate: startDate,
      endDate: endDate      
   });

    $("#showtrialbalanceJasper").click(function(){
        var fromdate = $("#fromdate").val().replace(/\//g,'-');
        var todate = $("#todate").val().replace(/\//g,'-');
        $("#fromdate,#todate").removeClass("form_error");
        if(fromdate==""){
             $("#fromdate").addClass("form_error");
             return false;
        }
         if(todate==""){
             $("#todate").addClass("form_error");
             return false;
        }
            // var values = $("#trialbalance").serialize();
            var URL=basepath+"trialbalance/trailJasper/"+fromdate+"/"+todate;
           var w=window.open(URL,'_blank');
           $(w.document).find('html').append('<head><title>Trial Balance</title></head>');
        
       
        
    });

}); // end of document ready