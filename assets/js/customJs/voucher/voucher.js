$(document).ready(function(){

  var basepath = $("#basepath").val();
    var session_strt_date = $('#startyear').val();
    var session_end_date = $('#endyear').val();
    var mindate = '01/04/' + session_strt_date;
    var maxDate = '31/03/' + session_end_date;

  // $('.datepicker').datepicker({
  // 	orientation: 'bottom'
  // });

     $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        orientation: 'bottom',
        minDate:"09/22/2017",//added by me
        maxDate:"09/30/2017",//added by me
    });

$(document).on('click','#showvoucherlist',function(e){
 	     e.preventDefault();
        var purchasetype = $("#purchasetype").val();
        var account = $("#account").val();
        var fromdate = $("#fromdate").val();
        var todate = $("#todate").val();
       $("#fromdate,#todate").removeClass("glowing-border");
        
        if(fromdate==""){
             $("#fromdate").addClass("form_error");
             return false;
        }
         if(todate==""){
             $("#todate").addClass("form_error");
             return false;
        }
        else{
        	$('#voucherlistdata').html('');
         $("#loader").show();
          $("#details").css("display", "block"); 
             $.ajax({
            url: basepath + "voucherlist/showvoucherList",
            type: 'post',
            dataType:'html',
            data: {fromdate:fromdate,todate:todate,purchasetype:purchasetype,account:account},
             success: function(data) {
                $('#voucherlistdata').html(data);
             
            },
            complete: function(data) {
                $("#loader").hide();
                 
            },
            error: function(e) {
                //called when there is an error
                console.log(e.message);
            }
        });
     }
        
    });



 });