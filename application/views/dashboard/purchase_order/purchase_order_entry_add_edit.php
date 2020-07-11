<script src="<?php echo base_url(); ?>assets/js/customJs/purchase/raw_meterial_purchase.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Purchase order </h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >

              <a href="<?php echo base_url(); ?>purchaseorder/addPurchaseorder" class="btn btn-info btnpos">
              <i class="fas fa-plus"></i> Add </a> 

              <a href="<?php echo base_url(); ?>purchaseorder" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>

            </div>           
            </div><!-- /.card-header -->

           <form name="purchaseOrderFrom" id="purchaseOrderFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="purchaseorderID" id="purchaseorderID" value="<?php echo $bodycontent['purchaseorderID']; ?>">
            <div class="card-body">

               <div class="formblock-box">
                           
                         <div class="row">
                           <div class="col-md-1"></div>
                              <div class="col-md-2">
                                <label for="groupname">Order No</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="order_no" id="order_no" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['purchaseMasterEditdata']->order_no; } ?>" readonly >
                                </div>
                              </div>
                           
                              </div>
                              

                          <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">Order Date</label>
                            
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="order_date" id="order_date" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['purchaseMasterEditdata']->order_date));;}else{echo date('d/m/Y');}?>">
                          </div>
                        </div>
                        </div>

                    <div class="col-md-2">
                                <label for="groupname">Qtn. No</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="quotation_no" id="quotation_no" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['purchaseMasterEditdata']->quotation_no; } ?>"  >
                                </div>
                              </div>
                           
                     </div>

                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">Qtn. Date</label>
                            
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="quotation_date" id="quotation_date" value="<?php if($bodycontent['mode'] == 'EDIT'){

                              if ($bodycontent['purchaseMasterEditdata']->quotation_date!='') {
                                  echo date("d/m/Y", strtotime($bodycontent['purchaseMasterEditdata']->quotation_date));
                               } 
                            
                              }else{}?>">
                          </div>
                        </div>
                        </div>
                           <div class="col-md-2">
                     <div class="form-group">
                            <label for="code">Vendor </label>
                             <div class="input-group input-group-sm" id="vendor_iderr">
                             
                              <select class="form-control select2" name="vendor_id" id="vendor_id"  style="width: 100%;">
                              <option value="">Select</option>
                                  <?php 
                              foreach ($bodycontent['allvendorList'] as $allvendorlist) {
                              
                               ?>
                               <option value="<?php echo $allvendorlist->vendor_id;?>"
                               <?php 
                               if($bodycontent['mode'] == 'EDIT'){

                               if($bodycontent['purchaseMasterEditdata']->vendor_id==$allvendorlist->vendor_id){echo "selected";} 
                                } ?>
                               >
                               <?php echo $allvendorlist->vendor_name;?></option>

                              <?php } ?>
                            </select>

                            </div>

                          </div>

                          </div>








        
                </div>

         



                 <div class="row">
                    <div class="col-md-1"></div>
             
                    <div class="col-md-2">

                          <div class="form-group">
                            <label for="code">Raw meterial</label>
                             <div class="input-group input-group-sm" id="raw_meterialerr">
                            <select class="form-control select2" name="raw_meterial" id="raw_meterial"  style="width: 100%;">
                              <option value="">Select</option>
                                  <?php 
                              foreach ($bodycontent['rawmeterialList'] as $rawmeteriallist) {
                              
                               ?>
                               <option value="<?php echo $rawmeteriallist->raw_meterial_id;?>">
                               <?php echo $rawmeteriallist->name;?></option>

                              <?php } ?>
                            </select>
                            </div>
                          </div>
                 </div><!-- end of col-md-2 -->

                   <div class="col-md-1">
                                <label for="groupname">Unit</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="unit" id="unit" placeholder="" value=""  onKeyUp="numericFilter(this);" readonly >
                                </div>
                              </div>
                           
                  </div>

                  <div class="col-md-1">
                                <label for="groupname">Qty</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="quantity" id="quantity" placeholder="" value=""  onKeyUp="numericFilter(this);" >
                                </div>
                              </div>
                           
                  </div>

                  <div class="col-md-1">
                                <label for="groupname">Rate</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="rate" id="rate" placeholder="" value=""  onKeyUp="numericFilter(this);"  >
                                </div>
                              </div>
                           
                  </div>

                   <input type="hidden" name="taxable_amt" id="taxable_amt" value="">
                   <input type="hidden" name="cgst_rate_id" id="cgst_rate_id" value="">
                   <input type="hidden" name="sgst_rate_id" id="sgst_rate_id" value="">

                  <div class="col-md-1">
                                <label for="groupname">Cgst Rate</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="cgst_rate" id="cgst_rate" placeholder="" value=""  onKeyUp="numericFilter(this);" readonly >
                                </div>
                              </div>   
                  </div>

                  <div class="col-md-1">
                                <label for="groupname">Cgst Amt.</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="cgst_amt" id="cgst_amt" placeholder="" value=""  onKeyUp="numericFilter(this);" readonly>
                                </div>
                              </div>     
                  </div>

                  <div class="col-md-1">
                                <label for="groupname">Sgst Rate</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="sgst_rate" id="sgst_rate" placeholder="" value=""  onKeyUp="numericFilter(this);" readonly >
                                </div>
                              </div>  
                  </div>

                   <div class="col-md-1">
                                <label for="groupname">Sgst Amt.</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="sgst_amt" id="sgst_amt" placeholder="" value=""  onKeyUp="numericFilter(this);" readonly>
                                </div>
                              </div>
                  </div>

                  <div class="col-md-1">
                                <label for="groupname">Amount</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="net_amt" id="net_amt" placeholder="" value=""  onKeyUp="numericFilter(this);" readonly>
                                </div>
                              </div>
                  </div>

                  <div class="col-md-1">   
                  <label for="groupname">&nbsp;</label>
                       <div class="form-group">
                                   <div class="input-group input-group-sm">
                      <button type="button" class="btn btn-sm action-button addrawMeterial" id="maingroupsavebtn" style="width: 60%;">Add</button>
                      </div></div> 

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
                           $detailCount = sizeof($bodycontent['purchaseDetailsEditdata']);
                          
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
                      <th style="width:10%">Qty.</th>
                      <th style="width:10%">Rate</th>
                      <th style="width:10%">CGST Rate</th>
                      <th style="width:10%">CGST Amt.</th>
                      <th style="width:10%">SGST Rate</th>
                      <th style="width:10%">SGST Amt.</th>
                      <th>Amount</th>
                      
                      <th style="width:5%">Del</th>
                    </tr>
                  </thead>
                  <tbody>


                  <?php 
                        if ($bodycontent['purchaseDetailsEditdata']) {
                          $sl=1;
                          foreach ($bodycontent['purchaseDetailsEditdata'] as $purchasedtl) {
                         

                  ?>


    

    <tr id="rowItemdetails_<?php echo $rowno; ?>" class="itemDtlCls" >
    
      <td style="text-align: left;"> 
        
      <span id="serial_<?php echo $rowno; ?>"><?php echo $sl++;?></span>                  
    </td>
    <td style="text-align: left;"> 
    <input type="hidden" class="rowrawmeteriacls" name="rowrawmeterial[]" id="rowrawmeterial_<?php echo $rowno; ?>" value="<?php echo $purchasedtl->raw_material_id;?>">   
     <?php echo $purchasedtl->raw_material;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="rowunit[]" id="rowunit_<?php echo $rowno; ?>" value="<?php echo $purchasedtl->item_unit_name;?>">   
     <?php echo $purchasedtl->item_unit_name;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="rowquantity[]" id="rowquantity_<?php echo $rowno; ?>" value="<?php echo $purchasedtl->item_quantity;?>">   
     <?php echo $purchasedtl->item_quantity;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="rowrate[]" id="rowrate_<?php echo $rowno; ?>" value="<?php echo $purchasedtl->item_rate;?>">   
    <input type="hidden" name="rowtaxableamt[]" id="rowtaxableamt_<?php echo $rowno; ?>" value="<?php echo $purchasedtl->taxable_amt;?>">   
     <?php echo $purchasedtl->item_rate;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_cgst_raterow[]" id="item_cgst_raterow_<?php echo $rowno; ?>" value="<?php echo $purchasedtl->cgst_id;?>">   
     <?php echo $purchasedtl->cgst_rate;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_cgst_amtrow[]" id="item_cgst_amtrow_<?php echo $rowno; ?>" value="<?php echo $purchasedtl->cgst_amt;?>">   
     <?php echo $purchasedtl->cgst_amt;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_sgst_raterow[]" id="item_sgst_raterow_<?php echo $rowno; ?>" value="<?php echo $purchasedtl->sgst_id;?>">   
     <?php echo $purchasedtl->sgst_rate;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_sgst_amtrow[]" id="item_sgst_amtrow_<?php echo $rowno; ?>" value="<?php echo $purchasedtl->sgst_amt;?>">   
     <?php echo $purchasedtl->sgst_amt;?>                   
    </td>
    <td style="text-align: right;"> 
    <input class="itemnetamtrow" type="hidden" name="item_netamtrow[]" id="item_netamtrow_<?php echo $rowno; ?>" value="<?php echo $purchasedtl->net_amount;?>">   
     <?php echo $purchasedtl->net_amount;?>                   
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



                    <div class="row">

                        <div class="col-md-1"></div>
                         
                             
                              <div class="col-md-2">
                                <label for="groupname">Total</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="total_amt" id="total_amt" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo number_format($bodycontent['purchaseMasterEditdata']->total_amount,2); } ?>" readonly >
                                </div>
                              </div>
                              </div> 

                               <div class="col-md-2"></div>
                                <div class="col-md-2">
                                <label for="groupname">Round Off</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="roundoff" id="roundoff" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['purchaseMasterEditdata']->round_off; } ?>"   onKeyUp="numericFilter(this);" >
                                </div>
                              </div>
                           
                              </div>

                               <div class="col-md-2"></div>
                                <div class="col-md-2">
                                <label for="groupname">Net Amount</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="net_amount" id="net_amount" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo number_format($bodycontent['purchaseMasterEditdata']->net_amount,2); } ?>" readonly >
                                </div>
                              </div>
                           
                              </div>   
                      
                    </div>


                    

                  


          
            
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
  

