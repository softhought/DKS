
    

    <tr id="rowItemdetailsbot_<?php echo $rowno; ?>" class="itemDtlCls" >
    
    <td style="text-align: left;width: 20%"> 
	  <input type="hidden" class="tennisitemcls" name="bottennisitemrow[]" id="bottennisitemrow_<?php echo $rowno; ?>" value="<?php echo $tennisitem->item_id;?>">   
     <?php echo $tennisitem->item_name;?>       		        
    </td>
 
     <td style="text-align: right;"> 
    <input type="hidden" name="botitemqtyrow[]" id="botitemqtyrow_<?php echo $rowno; ?>" value="<?php echo $itemqty;?>">   
     <?php echo $itemqty;?>                   
    </td>
     <input type="hidden" name="botitemmrp[]" id="botitemmrp_<?php echo $rowno; ?>" value="<?php echo $mrp_bot;?>"> 
    <td style="text-align: right;"> 
    <input type="hidden" name="botitemraterow[]" id="botitemraterow_<?php echo $rowno; ?>" value="<?php echo $itemrate;?>">   
     <?php echo $itemrate;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="botitemtaxablerow[]" id="botitemtaxablerow_<?php echo $rowno; ?>" value="<?php echo $itemtaxable;?>">   
     <?php echo $itemtaxable;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="botitem_cgst_raterow[]" id="botitem_cgst_raterow_<?php echo $rowno; ?>" value="<?php echo $cgstrateid;?>">   
     <?php echo $cgstrate;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="botitem_cgst_amtrow[]" id="botitem_cgst_amtrow_<?php echo $rowno; ?>" value="<?php echo $cgstamt;?>">   
     <?php echo $cgstamt;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="botitem_sgst_raterow[]" id="botitem_sgst_raterow_<?php echo $rowno; ?>" value="<?php echo $sgstrateid;?>">   
     <?php echo $cgstrate;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="botitem_sgst_amtrow[]" id="botitem_sgst_amtrow_<?php echo $rowno; ?>" value="<?php echo $sgstamt;?>">   
     <?php echo $sgstamt;?>                   
    </td>
    <td style="text-align: right;"> 
    <input class="botitemnetamtrow" type="hidden" name="botitem_netamtrow[]" id="botitem_netamtrow_<?php echo $rowno; ?>" value="<?php echo $item_netamt;?>">   
     <?php echo $item_netamt;?>                   
    </td>




                  
            </td> 

						<td style="vertical-align: middle;text-align: center;">
							<?php 
                  if ($rowno!=0) {
                  
              ?> 
			<a href="javascript:;" class="botdelItenDetails" id="botdelDocRow_<?php echo $rowno; ?>" title="Delete">
     
      <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
            <?php } ?> 

        </a>
        
        
			</td>				
				
		
    </tr>
    
