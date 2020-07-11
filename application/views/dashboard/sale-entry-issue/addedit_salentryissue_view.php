<script src="<?php echo base_url(); ?>assets/js/customJs/sale-entry-issue/salentryissue.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Sale Entry (Issue)</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>salentryissue" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="saleentryissueFrom" id="saleentryissueFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="saleissueId" id="saleissueId" value="<?php echo $bodycontent['saleissueId']; ?>">
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Sale Entry Issue Info</h3>  
                    <div class="row">
                  
                   <div class="col-md-2">  
                    <label for="tran_no" >Transaction No.</label>                   
                        <div class="form-group" >                    
                            <div class="input-group input-group-sm">                     
                                  
                              <input type="text" class="form-control "  name="tran_no" id="tran_no" im-insert="false" value=" <?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['salentryissueEditdata']->tran_no; } ?>"  readonly/>
                                    
                            </div>
                          </div>
                      </div>
                 
                   <div class="col-md-2">   
                   <label for="tran_date" >Transaction Date</label>                 
                      <div class="form-group" >                    
                          <div class="input-group input-group-sm">                          
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>    
                             <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="tran_date" id="tran_date" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['salentryissueEditdata']->tran_date != ''){ echo  date('d/m/Y',strtotime($bodycontent['salentryissueEditdata']->tran_date)); } else{ echo date('d/m/Y'); } ?>" readonly />
                                  
                          </div>
                        </div>
                    </div>
                    </div>
                    
                   
                         <div class="row">  
                         <div class="col-md-3">
                                <label for="item_name">Item Name</label>
                                <div class="form-group">
                                  <div class="input-group input-group-sm" >
                                  <select class="form-control select2 cal" id="item_name" name="item_name" style="width: 100%;">
                                    <option value=''>Select</option>
                                    <?php foreach ($bodycontent['itemmasterlist'] as $itemmasterlist) { ?>

                                      <option value="<?php echo $itemmasterlist->id; ?>" data-unitname = "<?php echo $itemmasterlist->unit; ?>" data-liquer = "<?php echo $itemmasterlist->lequer_vol; ?>" data-unitid = "<?php echo $itemmasterlist->bar_unit_id; ?>" data-liquerid="<?php echo $itemmasterlist->liquer_vol_id; ?>"

                                        ><?php echo $itemmasterlist->item_name; ?></option>
                                    
                                  <?php   } ?>
                                  
                                  </select>
                                
                                  </div>
                                </div>
                           
                              </div>

                    <div class="col-md-2">   
                    <label for="stock_in_hand" >Stock In Hand</label>                 
                      <div class="form-group" >                    
                          <div class="input-group input-group-sm">  
                             <input type="text" class="form-control "  name="stock_in_hand" id="stock_in_hand" im-insert="false" value="" />
                                  
                          </div>
                        </div>
                    </div>
                             
                              <div class="col-md-1">
                                  <label>Unit</label>
                                    <div class="form-group">
                                      <div class="input-group input-group-sm">
                                      <input type="hidden" class="form-control "  name="unit_id" id="unit_id" im-insert="false" value="" />
                                      <input type="text" class="form-control "  name="unit" id="unit" im-insert="false" value="" readonly/>
                                        <!-- <select class="form-control select2 " id="unit" name="unit" style="width: 100%;">
                                          <option value=''>Select</option>
                                          <?php foreach ($bodycontent['unitlist'] as $value) { ?>

                                            <option value="<?php echo $value->bar_unit_id; ?>"

                                          
                                              ><?php echo $value->unit; ?></option>
                                          
                                        <?php   } ?>
                                        
                                        </select> -->
                                        </div>
                                                              
                                    </div>
                                    
                                  </div>
                                
                    
                        <div class="col-md-1">
                            <label>Liquer Vol</label>
                              <div class="form-group">
                                <div class="input-group input-group-sm">
                                <input type="hidden" class="form-control "  name="liquer_id" id="liquer_id" im-insert="false" value="" />
                                <input type="text" class="form-control "  name="liquer" id="liquer" im-insert="false" value="" readonly/>
                                  <!-- <select class="form-control select2 calconml " id="liquer_vol_id" name="liquer_vol_id" style="width: 100%;">
                                    <option value=''>Select</option>
                                    <?php foreach ($bodycontent['liquervollist'] as $liquervollist) { ?>

                                      <option value="<?php echo $liquervollist->id; ?>"

                                     
                                        ><?php echo $liquervollist->lequer_vol; ?></option>
                                    
                                  <?php   } ?>
                                  
                                  </select> -->
                                  </div>
                                                        
                              </div>
                              
                            </div>
                            <div class="col-md-2">
                                  <label>Issue To Loc.</label>
                                    <div class="form-group">
                                      <div class="input-group input-group-sm">
                                      <select class="form-control select2 " id="location_id" name="location_id" style="width: 100%;">
                                          <option value=''>Select</option>
                                          <?php foreach ($bodycontent['locationlist'] as $value) { ?>

                                            <option value="<?php echo $value->location_id; ?>"
                                          
                                              ><?php echo $value->location; ?></option>
                                          
                                        <?php   } ?>
                                        
                                        </select>
                                        </div>
                                                              
                                    </div>
                                    
                                  </div>
                                  <div class="col-md-1">
                              <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <div class="input-group input-group-sm">
                                <input type="text" class="form-control onlynumber cal" id="quantity" name="quantity" placeholder="" autocomplete="off" value="">
                                </div>

                              </div>
                        </div><!-- end of col-md-3 --> 
                            <div class="col-md-1">
                          <div class="form-group">
                            <label for="convar_ml">Conv. Ltr</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="convar_ml" name="convar_ml" placeholder="" autocomplete="off" value="" readonly>
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->
                           
                         
                     
                     <div class="col-md-1">
                          <div class="form-group">
                            <label for="purachse">&nbsp;</label>
                            <div class="input-group input-group-sm">
                            <button type="button" class="btn btn-sm action-button" id="addpurchageentry"><i class="fas fa-plus"></i> Add</button>
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->                                    
                                         
                </div>
                    

            <!-- sales entry issue details  -->
            <div class="row">
                  <div class="col-sm-12">
                      <div  id="detail_saleentryissue" style="#border: 1px solid #e49e9e;">
                        <div class="table-responsive">
                            <?php
                                      $rowno=0;
                                      $detailCount = 0;
                                      if($bodycontent['mode']=="EDIT")
                                      {
                                      $detailCount = sizeof($bodycontent['saleissuedtl']);
                                      //$detailCount = 0;
                                      }

                                      // For Table style Purpose
                                      if($bodycontent['mode']=="EDIT" && $detailCount>0)
                                      {
                                        $style_var = "display:block;width:100%;";
                                      }
                                      else
                                      {
                                        $style_var = "display:none;width:100%;";
                                      }
                                    ?>

            <table id="salesissustable" class="table table-bordered" style="font-size: 13px;color: #354668;<?php echo $style_var; ?>">
                <thead>                  
                    <tr>
                                
                        <th style="width: 5%">Sl.No.</th>
                        <th style="width: 20%">Item Name</th>
                        <th style="width: 20%">Liquer Vol</th>                        
                        <th style="width: 20%">Issue To Loc.</th> 
                        <th style="width: 20%">Qty</th>                           
                        <th style="width: 20%">Conv. Ltr</th>                                         
                        <th style="width: 80px;" >Action</th>
                      </tr>
                </thead>
              <tbody>
                <input type="hidden" name="delIds" id="delIds" value="">
                <input type="hidden" name="checksalesentryissue" id="checksalesentryissue" value="<?php if($bodycontent['mode']=="EDIT" && $detailCount>0){ echo 'Y'; }else{ echo 'N'; }  ?>">
               
                <?php 

                 if($bodycontent['mode']=="EDIT")
                 {
                
                  foreach ($bodycontent['saleissuedtl'] as $saleissuedtl) { ?>

                    <tr id="rowpurchasedetails_<?php echo $rowno; ?>" class="childDtlCls" >

                    <input type="hidden" name="editbtncheck" id="editbtncheck_<?php echo $rowno; ?>" value="N">  
                    <input type="hidden" name="saleeentryissueId[]" id="saleeentryissueId_<?php echo $rowno; ?>" value="<?php echo $saleissuedtl->id; ?>"> 
                    <input type="hidden" name="stockinhand[]" id="stockinhand_<?php echo $rowno; ?>" value="<?php echo $saleissuedtl->stock_in_hand; ?>"> 
                    <input type="hidden" name="itemunit[]" id="itemunit_<?php echo $rowno; ?>" value="<?php echo $saleissuedtl->unit_id; ?>"> 
                    <td style="text-align: left;width: 5%"><?php echo $rowno+1; ?>
                      
                    </td>
                    <td style="text-align: left;width: 20%"> 
                          <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                                  <div class="input-group input-group-sm">                         
                                      <select class="form-control select2 itemcls" name="childitem_name[]" id="childitem_name_<?php echo $rowno; ?>" data-rownum = "<?php echo $rowno; ?>">
                                          <option value=''>&nbsp; </option>
                                          <?php foreach ($bodycontent['itemmasterlist'] as $itemmasterlist) { ?>
                                                  <option value="<?php echo $itemmasterlist->id; ?>" data-unitname = "<?php echo $itemmasterlist->unit; ?>" data-liquer = "<?php echo $itemmasterlist->lequer_vol; ?>" data-unitid = "<?php echo $itemmasterlist->bar_unit_id; ?>" data-liquerid="<?php echo $itemmasterlist->liquer_vol_id; ?>" 
                                                      
                                                      <?php if($itemmasterlist->id == $saleissuedtl->item_master_id){
                                                          echo 'selected'; $itemname = $itemmasterlist->item_name;
                                                      } ?>

                                                      >
                                                          <?php echo $itemmasterlist->item_name; ?>
                                                      </option>
                                          <?php   } ?>
                                      </select>


                                  </div>
                              </div> 
                    <span class="showdata_<?php echo $rowno; ?>"><?php echo $itemname;?></span>       		        
                    </td>
                    <td style="text-align: left;width: 20%"> 
                              <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                                              <div class="input-group input-group-sm"> 

                                              <input type="hidden" class="form-control "  name="childliquer_vol_id[]" id="childliquer_vol_id_<?php echo $rowno; ?>" im-insert="false" value="<?php echo $saleissuedtl->liquer_vol_id;?>" readonly />
                                              <input type="hidden" class="form-control editchilddtl_<?php echo $rowno; ?> "  name="childliquer_vol_name[]" id="childliquer_vol_name_<?php echo $rowno; ?>"  im-insert="false" value="<?php echo $saleissuedtl->lequer_vol;?>" readonly />                                                                 
                                                  
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
                    <span class="showdata_<?php echo $rowno; ?>"><?php echo $saleissuedtl->lequer_vol;?></span>                   
                    </td>
                    <td style="text-align: left;width: 20%"> 
                              <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                                              <div class="input-group input-group-sm"> 
                                              
                                                  <select class="form-control select2 calconml" name="childlocation_id[]" id="childlocation_id_<?php echo $rowno; ?>" data-rownum = "<?php echo $rowno; ?>">
                                                      <option value=''>&nbsp; </option>
                                                      <?php foreach ($bodycontent['locationlist'] as $locationlist) { ?>
                                                              <option value="<?php echo $locationlist->location_id; ?>" 
                                                                  
                                                                  <?php if($locationlist->location_id == $saleissuedtl->location_id){
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
                              <input type="hidden" class="form-control calconml onlynumber editchilddtl_<?php echo $rowno; ?>" name="childquantity[]" id="childquantity_<?php echo $rowno; ?>" data-rownum = "<?php echo $rowno; ?>" value="<?php echo $saleissuedtl->quantity;?>"> 
                          </div>
                      </div>         
                    <span class="showdata_<?php echo $rowno; ?>"><?php echo $saleissuedtl->quantity;?> </span>                  
                    </td>


                    <td style="text-align: left;width: 20%">
                    <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                          <div class="input-group input-group-sm"> 
                              <input type="hidden" class="form-control editchilddtl_<?php echo $rowno; ?>" name="childconve[]" id="childconve_<?php echo $rowno; ?>" value="<?php echo ($saleissuedtl->lequer_vol * $saleissuedtl->quantity)/1000;?>" readonly> 
                          </div>
                      </div>         
                    <span class="showdata_<?php echo $rowno; ?>"><?php echo ($saleissuedtl->lequer_vol * $saleissuedtl->quantity)/1000;?> </span>                  
                    </td>


                    <td style="vertical-align: left;">
                           
                    <a href="javascript:;" class="editpurchasedetails" id="editDocRow_<?php echo $rowno; ?>" title="edit"> <i class="far fa-edit" style="color: #d04949;; font-weight:700;"></i>
                    </a>&emsp;
                        
                    <a href="javascript:;" class="delchildsalesissueDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">

                        <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
                         

                    </a>
                      
                      
                    </td>				
                      

                    </tr>
                                  
                <?php $rowno++; } } ?>
                          
                            <input type="hidden" name="rowno" id="rowno" value="<?php echo $rowno;?>">     
                              </tbody>
                            </table>
                            </div><!-- end of table responsive -->
                            </div>
                        
                            </div>

                                </div>
                    
                        
                          </div>
                           <!--end children details -->


               <div class="formblock-box">
                   <div class="row">

                      <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-10">
                        <?php }else{  ?>
                          <div class="col-md-10">
                        <?php  }?>
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="salesissuedtlsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

                   
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

