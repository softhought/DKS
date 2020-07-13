$(document).ready(function(){



var basepath = $("#basepath").val()



$(".timeEntry").timeEntry({

	ampmPrefix: ' '

});



//anil

//form Submit



$(document).on('submit','#FixedhardtimeFrom',function(event)

    {

        event.preventDefault();

          $("#errormsg").text('');

          var mode = $("#mode").val();

        if(valiadateform())

        {   



            var formDataserialize = $("#FixedhardtimeFrom").serialize();

            formDataserialize = decodeURI(formDataserialize);

           

            var formData = { formDatas: formDataserialize };

                    

             $("#timesavebtn").css('display', 'none');

            $("#loaderbtn").css('display', 'inline-block');

        

               

        $.ajax({

                type: "POST",

                url: basepath+'Fixedhardcourttime/fixedhardtime_action',

                dataType: "json",

                contentType: "application/x-www-form-urlencoded; charset=UTF-8",

                data: formData,                

                success: function (result) {



                    

                    if (result.msg_status == 1) {



                    	if(mode == 'EDIT'){





                    	 $("#timesavebtn").css('display', 'inline-block');

                         $("#loaderbtn").css('display', 'none');

                         window.location.href=basepath+'Fixedhardcourttime';

                         //showMsg();



                    	}else{



                    	 $("#errormsg").removeClass('errormsgcolor');

                         $("#errormsg").text(result.msg_data).addClass('succmsg'); 

                         $("#timesavebtn").css('display', 'inline-block');

                         $("#loaderbtn").css('display', 'none');

                         $('#from_time').val('');                    

                         $('#to_time').val('');                    

                         $('#in_hour').val('');



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





// function calculate() {

// 	var time1 = $("#from_time").val().split(':'), time2 = $("#to_time").val().split(':');

    

//      var hours1 = parseInt(time1[0], 10), 

//          hours2 = parseInt(time2[0], 10),

//          mins1 = parseInt(time1[1], 10),

//          mins2 = parseInt(time2[1], 10);

//      var hours = hours2 - hours1, mins = 0;

//     $("#errormsg").text('');

//      // get hours

//      if(hours < 0) hours = 12 + hours;



//      // get minutes

//      if(mins2 >= mins1) {

//          mins = mins2 - mins1;

//      }

//      else {

//          mins = (mins2 + 60) - mins1;

//          hours--;

//      }



//      // convert to fraction of 60

//      mins = mins / 60;       

//      hours += mins;

     

//      hours = hours.toFixed(2);

//      $("#in_hour").val(hours);

   

//  }



function calculate() {



  $("#errormsg").text('');

  var time1 = $("#from_time").val().split(':'), time2 = $("#to_time").val().split(':');

   

     var hours1 = parseInt(time1[0], 10),

         hours2 = parseInt(time2[0], 10),

         mins1 = parseInt(time1[1], 10),

         mins2 = parseInt(time2[1], 10);

         mins = 0;



     if(time1   != '' && time2 != ''){



     

       timefor = {1:13,2:14,3:15,4:16,5:17,6:18,7:19,8:20,9:21,10:22,11:23,12:24};



    var clock1 = time1[1].split(' ');

    var clock2 = time2[1].split(' ');

    var clockname1 = clock1[1];

    var clockname2 = clock2[1];



    if(clockname1 == 'AM' && clockname2 == 'PM'){

           

           if(hours2 > hours1){



            var hours = hours2 - hours1;



           }else if(hours1 > hours2){



            

              var hours = timefor[hours2] - hours1;

           }

           else {

           

              var hours = timefor[hours2] - hours1;

         

           }



           

                     

         }else if(clockname1 == 'PM' && clockname2 == 'AM'){



          if(hours2 > hours1){



              var hours = hours2 - hours1;



           }else if(hours1 > hours2){



            var hours = (24 - timefor[hours1]) +  hours2;



           }

           else{



             var hours = timefor[hours1] - hours2;

           }



         

                   

         }else{



           if(clockname1 == 'AM' && clockname2 == 'AM'){



            if(hours2 > hours1){



            	if(hours2 == 12){



            		var hours =  (12 - hours1) + hours2;

            	}else{

            		var hours = hours2 - hours1;

            	}

           

            }else{



                var hours = (24 - hours1) + hours2;

            }



             



            }else if(clockname1 == 'PM' && clockname2 == 'PM'){





              if(hours2 > hours1){



               if(hours2 == 12){



            		var hours =  (12 - hours1) + hours2;

            	}else{

            		var hours = hours2 - hours1;

            	}



              }else if(hours1 > hours2){



                if(hours1 == 12){



                  var hours =  (12 - hours1) + hours2;

                }else{



                   var hours = (24 - hours1) + hours2;

                }

              	  

              }else{

                var hours = (24 - hours1) + hours2;

              }

                       



            }



         }



         

         if(mins2 >= mins1) {

        mins = mins2 - mins1;

    }

    else {

        mins = (mins2 + 60) - mins1;

        hours--;

    }



// convert to fraction of 60

     mins = mins / 60;      

     hours += mins;

     

     hours = hours.toFixed(2);

     $("#in_hour").val(hours);

   

     }



   

 }





 function valiadateform(){



 

  var from_time = $("#from_time").val();

  var to_time = $("#to_time").val();

  var dup_frm_date = $("#dup_frm_date").val();

  var dup_to_date = $("#dup_to_date").val();

  // alert(from_time);

  // alert(dup_frm_date);



  $("#errormsg").text('').removeClass('succmsg');

  

  if(from_time == ''){



    $("#errormsg").text('Enter From Time').addClass('errormsgcolor');

    $("#from_time").focus();

    return false;

  }else if(to_time == ''){



    $("#errormsg").text('Enter To Time').addClass('errormsgcolor');

    $("#to_time").focus();

    return false;

  }

  if(from_time != dup_frm_date && to_time != dup_to_date){



 if(checktimeduplicate(from_time,to_time)){



	  	 $("#errormsg").text('Time Already Exists').addClass('errormsgcolor');

	     $("#to_time").focus();

	     return false;



	  }



  }

  return true;



 }



 function checktimeduplicate(from_time,to_time){



  var basepath = $("#basepath").val(); 

  var txt = 0;



    $.ajax({



               type: "POST",

                url: basepath+'Fixedhardcourttime/checkduplicatetime',

                dataType: "json",

                data: {from_time:from_time,to_time:to_time}, 

                async:false,               

                success: function (result) {

                   

                    txt = result.msg_status;

                   

                   

                }, 

               

       

    })



     return txt;

 }