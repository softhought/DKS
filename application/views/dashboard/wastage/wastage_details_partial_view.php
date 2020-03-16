
    

    <tr id="rowItemdetails_<?php echo $rowno; ?>" class="itemDtlCls" >

    <td style="text-align: left;"> 
        
      <span id="serial_<?php echo $rowno; ?>"><?php echo $rowno;?></span>                  
    </td>

     <td style="text-align: left;"> 
    <input type="hidden" class="rawmetcls" name="rawmeterialid[]" id="rawmeterialid_<?php echo $rowno; ?>" value="<?php echo $rawmeterial_id;?>">    

           <?php echo $rawmeterialname;?>              
    </td>

  

     <td style="text-align: left;"> 
    <input type="hidden"  name="rowunit[]" id="rowunit_<?php echo $rowno; ?>" value="<?php echo $unit_name;?>">    

    <?php echo $unit_name;?>                 
    </td>

    <td style="text-align: left;"> 
    <input type="hidden"  name="rowwastage[]" id="rowwastaget_<?php echo $rowno; ?>" value="<?php echo $wastage;?>">    

   <?php echo $wastage;?>                   
    </td>

     <td style="text-align: left;"> 
    <input type="hidden"  name="rowremarks[]" id="rowremarks_<?php echo $rowno; ?>" value="<?php echo $remarks;?>">    

   <?php echo $remarks;?>                   
    </td>


  
         

						<td style="vertical-align: middle;text-align: center;">
					


			<a href="javascript:;" class="delDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
      <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
            

        </a>
        
        
			</td>				
				
		
    </tr>
    
