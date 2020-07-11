$(document).ready(function(){



var basepath =$("#basepath").val();

$("#benvolentAmountApplybtn").hide();

$("#copy_div").hide();



$(document).on('click','#benvolentcopybtn',function(){



console.log($('#cpspan').html());







  $("#add_div").toggle();

  $("#copy_div").toggle();

  $("#response_msg,#errormsg").text('');

});





/* load copy data view on change */



$(document).on('change','#copy_from_month,#copycategory',function(){

    var copy_from_month =$("#copy_from_month").val();

    var copycategory =$("#copycategory").val();



  



   $("#member_list").html('');

    if (copy_from_month!="" && copycategory!="") {

        console.log("m "+copy_from_month);

    console.log("c "+copycategory);

          copyDataView();

    }else{

        /* need to reset list */

         $("#member_list").html('');

    }





});





/* benvolent Fund List*/

 

  

$ ('#benvolentfundList').DataTable({

             

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

            this.api().columns([1,3,4]).every( function () {

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



 $('#benvolentfundList tfoot tr').insertAfter($('#benvolentfundList thead tr'))









    $('#benvolentbtn').on('click',function(e){

        e.preventDefault();



        var category =$("#category").val();

         $("#categoryerr").removeClass("form_error");

	    if (category=='') {

		 	 $("#categoryerr").addClass("form_error");

	        return false;

		 }

		 	   $("#heads").val('0');

            $("#response_msg").html("Processing please wait...");

            $('#loader').show();

            $("#benvolentAmountApplybtn").hide();

            var formDataserialize = $("#benvolentFrom").serialize();

            var urlpath = basepath + 'benvolentfund/memberListview';

            $("#member_list").html('');

            $.ajax({        

                type: "POST",

                url: urlpath,

                data:formDataserialize,

                dataType: "html",            

                success: function(result) {

                    $('#loader').hide();  

                    $("#member_list").html(result);

                   //  $('.dataTable').DataTable();

                    $('.dataTable').DataTable( {

      				        "paging":   false,

      				        "ordering": false,

      				        "info":     false,
                       "drawCallback": function( settings ) {
                                  var flag=0;  
                                  var checkbox = $("input:checkbox.rowCheck:checked").length; 
                                  $("#heads").val(checkbox);
                                  $(".rowCheck").each(function(){
                                      if($(this).is(':checked')){
                                      console.log("checkedsingle");
                                        flag=1;
                                      }

                                     });

                                  if (flag) { $("#benvolentAmountApplybtn").show();}else{ $("#benvolentAmountApplybtn").hide();}
                    }

      				    } );

                    var totaldataenteredrow = $("#totaldataenteredrow").val();

                    $("#data_entered").html(totaldataenteredrow);



            



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

       var i=0;



     

        if($("#rowCheckAll").is(':checked')){

        console.log("checked");

        $('.rowCheck').prop('checked', true);

        $("#benvolentAmountApplybtn").show();



        }

        else{

        console.log("unchecked");

        $('.rowCheck').prop('checked',false);

        $("#benvolentAmountApplybtn").hide();

       

        }



        $(".rowCheck").each(function(){



        	console.log(i++)

          });

   var checkbox = $("input:checkbox.rowCheck:checked").length;  

   $("#heads").val(checkbox);



 }); 





   $(document).on('click', ".rowCheck", function() {     

   

   var flag=0;  

    var checkbox = $("input:checkbox.rowCheck:checked").length; 

   $("#heads").val(checkbox);

       $(".rowCheck").each(function(){



        if($(this).is(':checked')){

        console.log("checkedsingle");

          flag=1;

        }



       });



       if (flag) { $("#benvolentAmountApplybtn").show();}else{ $("#benvolentAmountApplybtn").hide();}



 });







     $(document).on('click', "#benvolentAmountApplybtn", function(e) {



    	  e.preventDefault();

        

        var Id = $(this).attr('id');

        var detailIdarr = Id.split('_');

        var master_id = detailIdarr[1];

           $("#response_msg").html("");

       if (validateBenvolentFees()) { 

            var formDataserialize = $("#benvolentFrom").serialize();

            formDataserialize = decodeURI(formDataserialize);

            console.log(formDataserialize);



            var formData = { formDatas: formDataserialize };



            console.log("formData");

         

     

           $("#benvolentAmountApplybtn").hide();

          

           $("#response_msg").html("Processing please wait...");

        $.ajax({

           type: "POST",

           url: basepath+'benvolentfund/benvolentFundAction',

           dataType: "json",

           contentType: "application/x-www-form-urlencoded; charset=UTF-8",

        data: formData,

            success: function(data) { 

             

             if (data.msg_status==1) {

               $("#response_msg").html(data.msg_data);

               $("#member_list").html("");

                 $('#sel_month,#category').val(null).trigger("change")

               $('#benvolentFrom').trigger("reset");

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







  /* insert copy month data */   





       $(document).on('click', "#benvolentCopybtn", function(e) {



        e.preventDefault();





        

     

           $("#response_msg").html("");

       if (validateBenvolentCopyData()) { 

            var formDataserialize = $("#benvolentFrom").serialize();

            formDataserialize = decodeURI(formDataserialize);

            console.log(formDataserialize);



            var formData = { formDatas: formDataserialize };



            console.log("formData");

         

     

          // $("#benvolentCopybtn").hide();

          

           $("#response_msg").html("Processing please wait...");

        $.ajax({

           type: "POST",

           url: basepath+'benvolentfund/benvolentFundCopyMonthAction',

           dataType: "json",

           contentType: "application/x-www-form-urlencoded; charset=UTF-8",

        data: formData,

            success: function(data) { 

              $("#benvolentCopybtn").show();

             if (data.msg_status==1) {

               $("#response_msg").html(data.msg_data);

               $("#member_list").html("");

                 $('#copy_from_month,#copycategory,#copy_to_month').val(null).trigger("change")

               $('#benvolentFrom').trigger("reset");

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





//added by anil on 28-01-2020



$("#total_amount_value").text($("#total_amt").val());



$(document).on("change",".searchdata",function(){



  var member_code = $("#member_code").val();

  var category = $("#category").val();

  var month_id = $("#month_id").val();



     

        $.ajax({

           type: "POST",

           url: basepath+'benvolentfund/benvolentFundpartiallist',

           dataType: "html",

           data: {member_code:member_code,category_id:category,month_id:month_id},

            success: function(data) { 

             

             $("#benvoalllist").html(data);

              $('.dataTable').DataTable();

              $("#total_amount_value").text($("#total_amt").val());



            },



          });

});


$(document).on('click', ".delBenFees", function(e) {
  e.preventDefault();

  //alert($(this).data("paymentid"));exit;

  var checkstr =  confirm('are you sure you want to delete this?');
    if(checkstr == true){
     //alert($(this).data("billid"));

     var monthid=$(this).data("monthid");
     var btranid=$(this).data("btranid");
     var rowid=$(this).data("rowid");
        $("#del_"+rowid).html('');
        $("#load_"+rowid).css("display", "block")
    
           $.ajax({
           type: "POST",
           url: basepath+'deletedata/deleteBenvolentFees',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
           data: {btranid:btranid},

            success: function(data) { 

             if (data.msg_status==1) {
              
                // location.reload(); 

                $("#amt_"+rowid).html('');
                



             }else{

                  alert(data.msg_data);

             }


            },

            complete: function() {

            },

            error: function(e) {
                //called when there is an error
                console.log(e.message);
            }

        });


    }else{
    return false;
    }


});





}); // end of document ready







function validateBenvolentFees(){

//return true;

 var checkbox = $("input:checkbox:checked").length;



 console.log("C"+checkbox);

  var amount = $("#amount").val();

  var sel_month =$("#sel_month").val();



    console.log(sel_month);

  $("#errormsg").text("");

  $("#billing_styleerr,#sel_montherr,#amounterr").removeClass("form_error");



    var sel_month =$("#sel_month").val();

       

        

	    if (sel_month=='') {

		 	 $("#sel_montherr").addClass("form_error");

	        return false;

		 }

   



    if(checkbox=="0")

    {

        $("#checkbox").focus().addClass("custom_err");

        $("#errormsg")

        .text("Error : Select Checkbox");

        return false;

    }



    if(amount=="")

    {

        $("#amount").focus();

        $("#amounterr").addClass("custom_err");

        $("#errormsg").text("Enter Amount");

      

        return false;

    }









 

    return true;

}





function copyDataView(){



  var basepath =$("#basepath").val();



   

console.log("copyDataView")

  $("#response_msg,#errormsg").text('');



         $("#heads").val('0');

            $("#response_msg").html("Loading please wait...");

            $('#loader').show();

            $("#benvolentAmountApplybtn").hide();

            var formDataserialize = $("#benvolentFrom").serialize();

            var urlpath = basepath + 'benvolentfund/memberListviewforCopy';

            $("#member_list").html('');

            $.ajax({        

                type: "POST",

                url: urlpath,

                data:formDataserialize,

                dataType: "html",            

                success: function(result) {

                    $('#loader').hide();  

                    $("#member_list").html(result);

                   //  $('.dataTable').DataTable();

                    $('.dataTable').DataTable( {

                "paging":   false,

                "ordering": false,

                "info":     false

            } );



        



             

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



}







function validateBenvolentCopyData(){

//return true;



          var copy_from_month =$("#copy_from_month").val();

          var copycategory =$("#copycategory").val();

          var copy_to_month =$("#copy_to_month").val();



  $("#copy_from_montherr,#copycategoryerr,#copy_to_montherr").removeClass("form_error");



  $("#errormsg").text("");

       

        

    if (copy_from_month=='') {

       $("#copy_from_montherr").addClass("form_error");

          return false;

     }



    if (copycategory=='') {

       $("#copycategoryerr").addClass("form_error");

          return false;

     }



    if (copy_to_month=='') {

       $("#copy_to_montherr").addClass("form_error");

          return false;

     }



      if (copy_from_month==copy_to_month) {

       $("#copy_from_montherr").addClass("form_error");

       $("#copy_to_montherr").addClass("form_error");

       $("#errormsg").text("Error : Copy from month to month same");

          return false;

     }

   

   











 

    return true;

}