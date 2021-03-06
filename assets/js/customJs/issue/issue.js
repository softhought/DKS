$(document).ready(function() {

 var basepath = $('#basepath').val();

 $(document).on('change','#rawmeterial_id',function(){
   
  var selectedCode = $('#rawmeterial_id').find('option:selected');
  $("#unit_name").val(selectedCode.data('rawunit'));


 });



  $(document).on('click','.addRawmet',function(e){
           e.preventDefault();

          var rowno= $("#rowno").val(); 
          var quantity_sent=$("#quantity_sent").val();
          var rawmeterial_id=$("#rawmeterial_id").val();
          var rawmeterialname = $("#rawmeterial_id option:selected").text();
          var unit_name= $("#unit_name").val();
         
        

        console.log(basepath);
        if(validateDetails()) {

        rowno++;
        $.ajax({
            type: "POST",
            url: basepath+'issue/addDetails',
            dataType: "html",
            data: {
            		rowNo:rowno,
            		quantity_sent:quantity_sent,
            		rawmeterial_id:rawmeterial_id,
            		rawmeterialname:rawmeterialname,
            		unit_name:unit_name,
            
	            },
            success: function (result) {
                $("#rowno").val(rowno);
                $("#detail_itemamt table").show(); 
                $("#detail_itemamt table tbody").append(result);   
               
                $('#unit_name,#quantity_sent').val('');
                $('#rawmeterial_id').val('').change();

                   resetSerial();
           
         
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

        }else{
            $("#selmens_medicine").focus();
            $("#selmens_medicineerr").addClass("bordererror");
           
        }
  
    }); 




   $(document).on('click','.delDetails',function(){
        
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
       // console.log(rowDtlNo[1]);
        console.log(currRowID);

        //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
        $("tr#rowItemdetails_"+rowDtlNo[1]).remove();
      
         resetSerial();
    });



$(document).on('submit','#issueEntryFrom',function(event)
    {
        event.preventDefault();

          $("#errormsg").text('');
          var mode = $("#mode").val();

        if(validateMasterData())
        {     $('#entry_mode').attr("disabled", false); 

            var formDataserialize = $("#issueEntryFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#patrecsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'issue/issue_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    if (result.msg_status == 1) {
                       $("#loaderbtn").css('display', 'none');

                   			 window.location.replace(basepath+'issue');
                 
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



  $(document).on('click', "#issueshowbtn", function(e) {
        e.preventDefault();


     var from_dt = $("#from_dt").val();
     var to_date = $("#to_date").val();
  
     

  if(1){
           $('#grn_list_data').html('');
           $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'issue/getIssuerEntryByDate',
                dataType: "html",
                data: {from_dt:from_dt,to_date:to_date},
                
                success: function (result) {
                     $("#loader").hide();
                     $("#grn_list_data").html(result);
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







		
}); // end of class


function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}


function validateDetails(){

    
     var rawmeterial_id=$("#rawmeterial_id").val();
     var unit_name= $("#unit_name").val();
     var quantity_sent= $("#quantity_sent").val();
        

   	 $("#rawmeterial_iderr,#quantity_sent").removeClass("form_error");
	 $('#error_msg').text('');

	 if (rawmeterial_id=='') {
	 	 $("#rawmeterial_iderr").addClass("form_error");
         $("#rawmeterial_iderr").focus();
         return false;
	 }

	 if (quantity_sent=='') {
	 	 $("#quantity_sent").addClass("form_error");
         $("#quantity_sent").focus();
         return false;
	 }



	return true;
}



function resetSerial(){
    var n=1;

  $(".rawmetcls").each(function(){
      var currRowID = $(this).attr('id');
      var rowDtlNo = currRowID.split('_');
        console.log("-> "+n); 
      $("#serial_"+rowDtlNo[1]).text(n++);
    
   });

}



function validateMasterData(){

     var issue_dt=$("#issue_dt").val();
     var department_id=$("#department_id").val();


   	 $("#issue_dt,department_iderr").removeClass("form_error");
	 $('#error_msg').text('');
	 $('#errormsg').text('');

	 if (issue_dt=='') {
	 	 $("#issue_dt").addClass("form_error");
       
         return false;
	 }

	 if(inputdatecheck(issue_dt) == 0){   
        $('#errormsg').text('Enter Date Between Accounting Year');
      return false;
     }

     if (department_id=='') {
	 	 $("#department_iderr").addClass("form_error");
         return false;
	 }






var list=0;

   $(".rawmetcls").each(function(){
   
        list = list + 1;
    });


    if(list==0){

       $('#errormsg').text('Add raw meterial list');
         return false;

   }



	return true;
}
