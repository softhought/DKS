

       <div class="row selected-item" id="rowOrderDtl_<?php echo $rowno;?>">
                                    <div class="col-md-1 detail-row1 deletOrddtl" id="delDtlRow_<?php echo $rowno; ?>">
                                        <i class="fas fa-times delete"></i>
                                    </div>
                                    <div class="col-md-4 detail-row1">
                                          <?php echo $itemdetails->item_name; ?>
                                    </div>
                                    <div class="col-md-4 detail-row1">
                                        <div class="form-group">
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="mankotRow_<?php echo $rowno; ?>" name="manualkot[]" class="form-control bottom-border h25 manualkot" placeholder="Manual KOT" value="<?php if($lastmanualkot!=''){echo $lastmanualkot;}?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 detail-row1">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number qty-btn btn-minus"  data-type="minus" data-field="quant[1]" id="btnMinus_<?php echo $rowno; ?>">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity[]" class="form-control input-number h25 text-center no-border qty-input" value="1" readonly  id="itemQuantity_<?php echo $rowno; ?>">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number qty-btn btn-plus"  id="btnplus_<?php echo $rowno; ?>">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 detail-row2">
                                        Rate : <i class="fas fa-rupee-sign"></i>  
                                        <span id="showrowrate_<?php echo $rowno; ?>"><?php echo $itemdetails->item_rate; ?></span>
                                    </div>
                                    <div class="col-md-3 detail-row2">
                                       CGST : <span id="showrowcgstrate_<?php echo $rowno; ?>" ><?php echo $itemdetails->cgst_rate; ?></span>
                                    </div>
                                    <div class="col-md-3 detail-row2">
                                        SGST :<span id="showrowsgstrate_<?php echo $rowno; ?>"><?php echo $itemdetails->sgst_rate; ?></span> 
                                    </div>
                                    <div class="col-md-3 detail-row2">
                                    <?php 
                                    		$cgstamt=($itemdetails->item_rate*$itemdetails->cgst_rate)/100;
                                    		$sgstamt=($itemdetails->item_rate*$itemdetails->sgst_rate)/100;
                                    		$toalgst=($cgstamt+$sgstamt);
                                    		$totalamount=($itemdetails->item_rate+$toalgst);

                                    ?>

                                      <input class="orderitemid" type="hidden" name="oitemid[]" id="oitemid_<?php echo $rowno; ?>" value="<?php echo $itemid;?>">  
                                      <input type="hidden" name="ocgstid[]" id="ocgstid_<?php echo $rowno; ?>" value="<?php echo $itemdetails->cgst_id;?>">  
                                      <input type="hidden" name="ocgstrate[]" id="ocgstrate_<?php echo $rowno; ?>" value="<?php echo $itemdetails->cgst_rate;?>">  
                                      <input type="hidden" name="osgstid[]" id="osgstid_<?php echo $rowno; ?>" value="<?php echo $itemdetails->sgst_id;?>">  
                                      <input type="hidden" name="osgstrate[]" id="osgstrate_<?php echo $rowno; ?>" value="<?php echo $itemdetails->sgst_rate;?>">  

                                         <input type="hidden" name="itemrate[]" id="itemrate_<?php echo $rowno; ?>" value="<?php echo $itemdetails->item_rate;?>"> 
                                    
                                      <input type="hidden" name="rowamount[]" id="rowamount_<?php echo $rowno; ?>" value="<?php echo $itemdetails->item_rate;?>">  
                                      <input type="hidden" name="rowtotalcgst[]" id="rowtotalcgst_<?php echo $rowno; ?>" value="<?php echo $cgstamt;?>">  
                                      <input type="hidden" name="rowtotalsgst[]" id="rowtotalsgst_<?php echo $rowno; ?>" value="<?php echo $sgstamt;?>">  
                                      <input type="hidden" name="rowtotalamount[]" id="rowtotalamount_<?php echo $rowno; ?>" value="<?php echo $totalamount;?>">  



                                        Total : <i class="fas fa-rupee-sign"></i><span id="showrowtotal_<?php echo $rowno; ?>"> <?php echo $totalamount;?> </span>
                                    </div>
                                   
                                   <input type="hidden" name="isFree[]" id="isFree_<?php echo $rowno; ?>" value="N">

                                   <?php if ($item_category!='CAT') {
                                     ?>
                                   	<label for="freeCheck_<?php echo $rowno; ?>" id="freeChecklb">Free&nbsp;</label>
                                   <input type="checkbox" id="freeCheck_<?php echo $rowno; ?>"  class="freecheckbox">
                                     <?php } ?>





                                <div class="sl_div"  id="sldiv_<?php echo $rowno; ?>"></div>
                                </div>

                     


                             