
    

    <tr id="rowItemdetails_<?php echo $rowno; ?>" class="itemDtlCls" >

    <td style="text-align: left;"> 
        
      <span id="serial_<?php echo $rowno; ?>"><?php echo $rowno;?></span>                  
    </td>

     <td style="text-align: left;width: 20%"> 
   

       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
             <div class="input-group input-group-sm"> 
                 
                  <select class="form-control select2 selcrdr" name="selcrdr[]" id="selcrdr_<?php echo $rowno; ?>">
                   
                              <option value="Dr" <?php if($tran_type=='Dr'){echo "selected";}?> >Dr</option>
                              <option value="Cr" <?php if($tran_type=='Cr'){echo "selected";}?>>Cr</option>
                  </select>


               </div>
         </div> 




    
     <span class="showdata3_<?php echo $rowno; ?>"><?php echo $tran_type;?></span>                    
    </td>
    
    <td style="text-align: left;width: 20%"> 
	  <input type="hidden" class="listaccountid" name="listaccountid[]" id="listaccountid_<?php echo $rowno; ?>" value="<?php echo $account_id;?>"> 

       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
             <div class="input-group input-group-sm"> 
                 
                  <select class="form-control select2" name="acdroplist[]" id="acdroplist_<?php echo $rowno; ?>">
                   
                     <?php 
                              foreach ($allaccountList as $allaccountlist) {
                              
                               ?>
                               <option value="<?php echo $allaccountlist->account_id;?>" 
                                <?php if($allaccountlist->account_id == $account_id){
                                    echo 'selected';
                                } ?>>
                               
                               <?php echo $allaccountlist->account_name;?></option>

                              <?php } ?>
                  </select>


               </div>
         </div> 




    
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $account_name;?></span>        		        
    </td>
  

     <td style="text-align: right;"> 
    <input type="hidden" class="listamount" name="listamount[]" id="listamount_<?php echo $rowno; ?>" value="<?php echo $amount;?>">    
     <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm"> 
                <input type="text" class="form-control listamounted editchilddtl_<?php echo $rowno; ?>" name="listamounted[]" id="listamounted_<?php echo $rowno; ?>" value="<?php echo $amount;?>"  onKeyUp="numericFilter(this);"> 
             </div>
         </div>
     
     <span class="showdata2_<?php echo $rowno; ?>"><?php echo $amount;?></span>                    
    </td>

  
         

						<td style="vertical-align: middle;text-align: center;">
							<?php 
                  if ($rowno!=0) {
                  
              ?> 
<a href="javascript:;" class="editchilddetails" id="editDocRow_<?php echo $rowno; ?>" title="edit"> <i class="far fa-edit" style="color: #d04949;; font-weight:700;"></i>
     </a>&emsp;

			<a href="javascript:;" class="delDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
      <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
            <?php } ?> 

        </a>
        
        
			</td>				
				
		
    </tr>
    
