$(document).ready(function(){

 var basepath = $("#basepath").val();

$('.numberwithdecimal').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9\.]/g, '');

  });

$('#studtennisopening').DataTable({
         
        
          
          "orderCellsTop": true ,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search..."
        },
        'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1,-2] /* 1st one, start by the right */
            }],
        initComplete: function () {
            this.api().columns([1,4]).every( function () {
                var column = this;
                var select = $('<select class="form_input_text select2"><option value="">Show all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }



    } );

 $('#studtennisopening tfoot tr').insertAfter($('#studtennisopening thead tr'))




 $(document).on('change','.showblllsty',function(){

 var value = $(this).val();
 
  if(value == 'M'){
  
    $(".bill_styquater").css('display','none');
  	$("#billstyle").css('display','block');
  	$(".billstymonth").css('display','block');
  	$("#openingballist").html('');
  	$("#quter_id").val('').change();


  }else{
  	
    $(".billstymonth").css('display','none');
  	$("#billstyle").css('display','block');
  	$(".bill_styquater").css('display','block');
  	$("#month_id").val('').change();
  	$("#openingballist").html('');
  	
  }
 

 })



 $(document).on('click','#showopeninglist',function(){

 	var billstyle = $("input[name='billing_style']:checked").val();

    var month =  $("#month_id").val();
    var quater = $("#quter_id").val();

    if(validatedata()){
        $("#openingballist").html('');
    	$("#listloader").css('display','block');

            
        $.ajax({
                type: "POST",
                url: basepath+'tennisopening/tennisopeninglist',
                dataType: "html",
                data: {billstyle:billstyle,month_id:month,quter_id:quater},
                
                success: function (result) {
                    $("#listloader").css('display','none');
                    $("#openingballist").html(result);
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



 $(document).on('click','.formsubmitbtn',function(event)
    {
        event.preventDefault();
       
       var value = $(this).attr('id');
       var slno = value.split('_');
       var billstyle = $("input[name='billing_style']:checked").val();
	   var month_id =  $("#month_id").val();
       var quter_id = $("#quter_id").val();
      
      
       var admission_id =  $('#admission_id_'+slno[1]).val();
       var studcode = $('#studcode_'+slno[1]).val();
       var bill_style =  $('#bill_style_'+slno[1]).val();
       var opening_id = $('#opening_id_'+slno[1]).val();
       var opening_bal = $('#opening_bal_'+slno[1]).val();

    if(validatedata()){
                                  
            $("#"+value).css('display', 'none');
            $("#loaderbtn_"+slno[1]).css('display', 'block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'tennisopening/tennisopeningbalance_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: {bill_style:bill_style,month_id:month_id,quter_id:quter_id,admission_id:admission_id,studcode:studcode,opening_id:opening_id,opening_bal:opening_bal},                
                success: function (result) {

                    
                    if (result.msg_status == 1) {

                         $("#"+value).text('Updated');
                    	 $("#"+value).css('display', 'block');
                         $("#loaderbtn_"+slno[1]).css('display', 'none');
                         $("#opening_id_"+slno[1]).val(result.insertId);
                       
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


})


function validatedata(){

   var billstyle = $("input[name='billing_style']:checked").val();
	var month =  $("#month_id").val();
    var quater = $("#quter_id").val();

    $("#montherr,#qutererr").text('');

    if(billstyle == 'M'){

    	if(month == ''){

          $("#montherr").text('Select Month');
          $("#month_id").focus();
          return false;

    	}
    }else{

    	if(quater == ''){

    		$("#qutererr").text('Select Quarterly Month');
             $("#quter_id").focus();
              return false;

    	}

    }

return true;
}

