
    

    <tr id="rowItemdetails_<?php echo $rowno; ?>" class="itemDtlCls" >
    
      <td style="text-align: left;"> 
        
      <span id="serial_<?php echo $rowno; ?>"><?php echo $rowno;?></span>                  
    </td>
    <td style="text-align: left;"> 
    <input type="hidden" class="rowrawmeteriacls" name="rowrawmeterial[]" id="rowrawmeterial_<?php echo $rowno; ?>" value="<?php echo $raw_meterial;?>">   
     <?php echo $raw_meterial_name;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="rowunit[]" id="rowunit_<?php echo $rowno; ?>" value="<?php echo $unit;?>">   
     <?php echo $unit;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="rowquantity[]" id="rowquantity_<?php echo $rowno; ?>" value="<?php echo $quantity;?>">   
     <?php echo $quantity;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="rowrate[]" id="rowrate_<?php echo $rowno; ?>" value="<?php echo $rate;?>">   
    <input type="hidden" name="rowtaxableamt[]" id="rowtaxableamt_<?php echo $rowno; ?>" value="<?php echo $taxable_amt;?>">   
     <?php echo $rate;?>                   
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
    <input class="itemnetamtrow" type="hidden" name="item_netamtrow[]" id="item_netamtrow_<?php echo $rowno; ?>" value="<?php echo $net_amt;?>">   
     <?php echo $net_amt;?>                   
    </td>




                  
          

						<td style="vertical-align: middle;text-align: center;">
							<?php 
                  if ($rowno!=0) {
                  
              ?> 
			<a href="javascript:;" class="delDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
      <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
            <?php } ?> 

        </a>
        
        
			</td>				
				
		
    </tr>
    
