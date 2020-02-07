
    <tr id="rowsalarydetails_<?php echo $rowno; ?>" class="childDtlCls" >

      <input type="hidden" name="editbtncheck" id="editbtncheck_<?php echo $rowno; ?>" value="N">  
      <input type="hidden" name="employeedtlId[]" id="employeedtlId_<?php echo $rowno; ?>" value="0"> 
    
    <td style="text-align: left;width: 20%"> 
            <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                    <div class="input-group input-group-sm">                         
                        <select class="form-control select2 monthIds" name="dtl_month_id[]" id="dtl_month_id_<?php echo $rowno; ?>">
                              <option value=''>&nbsp; </option>
                                       
                                       <?php foreach($dtlmonthlist as  $monthlist){ ?>

                                           <option value="<?php echo $monthlist->id; ?>"
                                            
                                                <?php if($monthlist->id == $month_id){
                                                    echo 'selected';
                                                } ?>
                                                >
                                                <?php echo  $monthlist->short_name; ?>
                                            </option>
                                            <?php } ?>

                                               
                        </select>


                    </div>
                </div> 
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $month_name;?></span>       		        
    </td>
    <td style="text-align: right;width: 20%"> 
        <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm">
                     
               <input type="hidden" class="form-control decimalnumber editemployeedtl_<?php echo $rowno; ?>"   name="dtl_basic_sal[]" id="dtl_basic_sal_<?php echo $rowno; ?>" value="<?php echo $basic_salary; ?>">
            </div>
         </div>          
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $basic_salary;?></span>                   
    </td>
     
   
     <td style="text-align: right;width: 20%">
       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm"> 
                <input type="hidden" class="form-control decimalnumber editemployeedtl_<?php echo $rowno; ?>" name="dtl_salary_da[]" id="dtl_salary_da_<?php echo $rowno; ?>" value="<?php echo $salary_da;?>" > 
             </div>
         </div>         
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $salary_da;?> </span>                  
    </td>

    <td style="text-align: right;width: 20%">
       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm"> 
                <input type="hidden" class="form-control decimalnumber editemployeedtl_<?php echo $rowno; ?>" name="dtl_salary_hra[]" id="dtl_salary_hra_<?php echo $rowno; ?>" value="<?php echo $house_rent;?>" > 
             </div>
         </div>         
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $house_rent;?> </span>                  
    </td>
   
    
    <td style="vertical-align: left;">
							<?php 
                  if ($rowno!=0) {
                  
              ?> 
     <a href="javascript:;" class="editemployeedetails" id="editDocRow_<?php echo $rowno; ?>" title="edit"> <i class="far fa-edit" style="color: #d04949;; font-weight:700;"></i>
     </a>&emsp;
           
	 <a href="javascript:;" class="delemployeeDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
           <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
            <?php } ?> 

    </a>
        
        
			</td>				
				
		
    </tr>

<script>
$(document).ready(function(){

    $('.decimalnumber').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');

    });
})
</script>