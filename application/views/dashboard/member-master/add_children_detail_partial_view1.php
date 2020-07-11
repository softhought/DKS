
    <tr id="rowchilddetails_<?php echo $rowno; ?>" class="childDtlCls" >
    
    <td style="text-align: left;width: 20%"> 
	  <input type="hidden"  name="child_name[]" id="child_name_<?php echo $rowno; ?>" value="<?php echo $children_name;?>">   
     <?php echo $children_name;?>       		        
    </td>
    <td style="text-align: left;"> 
    <input type="hidden" name="children_dob[]" id="children_dob_<?php echo $rowno; ?>" value="<?php echo $child_dob;?>">   
     <?php echo $child_dob;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="children_occup[]" id="children_occup_<?php echo $rowno; ?>" value="<?php echo $child_occupation;?>">   
     <?php echo $occup_name;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="children_gender[]" id="children_gender_<?php echo $rowno; ?>" value="<?php echo $children_gender;?>">   
     <?php echo $gendername;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="children_mobile[]" id="children_mobile_<?php echo $rowno; ?>" value="<?php echo $child_mobile;?>">   
     <?php echo $child_mobile;?>                   
    </td>
   
    
    <td style="vertical-align: left;">
							<?php 
                  if ($rowno!=0) {
                  
              ?> 
     <a href="javascript:;" class="editchilddetails" id="editDocRow_<?php echo $rowno; ?>" title="edit"> <i class="far fa-edit" style="color: #d04949;; font-weight:700;"></i>
     </a>&emsp;
           
	 <a href="javascript:;" class="delchildDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
           <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
            <?php } ?> 

    </a>
        
        
			</td>				
				
		
    </tr>
    
