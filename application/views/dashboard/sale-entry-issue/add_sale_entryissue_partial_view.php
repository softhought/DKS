
    <tr id="rowpurchasedetails_<?php echo $rowno; ?>" class="childDtlCls" >

      <input type="hidden" name="editbtncheck" id="editbtncheck_<?php echo $rowno; ?>" value="N">  
      <input type="hidden" name="saleeentryissueId[]" id="saleeentryissueId_<?php echo $rowno; ?>" value="0"> 
      <input type="hidden" name="stockinhand[]" id="stockinhand_<?php echo $rowno; ?>" value="<?php echo $stock_in_hand; ?>"> 
      <input type="hidden" name="itemunit[]" id="itemunit_<?php echo $rowno; ?>" value="<?php echo $unit_id; ?>"> 
      <td style="text-align: left;width: 5%"><?php echo $rowno; ?>
         
      </td>
    <td style="text-align: left;width: 20%"> 
            <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                    <div class="input-group input-group-sm">                         
                        <select class="form-control select2 itemcls" name="childitem_name[]" id="childitem_name_<?php echo $rowno; ?>" data-rownum = "<?php echo $rowno; ?>">
                            <option value=''>&nbsp; </option>
                            <?php foreach ($itemmasterlist as $itemmasterlist) { ?>
                                    <option value="<?php echo $itemmasterlist->id; ?>" data-unitname = "<?php echo $itemmasterlist->unit; ?>" data-liquer = "<?php echo $itemmasterlist->lequer_vol; ?>" data-unitid = "<?php echo $itemmasterlist->bar_unit_id; ?>" data-liquerid="<?php echo $itemmasterlist->liquer_vol_id; ?>" 
                                        
                                        <?php if($itemmasterlist->id == $item_id){
                                            echo 'selected';
                                        } ?>

                                        >
                                            <?php echo $itemmasterlist->item_name; ?>
                                        </option>
                            <?php   } ?>
                        </select>


                    </div>
                </div> 
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $item_name;?></span>       		        
    </td>
    <td style="text-align: left;width: 20%"> 
                <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                                <div class="input-group input-group-sm"> 

                                <input type="hidden" class="form-control "  name="childliquer_vol_id[]" id="childliquer_vol_id_<?php echo $rowno; ?>" im-insert="false" value="<?php echo $liquer_vol_id;?>" readonly />
                                <input type="hidden" class="form-control editchilddtl_<?php echo $rowno; ?> "  name="childliquer_vol_name[]" id="childliquer_vol_name_<?php echo $rowno; ?>"  im-insert="false" value="<?php echo $liquername;?>" readonly />                                                                 
                                    
                                    <!-- <select class="form-control select2 calconml" name="childliquer_vol_id[]" id="childliquer_vol_id_<?php echo $rowno; ?>" data-rownum = "<?php echo $rowno; ?>">
                                        <option value=''>&nbsp; </option>
                                        <?php foreach ($liquervollist as $liquervollist) { ?>
                                                <option value="<?php echo $liquervollist->id; ?>" 
                                                    
                                                    <?php if($liquervollist->id == $liquer_vol_id){
                                                        echo 'selected';
                                                    } ?>

                                                    >
                                                        <?php echo $liquervollist->lequer_vol; ?>
                                                    </option>
                                        <?php   } ?>
                                    </select> -->


                                </div>
                            </div>          
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $liquername;?></span>                   
    </td>
    <td style="text-align: left;width: 20%"> 
                <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                                <div class="input-group input-group-sm"> 
                                 
                                    <select class="form-control select2 calconml" name="childlocation_id[]" id="childlocation_id_<?php echo $rowno; ?>" data-rownum = "<?php echo $rowno; ?>">
                                        <option value=''>&nbsp; </option>
                                        <?php foreach ($locationlist as $locationlist) { ?>
                                                <option value="<?php echo $locationlist->location_id; ?>" 
                                                    
                                                    <?php if($locationlist->location_id == $location_id){
                                                        echo 'selected'; $locationname = $locationlist->location;
                                                    } ?>

                                                    >
                                                        <?php echo $locationlist->location; ?>
                                                    </option>
                                        <?php   } ?>
                                    </select>


                                </div>
                            </div>          
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $locationname;?></span>                   
    </td>
    
    
     <td style="text-align: left;width: 20%">
       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm"> 
                <input type="hidden" class="form-control calconml onlynumber editchilddtl_<?php echo $rowno; ?>" name="childquantity[]" id="childquantity_<?php echo $rowno; ?>" data-rownum = "<?php echo $rowno; ?>" value="<?php echo $quantity;?>"> 
             </div>
         </div>         
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $quantity;?> </span>                  
    </td>
    
    
    <td style="text-align: left;width: 20%">
       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm"> 
                <input type="hidden" class="form-control editchilddtl_<?php echo $rowno; ?>" name="childconve[]" id="childconve_<?php echo $rowno; ?>" value="<?php echo ($liquername * $quantity)/1000;?>" readonly> 
             </div>
         </div>         
     <span class="showdata_<?php echo $rowno; ?>"><?php echo ($liquername * $quantity)/1000;?> </span>                  
    </td>
   
    
    <td style="vertical-align: left;">
							<?php 
                  if ($rowno!=0) {
                  
              ?> 
     <a href="javascript:;" class="editpurchasedetails" id="editDocRow_<?php echo $rowno; ?>" title="edit"> <i class="far fa-edit" style="color: #d04949;; font-weight:700;"></i>
     </a>&emsp;
           
	 <a href="javascript:;" class="delchildsalesissueDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
           <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
            <?php } ?> 

    </a>
        
        
			</td>				
				
		
    </tr>
    
<script type="text/javascript">
    $(document).ready(function(){

        $('.select2').select2()
        //$('.datemask').datepicker();

        $('.onlynumber').bind('keyup paste', function() {
        this.value = this.value.replace(/[^0-9]/g, '');

    });
    $(document).on("change keyup", ".calconml", function() {

        var rownum =  $(this).attr('data-rownum') 
        var liquer_vol = parseInt($("#childliquer_vol_name_"+rownum).val());
        var quantity = parseInt($("#childquantity_"+rownum).val());
       
        $("#childconve_"+rownum).val((liquer_vol * quantity)/1000);
        
         
        })

        $(document).on("change", ".itemcls", function() {      

        var itemid =  $(this).attr('id') 
        var rownum =  $(this).attr('data-rownum');
       // var unitname = $("#"+itemid+" option:selected").attr('data-unitname');
        var unitid = $("#"+itemid+" option:selected").attr('data-unitid');
        var liquer = $("#"+itemid+" option:selected").attr('data-liquer');
        var liquerid = $("#"+itemid+" option:selected").attr('data-liquerid');
       
        $("#purchaseunit_"+rownum).val(unitid);
        //$("#unit").val(unitname);
        $("#childliquer_vol_id_"+rownum).val(liquerid);
        $("#childliquer_vol_name_"+rownum).val(liquer);

        var liquer_vol = parseInt($("#childliquer_vol_name_"+rownum).val());
        var quantity = parseInt($("#childquantity_"+rownum).val());
       
        $("#childconve_"+rownum).val((liquer_vol * quantity)/1000);
    })


    })
</script>