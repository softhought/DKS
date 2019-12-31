
    

    <tr id="rowItemdetails_<?php echo $rowno; ?>" class="itemDtlCls" >
    
    <td style="text-align: left;width: 20%"> 
	  <input type="hidden" class="tennisitemcls" name="tennisitemrow[]" id="tennisitemrow_<?php echo $rowno; ?>" value="<?php echo $tennisitem->item_id;?>">   
     <?php echo $tennisitem->item_name;?>       		        
    </td>
    <td style="text-align: left;"> 
    <input type="hidden" name="hsncoderow[]" id="hsncoderow_<?php echo $rowno; ?>" value="<?php echo $hsncode;?>">   
     <?php echo $hsncode;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="itemqtyrow[]" id="itemqtyrow_<?php echo $rowno; ?>" value="<?php echo $itemqty;?>">   
     <?php echo $itemqty;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="itemraterow[]" id="itemraterow_<?php echo $rowno; ?>" value="<?php echo $itemrate;?>">   
     <?php echo $itemrate;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="itemtaxablerow[]" id="itemtaxablerow_<?php echo $rowno; ?>" value="<?php echo $itemtaxable;?>">   
     <?php echo $itemtaxable;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_cgst_raterow[]" id="item_cgst_raterow_<?php echo $rowno; ?>" value="<?php echo $cgstrateid;?>">   
     <?php echo $cgstrate;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_cgst_amtrow[]" id="item_cgst_amtrow_<?php echo $rowno; ?>" value="<?php echo $cgstamt;?>">   
     <?php echo $cgstamt;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_sgst_raterow[]" id="item_sgst_raterow_<?php echo $rowno; ?>" value="<?php echo $sgstrateid;?>">   
     <?php echo $cgstrate;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_sgst_amtrow[]" id="item_sgst_amtrow_<?php echo $rowno; ?>" value="<?php echo $sgstamt;?>">   
     <?php echo $sgstamt;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_netamtrow[]" id="item_netamtrow_<?php echo $rowno; ?>" value="<?php echo $item_netamt;?>">   
     <?php echo $item_netamt;?>                   
    </td>




                  
            </td> 

						<td style="vertical-align: middle;text-align: center;">
							<?php 
                  if ($rowno!=0) {
                  
              ?> 
			<a href="javascript:;" class="delItenDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
      <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
            <?php } ?> 

        </a>
        
        
			</td>				
				
		
    </tr>
    
