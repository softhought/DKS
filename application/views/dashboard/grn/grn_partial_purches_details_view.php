
                  <?php 
                    if ($purchaseDetailsData) {
                    $sl=1;$rowno=1;
                    foreach ($purchaseDetailsData as $purchasedtl) {
                         
                  ?>

    <tr id="rowItemdetails_<?php echo $rowno; ?>" class="itemDtlCls" >
    
    <td style="text-align: left;">  
    <span id="serial_<?php echo $rowno; ?>"><?php echo $sl++;?></span>                  
    </td>
    <td style="text-align: left;"> 
    <input type="hidden" class="rowrawmeteriacls" name="rowrawmeterial[]" id="rowrawmeterial_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['raw_material_id'];?>">   
     <?php echo $purchasedtl['raw_material'];?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="rowunit[]" id="rowunit_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['item_unit_name'];?>">   
     <?php echo $purchasedtl['item_unit_name'];?>                   
    </td>
    <td style="text-align: right;"> 
    
     <?php echo $purchasedtl['item_quantity'];?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="text" class="rowquantitycls" name="rowquantity[]" id="rowquantity_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['remaining_quantity'];?>" onKeyUp="numericFilter(this);" > 
    <input type="hidden" name="rowquantityorg[]" id="rowquantityorg_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['remaining_quantity'];?>">  

    <input type="hidden" name="rowpurchasedtlid[]" id="rowpurchasedtlid_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['purchase_dtl_id']?>">  
     <?php //echo $purchasedtl->item_quantity;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="rowrate[]" id="rowrate_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['item_rate'];?>">   
   <!--  <input type="hidden" name="rowtaxableamt[]" id="rowtaxableamt_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['taxable_amt'];?>">    -->
     <?php echo $purchasedtl['item_rate'];?>                   
    </td>


    <td style="vertical-align: middle;text-align: center;">
            
      <a href="javascript:;" class="delDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
      <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
  </a>
      </td>       
    </tr>

   <?php $rowno++;
                 }
             }
  ?>
