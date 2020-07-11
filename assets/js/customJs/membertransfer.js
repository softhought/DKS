$(document).ready(function(){

var basepath = $("#basepath").val();
//var startDate = new Date($("#acstartDate").val());
var endDate = new Date($("#acendDate").val());

$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true,
    startDate: new Date(),
    endDate: endDate
    
});

$('.onlynumber').bind('keyup paste', function(){
    this.value = this.value.replace(/[^0-9]/g, '');

});

$('.numberwithdecimal').bind('keyup paste', function(){
    this.value = this.value.replace(/[^0-9\.]/g, '');

});

$('.onlyalpha').bind('keyup paste', function(){
    this.value = this.value.replace(/[^a-z\A-Z]/g, '');

});


$("#surname").keyup(function(){
      
    if($(this).val() == ''){
   
       $("#existing_code").val('').change();  
       $(".resetval").val('');    
       $("#existing_code").prop('disabled',true);
    }
})

//lastcode get

$(document).on('click','#viewlastcode',function(e){
    e.preventDefault();
    $('#errormsg').text('');
      
    if(validatecatsur())
    {
                 
        var memcattag = $("#member_cat_id").find(':selected').data('memcattag');  
        var surname = $("#surname").val();
      
        var type = "POST"; //for creating new resource
        var urlpath = basepath + 'membertransfer/getlastCode';
        
        $.ajax({
            type: type,
            url: urlpath,
            data: {memcattag:memcattag,surname:surname},
            dataType: 'json',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success: function(result) {
            
                $("#last_code").val(result.last_code);
                $("#change_code").val(result.new_code);

               $html = '<select class="form-control select2" id="existing_code" name="existing_code"  style="width: 100%;">';
               $html +='<option value = "">Select</option>' 

               $.each( result.alldtlusestartcode, function( key, value ) {

                $html+='<option value="'+value.member_id+'">'+value.member_code+'</option>'; 

              });               
               $html+='</select>';
               $('#memberexisting').html($html);

               $(".select2").select2();
               $("#existing_code").prop('disabled',false);
                
              
            },
            error: function(jqXHR, exception) {
                var msg = '';
            }
        });

    }

});

//member deatils if selected

$(document).on('click change','#existing_code',function(){

    var member_id = $(this).val();

    var type = "POST"; //for creating new resource
    var urlpath = basepath + 'membertransfer/getmemberdetails';
   // alert(member_id);

    if(member_id > 0){

    $.ajax({
        type: type,
        url: urlpath,
        data: {member_id:member_id},
        dataType: 'json',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        success: function(result) {
        
           //console.log(result.details.title_one);
           $('#member_name').val(result.details.title_one+' '+result.details.member_name);
           $('#address_one').val(result.details.address_one);
           $('#address_two').val(result.details.address_two);
           $('#address_three').val(result.details.address_three);
           $('#phone').val(result.details.phone);
           $('#mobile_no').val(result.details.mobile);
          
            
          
        },
        error: function(jqXHR, exception) {
            var msg = '';
        }
    });
}


});


//form submit

$(document).on('submit','#membertransferFrom',function(e){
    e.preventDefault();

  $("#errormsg").text('');
    
    if (validateform()) { 
      
        var formDataserialize = $("#membertransferFrom").serialize();
        formDataserialize = decodeURI(formDataserialize);
        console.log(formDataserialize);

        var formData = { formDatas: formDataserialize };
        var type = "POST"; //for creating new resource
        var urlpath = basepath + 'membertransfer/savemembertransfer';
        $("#transfersavebtn").css('display', 'none');
        $("#loaderbtn").css('display', 'inline-table');

        $.ajax({
            type: type,
            url: urlpath,
            data: formData,
            dataType: 'json',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success: function(result) {
                if (result.msg_status == 1) {

                    $("#loaderbtn").css('display', 'none');
                    $("#transfersavebtn").css('display', 'inline-table');
                    $("#errormsg").text(result.msg_data).addClass('succmsg');
                    $("#existing_code").val('').change();  
                    $(".resetval").val(''); 
                } 
              
            },
            error: function(jqXHR, exception) {
                var msg = '';
            }
        });
        
        
      
        
    }

});





})


function validatecatsur(){

    var memcattag = $("#member_cat_id").val();  
    var surname = $("#surname").val(); 
    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    $('#errormsg').text('');

    if(memcattag == ''){
        $("#errormsg").text('Error: Select Category');
        $("#member_cat_id").focus();
        return false;
    }else if(surname == ''){
        $("#errormsg").text('Error: Enter Surname');
        $("#surname").focus();
        return false;
    }
   return true; 

}

function validateform(){

    var member_id = $("#existing_code").val();
    var existing_code = $("#existing_code option:selected").text().split('-');
    var change_code = $("#change_code").val().split('-');    
    var subscription = $("#subscription").val();
    var social_sub = $("#social_sub").val();
    var from_date = $("#from_date").val();
   
    
    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    $('#errormsg').text('');

    if(member_id <= 0 ){
        $('#errormsg').text('Error: Select Existing Code');
        $("#existing_code").focus();
        return false;
    } else  if(existing_code[0] == change_code[0] ){

     $('#errormsg').text('Error: This Member Not Transfer In Same Category');
     $("#member_cat_id").focus();
     return false;
    }else  if(subscription == '' ){

        $('#errormsg').text('Error: Enter Subscription');
        $("#subscription").focus();
        return false;
    } else if(social_sub == ''){

        $('#errormsg').text('Error: Enter Social Subscription');
        $("#social_sub").focus();
        return false;
    }     

return true;

}