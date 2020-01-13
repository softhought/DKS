$(document).ready(function(){

 


})

function inputdatecheck(datedata,basepath){

   var basepath = $("#basepath").val();
  var txt = '';
  
   if(datedata != ''){
  
    $.ajax({
                type: "POST",
                url: basepath+'dashboard/checkdateRange',
                dataType: "json",
                data: {datedata:datedata},
                async:false,
                success: function (result) {

                     txt =  result.msg_status;                     
                                       
                },
               
                
            }); /*end ajax call*/ 
          
      }
    return txt;
}