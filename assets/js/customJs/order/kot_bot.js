$(document).ready(function(){

var basepath = $("#basepath").val();
 $("#letterblock_0").addClass("active");

  var startDate = new Date($("#acstartDate").val());
  var endDate = new Date($("#acendDate").val());

  
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    startDate: startDate,
    endDate: endDate
    
});

  resetOrderItemSerial();

 var mode = $("#mode").val();

 if (mode=='ADD') {
    $("#blank_order_summery").show();
 }else{
     $("#blank_order_summery").hide();

 }


 var item_category=  $("#item_category").val();

 if (item_category=='CAT') {
    $(".freelebel").hide();
 }else{
   $(".freelebel").show();

 }



  var totalDetailsOrder=0;
    $(".manualkot").each(function(){
          totalDetailsOrder+=1;
    });

   $("#itemtotalcount").text(totalDetailsOrder); 



 var total_amt = $("#total_amt").val();
 $("#total_amount_value").html(total_amt);

/* Filter list */

 $("#srch-term").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".itemz .item-box ").filter(function() {

      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $(document).on('click', ".btn-minus", function(e) {
        e.preventDefault();
             // console.log($(this).val())
             var rowId = $(this).attr('id');
             var detailIdarr = rowId.split('_');
             var detailId = detailIdarr[1];
             var oitemid = $("#oitemid_"+detailId).val();
             
             action="Minus";
             console.log(action+":"+oitemid);

             if ( $("#isFree_"+detailId).val()=="Y") {
                  updateQuantityOnly(action,detailId)
             }else{
                  updateRowQuantity(action,detailId);
             }
           
             calculateTotalOrderAmount();



      
  });

 $(document).on('click', ".btn-plus", function(e) { 
            e.preventDefault();

            var rowId = $(this).attr('id');
            var detailIdarr = rowId.split('_');
            var detailId = detailIdarr[1];
            var oitemid = $("#oitemid_"+detailId).val();

            action="Plus";
             console.log(action+":"+oitemid);
             if ( $("#isFree_"+detailId).val()=="Y") {
                  updateQuantityOnly(action,detailId)
             }else{
                  updateRowQuantity(action,detailId);
             }
            calculateTotalOrderAmount();

      
  });


  $(document).on('change', ".freecheckbox", function(e) { 
            e.preventDefault();

            var rowId = $(this).attr('id');
            var detailIdarr = rowId.split('_');
            var detailId = detailIdarr[1];
            var oitemid = $("#oitemid_"+detailId).val();

            if($(this).prop("checked") == true){
                console.log("Checkbox is checked.");
                $("#isFree_"+detailId).val('Y');
                setItemCostfree(detailId);
            }
            else if($(this).prop("checked") == false){
                console.log("Checkbox is unchecked.");
                 $("#isFree_"+detailId).val('N');
                 resetItemCost(detailId);
            }

            calculateTotalOrderAmount();
  
  });





 $(".letter").on("click", function() {

 	
 	    var startletter = $.trim($(this).text());
 	    console.log(startletter);
 	    var blockId = $(this).attr('id');
        var detailIdarr = blockId.split('_');
        console.log(detailIdarr);
        var master_id = detailIdarr[1];
        var detail_id = detailIdarr[2];

        $(".letter").removeClass("active");
        $("#"+blockId).addClass("active");
        var item_category = $("#item_category").val();
        getItemListByStartLetter(item_category,startletter);
  
  });


var item_category = $("#item_category").val();
getItemListByCategory(item_category);







  $(document).on('change', "#item_category", function(e) {
        e.preventDefault();

        var item_category = $("#item_category").val();
        getItemListByCategory(item_category);
          $(".letter").removeClass("active");
        $("#letterblock_0").addClass("active");
        var loader ='<div id="blank_order_summery"><img src="'+basepath+'assets/img/bar_res_blur2.jpg"  width="400" height="500"><h3 class="order_sumh3">Order Details will appear here</h3></div>';
        $("#detail_orderitem").html(""); 
        $("#detail_orderitem").html(loader); 
        $("#sp_itemtotal,#sp_totalcgst,#sp_totalsgst,#sp_totaltobepaid").html("-");

        var totalDetails=0;
           $(".manualkot").each(function(){
                totalDetails+=1;
            });
          console.log("change"+ totalDetails);
     if (totalDetails==0) {
        $("#blank_order_summery").show();
     }else{
        $("#blank_order_summery").hide(); 
     }

    });

  // Add Visiting Day Details
    $(document).on('click','.addItem',function(e){
               e.preventDefault();
    	  // rowNoUpload++;

            var itemid = $(this).data('itemid');
            var kotflag=1
            var itemCount=0;
            var lastmanualkot="";

           $(".manualkot").each(function(){
               //var currRowID = $(this).attr('id');
               if (kotflag==1) {
                  lastmanualkot=$(this).val();
                  kotflag++;
               }
               itemCount=itemCount+1;   
            });

           

    
       if (1) {
          var rowno=  $("#rowno").val();
          var item_category=  $("#item_category").val();
        //console.log(rowno);
        $("#blank_order_summery").hide();
        rowno++;
        $.ajax({
            type: "POST",
            url: basepath+'order/addItemOrderDetail',
            dataType: "html",
            data: {rowNo:rowno,itemid:itemid,lastmanualkot:lastmanualkot,item_category:item_category},
            success: function (result) {
            	//console.log(result);
                 itemCount=itemCount+1;
                $("#rowno").val(rowno);
                $("#itemtotalcount").text(itemCount);
                $("#detail_orderitem ").css("display","block"); 
                $("#detail_orderitem ").prepend(result);    
             
                    calculateTotalOrderAmount();

                    resetOrderItemSerial();

  
         
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
        alert("already exist");
    }
  
    }); // End Visiting Details

            // Delete Table Row

    $(document).on('click','.deletOrddtl',function(){
    	
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
       // console.log(rowDtlNo[1]);
        console.log(currRowID);

        //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
        $("#rowOrderDtl_"+rowDtlNo[1]).remove();
         calculateTotalOrderAmount();

      var totalDetails=0;
           $(".manualkot").each(function(){
                totalDetails+=1;
            });
         // console.log("DLT"+totalDetails);
     if (totalDetails==0) {
        $("#blank_order_summery").show();
     }else{
        $("#blank_order_summery").hide(); 
     }

       $("#itemtotalcount").text(totalDetails);

       resetOrderItemSerial();

    });



$(document).on('change','#sel_member_code',function(){
   
  var selectedCode = $('#sel_member_code').find('option:selected');
  //$("#studentname").val(selectedCode.data('name'));
   $("#errormsg,#response_msg").html('');
  var memberName = selectedCode.data('titleone') +" " +selectedCode.data('name');
  $("#membername").val(memberName);
  console.log(memberName);
 

});



    $(document).on('submit','#barcatorderFrom',function(e){
        e.preventDefault();

        $("#errormsg,#response_msg").html('');
        var mode = $("#mode").val();
        if(validateBarCatOrderData())
        {
     
         
            var formDataserialize = $("#barcatorderFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'order/order_action';
            $("#odersavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-table');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
                    if (result.msg_status == 1) {

                        if (mode=="ADD") {
                          $('#barcatorderFrom').trigger("reset");
                          $('#sel_member_code').val(null).trigger("change")
                          $('#membername').val("");
                          $("#odersavebtn").show();
                          $("#loaderbtn").hide();
                          $("#response_msg").text(result.msg_data);

                            $("#orderaftersavemodel").modal({
                            "backdrop": "static",
                            "keyboard": true,
                            "show": true
                        });


                        }else{

                          $("#response_msg").text(result.msg_data);
                          $("#odersavebtn").show();
                          $("#loaderbtn").hide();

                        }
                    
                          
                         

                    } 
                    else {
                        $("#response_msg").text(result.msg_data);
                         $("#odersavebtn").show();
                          $("#loaderbtn").hide();
                    }
                    
                  //  $("#loaderbtn").css('display', 'none');
                    
                   
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });

        }

    });


$(document).on('input keyup','#order_dt',function(){

  var order_dt= $(this).val();
   
  console.log("order date :"+order_dt);
  
  $('#error_msg').text('');
  if (isDate(order_dt)) {
     console.log("order date is valid:");
   
     if(inputdatecheck(order_dt) == 0){   
        $('#error_msg').text('Enter Date Between Accounting Year');
      return false;
     }

  }else{
       $('#error_msg').text('Order date is not valid');
  }

 // isDate(txtDate)


});


$(document).on('click', ".previousorder", function(e) {
        e.preventDefault();

        var category_view = $("#category_view").val();
        getOrderHistory(category_view,'PREV');

});


$(document).on('click', ".nextorder", function(e) {
        e.preventDefault();

         var category_view = $("#category_view").val();
        getOrderHistory(category_view,'NEXT');

});


$(document).on('change', "#category_view", function(e) {
        e.preventDefault();

        var category_view = $("#category_view").val();
      getOrderHistoryByCategory(category_view)
         
    });


$(document).on('click','#close_btn_ordersave',function(){

     location.reload();
  

});



  $(document).on('click', "#ordershowbtn", function(e) {
        e.preventDefault();


     var from_dt = $("#from_dt").val();
     var to_date = $("#to_date").val();
     var sel_member = $("#sel_member").val();
   

  if(1){
           $('#order_list_data').html('');
         $("#loader").show();

   $.ajax({
                type: "POST",
                url: basepath+'order/getOrderListByDate',
                dataType: "html",
                data: {from_dt:from_dt,to_date:to_date,sel_member:sel_member},
                
                success: function (result) {
                   $("#loader").hide();
                     $("#order_list_data").html(result);
                     $(".dataTable").DataTable();
                   var total_amt = $("#total_amt").val();
                   $("#total_amount_value").html(total_amt);
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














}); // end of document ready


function getItemListByCategory(item_category){

	var basepath = $("#basepath").val();
    if (item_category=='CAT') {
    $("#items_title").text("Items - CANTEEN");
    }else{
         $("#items_title").text("Items - BAR");
    }

	        var formDataserialize = $("#developmentFrom").serialize();
            var urlpath = basepath + 'order/itemListview';
            $("#itemlist_details").html('');
              $("#loader").show();
            $.ajax({        
                type: "POST",
                url: urlpath,
                data:{item_category:item_category},
                dataType: "html",            
                success: function(result) {
                    $('#loader').hide();  
                    $("#itemlist_details").html(result);
  					 $("#loader").hide();
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


function getItemListByStartLetter(item_category,startletter){

	var basepath = $("#basepath").val();

	        var formDataserialize = $("#developmentFrom").serialize();
            var urlpath = basepath + 'order/itemListviewByStartLetter';
            $("#itemlist_details").html('');
             $("#loader").show();
            $.ajax({        
                type: "POST",
                url: urlpath,
                data:{item_category:item_category,startletter:startletter},
                dataType: "html",            
                success: function(result) {
                    $('#loader').hide();  
                    $("#itemlist_details").html(result);
  					 $("#loader").hide();
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


function calculateTotalOrderAmount(){
     var rowratesum=0;
     var rowcgstsum=0;
     var rowsgstsum=0;
     var rownetamtsum=0;

        $(".orderitemid").each(function(){
       
             var orderId = $(this).attr('id');
             var detailIdarr = orderId.split('_');
             var detailId = detailIdarr[1];
            
            
             rowratesum+= parseFloat($("#rowamount_"+detailId).val());
             rowcgstsum+= parseFloat($("#rowtotalcgst_"+detailId).val());
             rowsgstsum+= parseFloat($("#rowtotalsgst_"+detailId).val());
             rownetamtsum+= parseFloat($("#rowtotalamount_"+detailId).val()); 
    });


        $("#sp_itemtotal").html(rowratesum.toFixed(2));
        $("#sp_totalcgst").html(rowcgstsum.toFixed(2));
        $("#sp_totalsgst").html(rowsgstsum.toFixed(2));
        $("#sp_totaltobepaid").html(rownetamtsum.toFixed(2));

        $("#itemtotalsum").val(rowratesum.toFixed(2));
        $("#totalcgstsum").val(rowcgstsum.toFixed(2));
        $("#totalsgstsum").val(rowsgstsum.toFixed(2));
        $("#totaltobepaid").val(rownetamtsum.toFixed(2));




}



function ItemExistInTable(id) {
var flag=0;
console.log("IDD"+id)
    $('input[name="oitemid[]"]').each(function() {
        //alert($(this).val());
        console.log("id--:" + $(this).val());
        if ($(this).val() == id) {
           flag=1;
        }
    });
    if(flag==1){
       return false; 
    }
    else{
       return true; 
    }
    
}


function updateRowQuantity(action,detailId){

        // console.log("action"+action);
        // console.log("itemid"+itemid);
        

        /*    $('input[name="oitemid[]"]').each(function() {
                if ($(this).val() == itemid) {
                    rowId = $(this).attr('id');
                    detailIdarr = rowId.split('_');
                    detailId = detailIdarr[1];
                }
            }); */

        var itemQuantity = parseFloat($("#itemQuantity_"+detailId).val());
     
        if (action=='Minus') {
            if (itemQuantity!=1) {
                itemQuantity-=1;
            }

        }else{
             itemQuantity+=1;
        }

         console.log(itemQuantity);

         $("#itemQuantity_"+detailId).val(itemQuantity);
       
         var itemRate= parseFloat($("#itemrate_"+detailId).val());
         var ocgstrate= parseFloat($("#ocgstrate_"+detailId).val() || 0);
         var osgstrate= parseFloat($("#osgstrate_"+detailId).val() || 0);
         var taxable=parseFloat((itemRate*itemQuantity));
         var cgstamt=parseFloat((taxable*ocgstrate)/100);
         var sgstamt=parseFloat((taxable*osgstrate)/100);
         var netamt=(taxable+cgstamt+sgstamt);

        $("#rowamount_"+detailId).val(taxable.toFixed(2));
        $("#rowtotalcgst_"+detailId).val(cgstamt.toFixed(2));
        $("#rowtotalsgst_"+detailId).val(sgstamt.toFixed(2));
        $("#rowtotalamount_"+detailId).val(netamt.toFixed(2));
        $("#showrowtotal_"+detailId).html(netamt.toFixed(2));



}


function setItemCostfree(detailId){

   /*    $('input[name="oitemid[]"]').each(function() {
                if ($(this).val() == itemid) {
                    rowId = $(this).attr('id');
                    detailIdarr = rowId.split('_');
                    detailId = detailIdarr[1];
                }
         }); */

        $("#rowamount_"+detailId).val(0);
        $("#rowtotalcgst_"+detailId).val(0);
        $("#rowtotalsgst_"+detailId).val(0);
        $("#rowtotalamount_"+detailId).val(0);

        $("#showrowrate_"+detailId).html(0);
        $("#showrowcgstrate_"+detailId).html(0);
        $("#showrowsgstrate_"+detailId).html(0);
        $("#showrowtotal_"+detailId).html(0);


}


function resetItemCost(detailId){

           /* $('input[name="oitemid[]"]').each(function() {
                if ($(this).val() == itemid) {
                    rowId = $(this).attr('id');
                    detailIdarr = rowId.split('_');
                    detailId = detailIdarr[1];
                }
            }); */

        var itemQuantity = parseFloat($("#itemQuantity_"+detailId).val());
     
      
         console.log(itemQuantity);

         $("#itemQuantity_"+detailId).val(itemQuantity);
       
         var itemRate= parseFloat($("#itemrate_"+detailId).val());
         var ocgstrate= parseFloat($("#ocgstrate_"+detailId).val() || 0);
         var osgstrate= parseFloat($("#osgstrate_"+detailId).val() || 0);
         var taxable=parseFloat((itemRate*itemQuantity));
         var cgstamt=parseFloat((taxable*ocgstrate)/100);
         var sgstamt=parseFloat((taxable*osgstrate)/100);
         var netamt=(taxable+cgstamt+sgstamt);

        $("#rowamount_"+detailId).val(taxable.toFixed(2));
        $("#showrowrate_"+detailId).html(taxable.toFixed(2));
        $("#rowtotalcgst_"+detailId).val(cgstamt.toFixed(2));
        $("#showrowcgstrate_"+detailId).html(ocgstrate.toFixed(2)); 
        $("#rowtotalsgst_"+detailId).val(sgstamt.toFixed(2));
        $("#showrowsgstrate_"+detailId).html(osgstrate.toFixed(2));
        $("#rowtotalamount_"+detailId).val(netamt.toFixed(2));
        $("#showrowtotal_"+detailId).html(netamt.toFixed(2));


}

function updateQuantityOnly(action,detailId){

    var itemQuantity = parseFloat($("#itemQuantity_"+detailId).val());

        if (action=='Minus') {
            if (itemQuantity!=1) {
                itemQuantity-=1;
            }

        }else{
             itemQuantity+=1;
        }

        console.log(itemQuantity);

        $("#itemQuantity_"+detailId).val(itemQuantity);

}


function validateBarCatOrderData(){

 var order_dt =$("#order_dt").val();
 var sel_member_code =$("#sel_member_code").val();
 var sel_location =$("#sel_location").val();
console.log(sel_member_code);
var totalDetails=0;
  $("#order_dt,#sel_member_codeerr,#sel_location_codeerr").removeClass("form_error");

  $("#error_msg,#response_msg").text("");
       
        
    if (order_dt=='') {
       $("#order_dt").addClass("form_error");
        $("#order_dt").focus();
          return false;
     }

    if(inputdatecheck(order_dt) == 0){   
        $('#error_msg').text('Enter Date Between Accounting Year');
      return false;
     }

    if (sel_member_code=='') {
       $("#sel_member_codeerr").addClass("form_error");
        $("#sel_member_code").focus();
          return false;
     }

    if (sel_location=='') {
       $("#sel_location_codeerr").addClass("form_error");
       $("#sel_location").focus();
          return false;
     }

    $(".manualkot").each(function(){
        totalDetails+=1;
    });

     if (totalDetails==0) {
         $("#response_msg").text("Add order details");
          return false;
     }


    return true;

}

function getOrderHistory(view_category,type){

    var basepath = $("#basepath").val();
    var orderhistoryid = $("#orderhistoryid").val();

        $.ajax({
           type: "POST",
           url: basepath+'order/getOrderHistoryData',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: {view_category:view_category,type:type,orderhistoryid:orderhistoryid},
            success: function(data) { 
             
             if (data.status==1) {
 console.log(data);
                $("#orderhistoryid").val(data.orderdata.order_id);
                $("#orederpn_kotdt").val(data.orderdata.order_date);
                $("#orederpn_kotnumber").val(data.orderdata.order_no);
                $("#orederpn_member").val(data.orderdata.title_one+" "+data.orderdata.member_name);
                $("#orederpn_member_code").val(data.orderdata.member_code);
                $("#orederpn_price").val(data.orderdata.total_to_be_paid);

                $("a#hist_edit_link").attr('href', basepath+'order/addOrder/'+data.orderdata.order_id);
             
             }else{
               
             }
            
           
            },
            complete: function() {
                // $("#stock_loader").hide();

            },
            error: function(e) {
                //called when there is an error
               // console.log(e.message);
            }
        });
}

function getOrderHistoryByCategory(view_category){

    var basepath = $("#basepath").val();
    

        $.ajax({
           type: "POST",
           url: basepath+'order/getOrderHistoryDataByCategory',
           dataType: "json",
           contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: {view_category:view_category},
            success: function(data) { 
             
             if (data.status==1) {
             console.log(data.orderdata.total_to_be_paid);
                $("#orderhistoryid").val(data.orderdata.order_id);
                $("#orederpn_kotdt").val(data.orderdata.order_date);
                $("#orederpn_kotnumber").val(data.orderdata.order_no);
                $("#orederpn_member").val(data.orderdata.title_one+" "+data.orderdata.member_name);
                $("#orederpn_member_code").val(data.orderdata.member_code);
                $("#orederpn_price").val(data.orderdata.total_to_be_paid);
             
             }else{
               
             }
            
           
            },
            complete: function() {
                // $("#stock_loader").hide();

            },
            error: function(e) {
                //called when there is an error
               // console.log(e.message);
            }
        });
}



function resetOrderItemSerial(){
          var newsl=1;

           $($(".manualkot").get().reverse()).each(function(){
                var currRowID = $(this).attr('id');
                var rowDtlNo = currRowID.split('_');
                $("#sldiv_"+rowDtlNo[1]).text(newsl++);
               console.log("-> "+currRowID); 
            });

}





