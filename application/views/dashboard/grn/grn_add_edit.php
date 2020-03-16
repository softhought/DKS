<script src="<?php echo base_url(); ?>assets/js/customJs/grn/grn.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Goods Receipt Note </h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >

              <a href="<?php echo base_url(); ?>goodsreceiptnote/addGrn" class="btn btn-info btnpos">
              <i class="fas fa-plus"></i> Add </a> 

              <a href="<?php echo base_url(); ?>goodsreceiptnote" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>

            </div>           
            </div><!-- /.card-header -->

           <form name="goodsReceiptNoteFrom" id="goodsReceiptNoteFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="grnID" id="grnID" value="<?php echo $bodycontent['grnID']; ?>">
            <div class="card-body">

               <div class="formblock-box">
                           
                         <div class="row">
                           <div class="col-md-1"></div>
                              <div class="col-md-2">
                                <label for="groupname">GRN No</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="grn_no" id="grn_no" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['grnMasterEditdata']->grn_no; } ?>" readonly >
                                </div>
                              </div>
                           
                              </div>
                              

                          <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">GRN Date</label>
                            
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="grn_date" id="grn_date" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['grnMasterEditdata']->grn_date));}else{echo date('d/m/Y');}?>">
                          </div>
                        </div>
                        </div>

                    <div class="col-md-2">
                                <label for="groupname">Challan No</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="challan_no" id="challan_no" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['grnMasterEditdata']->challan_no; } ?>"  >
                                </div>
                              </div>
                           
                     </div>

                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">Challan Date</label>
                            
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="challan_date" id="challan_date" value="<?php if($bodycontent['mode'] == 'EDIT'){

                              if ($bodycontent['grnMasterEditdata']->challan_date!='') {
                                  echo date("d/m/Y", strtotime($bodycontent['grnMasterEditdata']->challan_date));
                               } 
                            
                              }else{}?>">
                          </div>
                        </div>
                        </div>

                         <div class="col-md-2">
                                <label for="groupname">P.O No</label>
                                  <div class="form-group">
                             <select class="form-control select2" name="purchase_order_no" id="purchase_order_no"  style="width: 100%;">
                              <option value="">Select</option>
                                  <?php 
                              foreach ($bodycontent['purchaseOrderList'] as $purchaseorderlist) {
                              
                               ?>
                               <option value="<?php echo $purchaseorderlist->purchase_id;?>" 
                               data-vendorname="<?php echo $purchaseorderlist->vendor_name; ?>"
                               data-purdate="<?php echo date("d/m/Y", strtotime($purchaseorderlist->order_date)); ?>"

                               <?php 
                           if($bodycontent['mode'] == 'EDIT'){
                              if ($bodycontent['grnMasterEditdata']->purchase_order_id==$purchaseorderlist->purchase_id) {
                                       
                                       echo "selected";
                                }

                                     }

                               ?>

                                >
                               <?php echo $purchaseorderlist->order_no;?></option>

                              <?php } ?>
                            </select>
                              </div>
                           
                        </div>

                   

        
                </div>

                 <div class="row">
                 <div class="col-md-1"></div>
                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">P.O Date</label>
                            
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="pur_order_date" id="pur_order_date" value="<?php if($bodycontent['mode'] == 'EDIT'){

                              if ($bodycontent['grnMasterEditdata']->order_date!='') {
                                  echo date("d/m/Y", strtotime($bodycontent['grnMasterEditdata']->order_date));
                               } 
                            
                              }else{}?>" readonly>
                          </div>
                        </div>
                        </div>
                      <div class="col-md-2">

                          <div class="form-group">
                            <label for="code">Department</label>
                             <div class="input-group input-group-sm" id="department_iderr"> 
                              <select class="form-control select2" name="department_id" id="department_id"  style="width: 100%;">
                              <option value="">Select</option>
                                <?php 
                                foreach ($bodycontent['departmentList'] as $departmentlist) {
                                ?>
                               <option value="<?php echo $departmentlist->department_id;?>"
                               <?php 
                                  if ($bodycontent['mode'] == 'EDIT') {
                                    if ($bodycontent['grnMasterEditdata']->department_id==$departmentlist->department_id) {
                                        echo "selected";
                                    }
                                  }
                               ?>
                               >
                               <?php echo $departmentlist->department_name;?></option>
                               <?php } ?>
                            </select>

                            </div>

                          </div>
                 </div><!-- end of col-md-2 -->
                        <div class="col-md-2">
                                <label for="groupname">Vendor</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="vendor_name" id="vendor_name" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['grnMasterEditdata']->vendor_name; } ?>"  readonly>
                                </div>
                              </div>
                           
                        </div>






                 </div>



                 

                      <!-- ----------------------Item details Account --------------------------- -->
                         <div class="row">
                          <div class="col-md-1"></div>
                    <div class="col-sm-10">
                    <div  id="detail_itemamt" style="border: 1px solid #a84e7f;max-height: 250px;overflow: scroll;">

                    <div class="table-responsive">
                     <?php
                          $rowno=0;
                          $detailCount = 0;
                          if($bodycontent['mode']=="EDIT")
                          {
                           $detailCount = sizeof($bodycontent['grnDetailsEditdata']);
                          
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

                 <table class="table table-bordered" style="font-size: 10px;color: #354668;<?php //echo $style_var; ?>">
                  <thead>                  
                    <tr>
                     
                      <th style="width:7%">Sl No</th>
                      <th style="width:25%">Name</th>
                      <th style="width:10%">Unit</th>
                      <th style="width:10%">Purchese Qty.</th>
                      <th style="width:10%">Qty.</th>
                      <th style="width:10%">Rate</th>
                      <th style="width:5%">Del</th>
                    </tr>
                  </thead>
                  <tbody>


                  <?php 
                        if ($bodycontent['grnDetailsEditdata']) {
                          $sl=1;
                          foreach ($bodycontent['grnDetailsEditdata'] as $purchasedtl) {
                         

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
    <input type="text" class="rowquantitycls" name="rowquantity[]" id="rowquantity_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['grn_quantity'];?>" onKeyUp="numericFilter(this);" > 
    <input type="hidden" name="rowquantityorg[]" id="rowquantityorg_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['remaining_quantity'];?>">  

    <input type="hidden" name="rowpurchasedtlid[]" id="rowpurchasedtlid_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['purchase_dtl_id']?>">  
     <?php //echo $purchasedtl->item_quantity;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="rowrate[]" id="rowrate_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['item_rate'];?>">   
  <!--   <input type="hidden" name="rowtaxableamt[]" id="rowtaxableamt_<?php echo $rowno; ?>" value="<?php echo $purchasedtl['taxable_amt'];?>"> -->   
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

                   
                  </tbody>
                </table>
                </div><!-- end of table responsive -->





                </div>

                <input type="hidden" name="rowno" id="rowno" value="<?php echo $rowno;?>">  
             
                </div>
                      
                    </div>


                    <!-- -------------End details account ------------------ -->

            
              </div>

               <div class="formblock-box">
                   <div class="row">

                        
                    

                      <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-10">
                        <?php }else{  ?>
                          <div class="col-md-10">
                        <?php  }?>
                          <p id="errormsg" class="errormsgcolor"></p>
                           <p id="response_msg" style="color: #689921;font-weight: bold;">  </p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="patrecsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

              
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

