
    <tr id="rowchilddetails_<?php echo $rowno; ?>" class="childDtlCls" >

      <input type="hidden" name="editbtncheck" id="editbtncheck_<?php echo $rowno; ?>" value="N">  
      <input type="hidden" name="childdtlId[]" id="childdtlId_<?php echo $rowno; ?>" value="0"> 
    
    <td style="text-align: left;width: 20%"> 
       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm">   
	             <input type="hidden" class="form-control editchilddtl_<?php echo $rowno; ?>"  name="child_name[]" id="child_name_<?php echo $rowno; ?>" value="<?php echo $children_name;?>">  
             </div>
        </div> 
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $children_name;?></span>       		        
    </td>
    <td style="text-align: left;width: 20%"> 
        <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>     
               <input type="hidden" class="form-control datemask editchilddtl_<?php echo $rowno; ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask=""  name="children_dob[]" id="children_dob_<?php echo $rowno; ?>" value="<?php echo $child_dob; ?>">
            </div>
         </div>          
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $child_dob;?></span>                   
    </td>
     <td style="text-align: left;width: 20%"> 

          <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
             <div class="input-group input-group-sm"> 
                 
                  <select class="form-control select2" name="children_occup[]" id="children_occup_<?php echo $rowno; ?>">
                    <option value=''>&nbsp; </option>
                      <?php foreach ($occuptionlist as $occuptionlist) { ?>
                               <option value="<?php echo $occuptionlist->id; ?>" 
                                
                                <?php if($occuptionlist->id == $child_occupation){
                                    echo 'selected';
                                } ?>

                                >
                                    <?php echo $occuptionlist->occupation_name; ?>
                                </option>
                       <?php   } ?>
                  </select>


               </div>
         </div>          

  <!--   <input type="hidden" name="children_occup[]" id="children_occup_<?php echo $rowno; ?>" value="<?php echo $child_occupation;?>">  -->  
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $occup_name;?></span>                   
    </td>
    <td style="text-align: left;width: 20%"> 

        <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
             <div class="input-group input-group-sm"> 
                 
                  <select class="form-control select2" name="children_gender[]" id="children_gender_<?php echo $rowno; ?>">
                   <option value=''>&nbsp; </option>
                                  <?php $genderlist = json_decode (GENDER_LIST);

                                  foreach ($genderlist as $key => $genderlist) { ?>
                                   <option value="<?php echo $key; ?>"
                                    <?php if($key == $children_gender){
                                         echo 'selected';
                                      } ?>
                                     >
                                          <?php echo  $genderlist; ?>
                                    </option>
                                        <?php   } ?>
                  </select>


               </div>
         </div>
    <!-- <input type="hidden" name="children_gender[]" id="children_gender_<?php echo $rowno; ?>" value="<?php echo $children_gender;?>"> -->   
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $gendername;?></span>                  
    </td>
     <td style="text-align: left;width: 20%">
       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm"> 
                <input type="hidden" class="form-control editchilddtl_<?php echo $rowno; ?>" name="children_mobile[]" id="children_mobile_<?php echo $rowno; ?>" value="<?php echo $child_mobile;?>" maxlength=10 onKeyUp="numericFilter(this);"> 
             </div>
         </div>         
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $child_mobile;?> </span>                  
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
    
<script type="text/javascript">
    $(document).ready(function(){

        $('.select2').select2()
        //$('.datemask').datepicker();

        $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    })
</script>