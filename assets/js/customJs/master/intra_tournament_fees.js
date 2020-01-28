$(document).ready(function(){

var basepath =$("#basepath").val();
$("#intraturnamentfeeApplybtn").hide();
$("#monthblock,#quarterblock").hide();

/* Inter Tournament List */
 $('#tournamentList').DataTable({
         
         
          
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
            this.api().columns([1,3]).every( function () {
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

 $('#tournamentList tfoot tr').insertAfter($('#tournamentList thead tr'))


   $('#billing_style').on('change',function(e){
        e.preventDefault();
        var billing_style =$("#billing_style").val();
        $("#monthblock,#quarterblock").hide();
      	if (billing_style=='M') {
      		$("#monthblock").show();
      	}else if (billing_style=='Q') {
      		$("#quarterblock").show();
      	}

 });


      $('#billing_style_copy').on('change',function(e){
        e.preventDefault();

        // var billing_style =$("#billing_style_copy").val();
        // console.log(billing_style);
        // $(".monthblockcopy,.quarterblockcopy").hide();
        // if (billing_style=='M') {
        //   $(".monthblockcopy").show();
        // }else if (billing_style=='Q') {
        //   $(".quarterblockcopy").show();
        // }

    });



    $('#intraturnamentbtn').on('click',function(e){
        e.preventDefault();

        var billing_style =$("#billing_style").val();
         $("#billing_styleerr").removeClass("form_error");
	    if (billing_style=='') {
		 	 $("#billing_styleerr").addClass("form_error");
	        return false;
		 }

            $("#response_msg").html("Processing please wait...");
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


        $(document).on('click', ".rowCheckAll", function() {     
       
        if($("#rowCheckAll").is(':checked')){
        console.log("checked");
        $('.rowCheck').prop('checked', true);
        $("#intraturnamentfeeApplybtn").show();
       
        }
        else{
        console.log("unchecked");
        $('.rowCheck').prop('checked',false);
        $("#intraturnamentfeeApplybtn").hide();
       
        }

 });

  $(document).on('click', ".rowCheck", function() {     
   
   var flag=0;    
       $(".rowCheck").each(function(){

       	if($(this).is(':checked')){
        console.log("checkedsingle");
       		flag=1;
        }

       });

       if (flag) { $("#intraturnamentfeeApplybtn").show();}else{ $("#intraturnamentfeeApplybtn").hide();}

 });



  
    $(document).on('click', "#intraturnamentfeeApplybtn", function(e) {

    	  e.preventDefault();
        
        var Id = $(this).attr('id');
        var detailIdarr = Id.split('_');
        var master_id = detailIdarr[1];
           $("#response_msg").html("");
       if (validateTournamentFees()) { 
            var formDataserialize = $("#interTournamentFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };

            console.log("formData");
         
     
           $("#intraturnamentfeeApplybtn").hide();
          
           $("#response_msg").html("Processing please wait...");
        $.ajax({
           type: "POST",
           url: basepath+'intratournament/IntraTournamentFeesAction',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: formData,
            success: function(data) { 
             
             if (data.msg_status==1) {
               $("#response_msg").html(data.msg_data);
               $("#student_list").html("");
               $('#interTournamentFrom').trigger("reset");
             }else{
               $("#response_msg").html(data.msg_data);
             }
            
           
            },
            complete: function() {
                // $("#stock_loader").hide();

            },
            error: function(e) {
                //called when there is an error
                console.log(e.message);
            }
        });

    }

      
    });









});// end of document ready


function validateTournamentFees(){

 var checkbox = $("input:checkbox:checked").length;
  var fees = $("#fees").val();
    var billing_style =$("#billing_style").val();

    console.log(billing_style);
  $("#errormsg").text("");
  $("#billing_styleerr,#montheerr,#quarter_montherr").removeClass("form_error");

    var billing_style =$("#billing_style").val();
       
     /* 	if (billing_style=='M') {
      		var month =$("#month").val();
      		 if (month=='') {
		 	   $("#montheerr").addClass("form_error");
	           return false;
		     }

      		
      	}else if (billing_style=='Q') {

      		var quarter_month =$("#quarter_month").val();
      		 if (quarter_month=='') {
		 	   $("#quarter_montherr").addClass("form_error");
	           return false;
		     }


      		
      	}*/


        
	    if (billing_style=='') {
		 	 $("#billing_styleerr").addClass("form_error");
	        return false;
		 }
   

    if(checkbox=="0")
    {
        $("#checkbox").focus().addClass("custom_err");
        $("#errormsg")
        .text("Error : Select Checkbox");
        return false;
    }

    if(fees=="")
    {
        $("#fees").focus().addClass("custom_err");
      
        return false;
    }




 
    return true;
}