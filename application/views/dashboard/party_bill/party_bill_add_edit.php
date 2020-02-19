<script src="<?php echo base_url(); ?>assets/js/customJs/party/party_bill.js"></script>
<style type="text/css">
.layout-box-content-format1 label{
    font-size: 10px;
}

.addItem {
  font-size: 28px;
  color:#9f4e7f;
  cursor: pointer;
  margin-left: 30px;
}

.addItemBOT{
  font-size: 28px;
  color:#9f4e7f;
  cursor: pointer;
  margin-left: 30px;
}

</style>
<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Party Bill</h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                 <a href="<?php echo base_url(); ?>partybill" class="btn btn-info btnpos"><i class="fas fa-clipboard-list"></i> List </a>
              </div> 
              
                           
            </div><!-- /.card-header -->

           <form name="partybillFrom" id="partybillFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="partybillId" id="partybillId" value="<?php echo $bodycontent['partybillID']; ?>">
           
            <div class="card-body">

          <div class="formblock-box"> 
             <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Bill Info</h3>
             




    <div class="row">
              
         <div class="col-md-9" >

               <div class="row">

                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Bill No</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="bill_no" name="bill_no" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['partybillEditdata']->party_bill_no;} ?>"  readonly >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->

                       <div class="col-md-3">
                          <div class="form-group">
                            <label for="eqpname">Bill Date</label>
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="party_bill_date" id="party_bill_date" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['partybillEditdata']->party_bill_date));;}else{echo date('d/m/Y');}?>">
                          </div>
                        </div>
                     </div>


                       <div class="col-md-3">
                          <div class="form-group">
                            <label for="eqpname">Party Date</label>
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="party_date" id="party_date" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['partybillEditdata']->party_date));;}else{echo date('d/m/Y');}?>">
                          </div>
                        </div>
                     </div>
                  
               </div>

              <fieldset class="scheduler-border "> 
              
              <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>KOT  Details</h3>

         

                  <div class="row">

                       <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Item Name</label>
                            <div class="input-group input-group-sm" id="select_itemerr">
                             <select class="form-control select2" name="select_item" id="select_item"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['canteenItemList'] as $canitemlist) {  
                               ?>
                               <option value="<?php echo $canitemlist->item_id?>"
                                 data-rate="<?php echo $canitemlist->item_rate; ?>"
                                 data-hsnno="<?php echo $canitemlist->hsn_no; ?>"
                                 data-mrp="<?php echo $canitemlist->mrp_rate; ?>"
                                ><?php echo $canitemlist->item_name?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">HSN </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="hsncode" name="hsncode" placeholder="" autocomplete="off" value="" readonly>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->


                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Qty</label>
                            <div class="input-group input-group-sm" >
                            <input type="text" class="form-control forminputs " id="itemqty" name="itemqty" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);" >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                           <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Rate</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_rate" name="item_rate" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);" readonly>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                        
<input type="hidden" class="form-control forminputs " id="itemtaxable" name="itemtaxable" placeholder="" autocomplete="off" value="" readonly>
                 

                   

                       <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">CGST Rt. </label>
                            <div class="input-group input-group-sm" id="item_cgst_rateerr">
                            
                             <select class="form-control select2" name="item_cgst_rate" id="item_cgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['cgstrate'] as $cgstrate) {  
                               ?>
                               <option value="<?php echo $cgstrate->id?>" data-rate="<?php echo $cgstrate->rate; ?>" ><?php echo $cgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Amt </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_cgst_amt" name="item_cgst_amt" placeholder="" autocomplete="off" value="" readonly>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">SGST Rt. </label>
                            <div class="input-group input-group-sm" id="item_sgst_rateerr" >
                            
                                 <select class="form-control select2" name="item_sgst_rate" id="item_sgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['sgstrate'] as $sgstrate) {  
                               ?>
                               <option value="<?php echo $sgstrate->id?>" data-rate="<?php echo $sgstrate->rate; ?>" ><?php echo $sgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Amt </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_sgst_amt" name="item_sgst_amt" placeholder="" autocomplete="off" value="" readonly >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                           <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Total Amt </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_netamt" name="item_netamt" placeholder="" autocomplete="off" value="" readonly >
                            </div>

                          </div>
                           <i class="far fa-plus-square addItem"></i>


                      </div><!-- end of col-md-1 -->

                   

                   








                      </div>
                      <!-- ----------------------Item details KOT --------------------------- -->
                         <div class="row">
                    <div class="col-sm-12">
                    <div  id="detail_itemamt" style="border: 1px solid #a84e7f;max-height: 250px;overflow: scroll;">

                    <div class="table-responsive">
                     <?php
                          $rowno=0;
                          $detailCount = 0;
                          if($bodycontent['mode']=="EDIT")
                          {
                           $detailCount = sizeof($bodycontent['catItemList']);
                          
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
                     
                      <th>Item</th>
                      <th>HSN</th>
                      <th>Qty</th>
                      <th>Rate</th>
                      <th>Taxable</th>
                      <th>Rate</th>
                      <th>CGST Amt.</th>
                      <th>Rate</th>
                      <th>SGST Amt.</th>
                      <th>Net Amt.</th>
                      <th style="width: 40px">Del</th>
                    </tr>
                  </thead>
                  <tbody>


                  <?php 
                        if ($bodycontent['catItemList']) {

                          foreach ($bodycontent['catItemList'] as $catItemList) {
                         

                  ?>
                    <!-- -------------------------------- CAT ------------------------------------ -->

                        <tr id="rowItemdetails_<?php echo $rowno; ?>" class="itemDtlCls" >
    
    <td style="text-align: left;width: 20%"> 
    <input type="hidden" class="tennisitemcls" name="tennisitemrow[]" id="tennisitemrow_<?php echo $rowno; ?>" value="<?php echo $catItemList->item_id;?>">   
     <?php echo $catItemList->item_name;?>                   
    </td>
    <td style="text-align: left;"> 
    <input type="hidden" name="hsncoderow[]" id="hsncoderow_<?php echo $rowno; ?>" value="<?php echo $catItemList->hsn_code;?>    ">   
     <?php echo $catItemList->hsn_code;?>                 
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="itemqtyrow[]" id="itemqtyrow_<?php echo $rowno; ?>" value=" <?php echo $catItemList->quantity;?> ">   
     <?php echo $catItemList->quantity;?>                      
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="itemraterow[]" id="itemraterow_<?php echo $rowno; ?>" value="<?php echo $catItemList->rate;?> ">   
     <?php echo $catItemList->rate;?>                   
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="itemtaxablerow[]" id="itemtaxablerow_<?php echo $rowno; ?>" value="<?php echo $catItemList->taxable;?>">   
     <?php echo $catItemList->taxable;?>                 
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_cgst_raterow[]" id="item_cgst_raterow_<?php echo $rowno; ?>" value="<?php echo $catItemList->cgst_rate_id;?>">   
    <?php  echo $catItemList->cgst_rate;?>                     
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_cgst_amtrow[]" id="item_cgst_amtrow_<?php echo $rowno; ?>" value="<?php echo $catItemList->cgst_amt;?>">   
    <?php echo $catItemList->cgst_amt;?>                  
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_sgst_raterow[]" id="item_sgst_raterow_<?php echo $rowno; ?>" value="<?php echo $catItemList->sgst_rate_id;?>">   
     <?php  echo $catItemList->sgst_rate;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="item_sgst_amtrow[]" id="item_sgst_amtrow_<?php echo $rowno; ?>" value="<?php echo $catItemList->sgst_amt;?>">   
    <?php echo $catItemList->sgst_amt;?>                  
    </td>
    <td style="text-align: right;"> 
    <input class="itemnetamtrow" type="hidden" name="item_netamtrow[]" id="item_netamtrow_<?php echo $rowno; ?>" value="<?php echo $catItemList->net_amount;?>">   
     <?php echo $catItemList->net_amount;?>                   
    </td>




                  
            </td> 

            <td style="vertical-align: middle;text-align: center;">
            
      <a href="javascript:;" class="delItenDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
      <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
           

        </a>
        
        
      </td>       
        
    
    </tr>
    


                     
    
                    <!-- -------------------------------------------------------------------------- -->


                  <?php 
                          }


                      }
                  ?>

            
    
               
                <input type="hidden" name="rowno" id="rowno" value="<?php echo $rowno;?>">     
                  </tbody>
                </table>
                </div><!-- end of table responsive -->





                </div>
             
                </div>
                      
                    </div>


                    <!-- -------------End Item details KOT ------------------ -->

                    <br>
                    <div class="row" style="color: #561a4c !important;">
                       <div class="col-sm-1">KOT</div>
                     <div class="col-sm-3">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_rowkotno" name="item_rowkotno" placeholder="" autocomplete="off" value="<?php 
                                    if($bodycontent['mode'] == 'EDIT'){
                                    echo $bodycontent['partybillEditdata']->cat_kot;
                                    }
                                    ?>"  >
                            </div>
                     </div>
                      
                        
                     </div>
                      <div class="col-sm-5"></div>
                      <div class="col-sm-1">Total</div>
                     <div class="col-sm-2">
                       
                         <div class="form-group">
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_rowtotal_amtkot" name="item_rowtotal_amtkot" placeholder="" autocomplete="off" value="<?php 
                                    if($bodycontent['mode'] == 'EDIT'){
                                    echo $bodycontent['partybillEditdata']->cat_amt;
                                    }
                                    ?>" readonly >
                            </div>
                     </div>
                      
                    </div>
                    </div>

                    <br>

    


              </fieldset>

                <fieldset class="scheduler-border "> 

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>BOT  Details</h3>

                       <div class="row">

                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Item Name</label>
                            <div class="input-group input-group-sm" id="select_item_boterr">
                             <select class="form-control select2" name="select_item_bot" id="select_item_bot"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['barItemList'] as $barItemList) {  
                               ?>
                               <option value="<?php echo $barItemList->item_id?>" 
                                 data-rate="<?php echo $canitemlist->item_rate; ?>"
                                 data-hsnno="<?php echo $canitemlist->hsn_no; ?>"
                                 data-mrp="<?php echo $canitemlist->mrp_rate; ?>"
                               ><?php echo $barItemList->item_name?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                          <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Qty</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="itemqty_bot" name="itemqty_bot" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);" >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                           <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Rate</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_rate_bot" name="item_rate_bot" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);" readonly >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

   <input type="hidden" class="form-control forminputs " id="itemtaxable_bot" name="itemtaxable_bot" placeholder="" autocomplete="off" value="" readonly>
                        <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">MRP </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="mrp_bot" name="mrp_bot" placeholder="" autocomplete="off" value="" readonly >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">CGST Rt. </label>
                            <div class="input-group input-group-sm" id="item_cgst_rate_boterr">
                            
                             <select class="form-control select2" name="item_cgst_rate_bot" id="item_cgst_rate_bot"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['cgstrate'] as $cgstrate) {  
                               ?>
                               <option value="<?php echo $cgstrate->id?>" data-rate="<?php echo $cgstrate->rate; ?>" ><?php echo $cgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Amt </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_cgst_amt_bot" name="item_cgst_amt_bot" placeholder="" autocomplete="off" value="" readonly>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">SGST Rt. </label>
                            <div class="input-group input-group-sm" id="item_sgst_rate_boterr" >
                            
                                 <select class="form-control select2" name="item_sgst_rate_bot" id="item_sgst_rate_bot"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['sgstrate'] as $sgstrate) {  
                               ?>
                               <option value="<?php echo $sgstrate->id?>" data-rate="<?php echo $sgstrate->rate; ?>" ><?php echo $sgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Amt </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_sgst_amt_bot" name="item_sgst_amt_bot" placeholder="" autocomplete="off" value="" readonly >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                           <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Total Amt </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_netamt_bot" name="item_netamt_bot" placeholder="" autocomplete="off" value="" readonly >
                            </div>

                          </div>
                          <i class="far fa-plus-square addItemBOT" ></i>


                      </div><!-- end of col-md-1 -->

                      

                    </div>



                        <!-- ----------------------Item details KOT --------------------------- -->
                         <div class="row">
                    <div class="col-sm-12">
                    <div  id="detail_itemamt_bot" style="border: 1px solid #a84e7f;max-height: 250px;overflow: scroll;">
                    <div class="table-responsive">
                     <?php
                          $rowno=0;
                          $detailCount = 0;
                          if($bodycontent['mode']=="EDIT")
                          {
                          $detailCount = sizeof($bodycontent['barItems']);
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

                 <table class="table table-bordered" style="font-size: 10px;color: #354668;<?php //echo $style_var; ?>">
                  <thead>                  
                    <tr>
                     
                      <th>Item</th>
                     
                      <th>Qty</th>
                      <th>Rate</th>
                      <th>Taxable</th>
                      <th>Rate</th>
                      <th>CGST Amt.</th>
                      <th>Rate</th>
                      <th>SGST Amt.</th>
                      <th>Net Amt.</th>
                      <th style="width: 40px">Del</th>
                    </tr>
                  </thead>
                  <tbody>

                  <!-- ----------------------------------------------------------------------------- -->
                    <?php 
                          if ($bodycontent['barItems']) {
                          
                       foreach ($bodycontent['barItems'] as $barItemList) {
                        

                    ?>


    

    <tr id="rowItemdetailsbot_<?php echo $rowno; ?>" class="itemDtlCls" >
    
    <td style="text-align: left;width: 20%"> 
    <input type="hidden" class="tennisitemcls" name="bottennisitemrow[]" id="bottennisitemrow_<?php echo $rowno; ?>" value="<?php echo $barItemList->item_id;?>">   
     <?php echo $barItemList->item_name;?>                   
    </td>
 
     <td style="text-align: right;"> 
    <input type="hidden" name="botitemqtyrow[]" id="botitemqtyrow_<?php echo $rowno; ?>" value="<?php echo $barItemList->quantity;?>">   
      <?php echo $barItemList->quantity;?>                  
    </td>
     <input type="hidden" name="botitemmrp[]" id="botitemmrp_<?php echo $rowno; ?>" value="<?php echo $barItemList->mrp;?>"> 
    <td style="text-align: right;"> 
    <input type="hidden" name="botitemraterow[]" id="botitemraterow_<?php echo $rowno; ?>" value="<?php echo $barItemList->rate;?>">   
     <?php echo $barItemList->rate;?>                  
    </td>
     <td style="text-align: right;"> 
    <input type="hidden" name="botitemtaxablerow[]" id="botitemtaxablerow_<?php echo $rowno; ?>" value="<?php echo $barItemList->taxable;?>">   
     <?php echo $barItemList->taxable;?>                  
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="botitem_cgst_raterow[]" id="botitem_cgst_raterow_<?php echo $rowno; ?>" value="<?php echo $barItemList->cgst_rate_id;?>  ">   
     <?php echo $barItemList->cgst_rate;?>                    
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="botitem_cgst_amtrow[]" id="botitem_cgst_amtrow_<?php echo $rowno; ?>" value="<?php echo $barItemList->cgst_amt;?>">   
    <?php echo $barItemList->cgst_amt;?>                   
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="botitem_sgst_raterow[]" id="botitem_sgst_raterow_<?php echo $rowno; ?>" value="<?php echo $barItemList->sgst_rate_id;?>  ">   
    <?php echo $barItemList->sgst_rate_id;?>                     
    </td>
    <td style="text-align: right;"> 
    <input type="hidden" name="botitem_sgst_amtrow[]" id="botitem_sgst_amtrow_<?php echo $rowno; ?>" value=" <?php echo $barItemList->sgst_amt;?>">   
    <?php echo $barItemList->sgst_amt;?>                   
    </td>
    <td style="text-align: right;"> 
    <input class="botitemnetamtrow" type="hidden" name="botitem_netamtrow[]" id="botitem_netamtrow_<?php echo $rowno; ?>" value="<?php echo $barItemList->net_amount;?>">   
    <?php echo $barItemList->net_amount;?>                  
    </td>




                  
            </td> 

            <td style="vertical-align: middle;text-align: center;">
            
      <a href="javascript:;" class="botdelItenDetails" id="botdelDocRow_<?php echo $rowno; ?>" title="Delete">
     
      <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
           

        </a>
        
        
      </td>       
        
    
    </tr>
    




                    <?php } } ?>
                  <!-- ----------------------------------------------------------------------------- -->


            
    
               
                <input type="hidden" name="botrowno" id="botrowno" value="<?php echo $rowno;?>">     
                  </tbody>
                </table>


                </div><!-- end of table responsive -->


                </div>
             
                </div>
                      
                    </div>


                              <br>
                    <div class="row" style="color: #561a4c !important;">
                       <div class="col-sm-1">BOT</div>
                     <div class="col-sm-3">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_rowtbotno" name="item_rowtbotno" placeholder="" autocomplete="off" value="<?php 
                                    if($bodycontent['mode'] == 'EDIT'){
                                    echo $bodycontent['partybillEditdata']->bar_kot;
                                    }
                                    ?>"  >
                            </div>
                     </div>
                      
                        
                     </div>

                     <div class="col-sm-5"></div>
                     <div class="col-sm-1">Total</div>
                     <div class="col-sm-2">
                     <div class="form-group">
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_rowtotal_botamt" name="item_rowtotal_botamt" placeholder="" autocomplete="off" value="<?php 
                                    if($bodycontent['mode'] == 'EDIT'){
                                    echo $bodycontent['partybillEditdata']->bar_amt;
                                    }
                                    ?>" readonly >
                            </div>
                     </div> 
                     </div>
                     </div>

                       <div class="row">
        <!--   <label for="firstname" class="col-sm-2 col-form-label" >Description</label> -->
          <div class="col-md-12">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="description" name="description" placeholder="Description" autocomplete="off" value="<?php 
                                    if($bodycontent['mode'] == 'EDIT'){
                                    echo $bodycontent['partybillEditdata']->description;
                                    }
                                    ?>"    >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->
         </div>

                    <br>


                    <!-- -------------End Item details KOT ------------------ -->

                 </fieldset>

                   <fieldset class="scheduler-border "> 

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Accounting  Details</h3>


                       <div class="row">

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">(A/C to be debited)</label>
                            <div class="input-group input-group-sm" id="select_dr_acerr">
                             <select class="form-control select2" name="select_dr_ac" id="select_dr_ac"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>

                               <?php
                                 foreach ($bodycontent['actobeDebitedList'] as $actobedebitedlist) {  
                               ?>
                               <option value="<?php echo $actobedebitedlist->account_id;?>"
                                <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->dr_ac_id==$actobedebitedlist->account_id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $actobedebitedlist->account_name?></option>
                              <?php }?>
                                
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->


                         <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">KOT A/c</label>
                            <div class="input-group input-group-sm" id="select_kot_acerr">
                             <select class="form-control select2" name="select_kot_ac" id="select_kot_ac"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                               <?php
                                 foreach ($bodycontent['actobeCreditedList'] as $actobecreditlist) {  
                               ?>
                               <option value="<?php echo $actobecreditlist->account_id;?>"
                               <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->kot_ac_id==$actobecreditlist->account_id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $actobecreditlist->account_name?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                       <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">BOT A/c</label>
                            <div class="input-group input-group-sm" id="select_bot_acerr">
                             <select class="form-control select2" name="select_bot_ac" id="select_bot_ac"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                               <?php
                                 foreach ($bodycontent['actobeCreditedList'] as $actobecreditlist) {  
                               ?>
                               <option value="<?php echo $actobecreditlist->account_id;?>"
                                <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->bot_ac_id==$actobecreditlist->account_id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $actobecreditlist->account_name?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Hall Charges A/c</label>
                            <div class="input-group input-group-sm" id="select_hall_acerr">
                             <select class="form-control select2" name="select_hall_ac" id="select_hall_ac"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                               <?php
                                 foreach ($bodycontent['actobeCreditedList'] as $actobecreditlist) {  
                               ?>
                               <option value="<?php echo $actobecreditlist->account_id;?>"
                                <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->hall_ac_id==$actobecreditlist->account_id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $actobecreditlist->account_name?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      </div>


                      <div class="row">

                         <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Guest Charges A/c</label>
                            <div class="input-group input-group-sm" id="select_guest_acerr">
                             <select class="form-control select2" name="select_guest_ac" id="select_guest_ac"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                               <?php
                                 foreach ($bodycontent['actobeCreditedList'] as $actobecreditlist) {  
                               ?>
                               <option value="<?php echo $actobecreditlist->account_id;?>"
                               <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->guest_ac_id==$actobecreditlist->account_id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $actobecreditlist->account_name?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->


                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Deco Charges A/c</label>
                            <div class="input-group input-group-sm" id="select_deco_acerr">
                             <select class="form-control select2" name="select_deco_ac" id="select_deco_ac"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                               <?php
                                 foreach ($bodycontent['actobeCreditedList'] as $actobecreditlist) {  
                               ?>
                               <option value="<?php echo $actobecreditlist->account_id;?>"
                               <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->deco_ac_id==$actobecreditlist->account_id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $actobecreditlist->account_name?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                          <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Electric Charges A/c</label>
                            <div class="input-group input-group-sm" id="select_electric_acerr">
                             <select class="form-control select2" name="select_electric_ac" id="select_electric_ac"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                               <?php
                                 foreach ($bodycontent['actobeCreditedList'] as $actobecreditlist) {  
                               ?>
                               <option value="<?php echo $actobecreditlist->account_id;?>"
                                <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->electric_ac_id==$actobecreditlist->account_id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $actobecreditlist->account_name?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->


                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Other Charges A/c</label>
                            <div class="input-group input-group-sm" id="select_other_acerr">
                             <select class="form-control select2" name="select_other_ac" id="select_other_ac"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                               <?php
                                 foreach ($bodycontent['actobeCreditedList'] as $actobecreditlist) {  
                               ?>
                               <option value="<?php echo $actobecreditlist->account_id;?>" 
                                 <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->other_ac_id==$actobecreditlist->account_id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                               ><?php echo $actobecreditlist->account_name?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                        

                      </div>


                    </fieldset>






               
        </div><!-- end of left part -->





         <div class="col-md-3 " style="#border:1px solid green;">
             

          <div style="padding: 5px;padding-top: 10px;background-color: #f7eeee;">
         <div class="row">
          <label for="firstname" class="col-sm-4 col-form-label" >Mem Code</label>
          <div class="col-md-8">
                          <div class="form-group">
                           
                             <div id="resetmemberlist">
                             <div class="input-group input-group-sm" id="sel_member_codeerr">
                              <select class="form-control select2" name="sel_member_code" id="sel_member_code" >
                              <option value="">Select</option>
                              <?php 
                              foreach ($bodycontent['memberCodeList'] as  $membercode) {    
                              ?>
                              <option value="<?php echo $membercode->member_id;?>"
                               data-name="<?php echo $membercode->title_one." ".$membercode->member_name; ?>"

                                <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->member_id==$membercode->member_id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                              
                              ><?php echo $membercode->member_code;?></option>
                              <?php } ?>
                             
                            </select>
                            </div></div>

                          </div>
                      </div><!-- end of col-md-3 -->
         </div>

          <div class="row">
          <label for="firstname" class="col-sm-4 col-form-label" >Mem Name</label>
          <div class="col-md-8">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs  " id="member_name" name="member_name" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                 echo $bodycontent['partybillEditdata']->title_one." ".$bodycontent['partybillEditdata']->member_name;
                                }
                               ?>"   readonly >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->
         </div>


         </div> 





         <br>
         <div class="row">
          <label for="firstname" class="col-sm-5 col-form-label">Hall Charges</label>
          <div class="col-md-7">
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="hall_charges" name="hall_charges" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->hall_chaeges!=0) {
                                  echo $bodycontent['partybillEditdata']->hall_chaeges;
                                }
                                
                                }
                               ?>" onKeyUp="numericFilter(this);"  >
                            </div>
                          </div>
                      </div><!-- end of col-md-3 -->
         </div>


         <div class="row">
                       <label for="firstname" class="col-sm-4 col-form-label" >CGST%</label>
                      <div class="col-md-5">
                          <div class="form-group" id="hall_cgst_rateerr">
                        
                                 <select class="form-control select2" name="hall_cgst_rate" id="hall_cgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['cgstrate'] as $cgstrate) {  
                               ?>
                               <option value="<?php echo $cgstrate->id?>" data-rate="<?php echo $cgstrate->rate; ?>"
                                <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->hall_cgst_id==$cgstrate->id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $cgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                          </div>
                      </div><!-- end of col-md-5 -->
                        <div class="col-md-3">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="hall_cgst_amt" name="hall_cgst_amt" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->hall_cgst_amt!=0) {
                                  echo $bodycontent['partybillEditdata']->hall_cgst_amt;
                                }
                                
                                }
                               ?>"    >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->



         </div>

    

        <div class="row">
                       <label for="firstname" class="col-sm-4 col-form-label" >SGST%</label>
                      <div class="col-md-5">
                          <div class="form-group" id="hall_sgst_rateerr">
                        
                                 <select class="form-control select2" name="hall_sgst_rate" id="hall_sgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['sgstrate'] as $sgstrate) {  
                               ?>
                               <option value="<?php echo $sgstrate->id?>" data-rate="<?php echo $sgstrate->rate; ?>"
                               <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->hall_sgst_id==$sgstrate->id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $sgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                          </div>
                      </div><!-- end of col-md-1 -->
                         <div class="col-md-3">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="hall_sgst_amt" name="hall_sgst_amt" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->hall_sgst_amt!=0) {
                                  echo $bodycontent['partybillEditdata']->hall_sgst_amt;
                                }
                                
                                }
                               ?>"    >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->

         </div>

          <div class="row">
          <label for="firstname" class="col-sm-4 col-form-label" >Total</label>
          <div class="col-md-8">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="hall_total_amt" name="hall_total_amt" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->hall_net_amt!=0) {
                                  echo $bodycontent['partybillEditdata']->hall_net_amt;
                                }
                                
                                }
                               ?>"  readonly  >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->
         </div>

          <div class="row">
             <label for="firstname" class="col-sm-12 col-form-label" >Guest Charges</label>
          
          </div>

           <div class="row">
          <label for="firstname" class="col-sm-4 col-form-label" >Head</label>
          <div class="col-md-3">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="guest_head" name="guest_head" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->guest_head!=0) {
                                  echo $bodycontent['partybillEditdata']->guest_head;
                                }
                                
                                }
                               ?>"    >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->
           <label for="firstname" class="col-sm-2 col-form-label" >Rate</label>
                     <div class="col-md-3">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="guest_rate" name="guest_rate" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->guest_rate!=0) {
                                  echo $bodycontent['partybillEditdata']->guest_rate;
                                }
                                
                                }
                               ?>"    >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->            
         </div>



        <div class="row">
               <label for="firstname" class="col-sm-4 col-form-label">Amount</label>
                  <div class="col-md-6">
                          <div class="form-group">   
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="guest_amt" name="guest_amt" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->guest_amt!=0) {
                                  echo $bodycontent['partybillEditdata']->guest_amt;
                                }
                                
                                }
                               ?>" readonly >
                            </div>
                          </div>
                 </div><!-- end of col-md-3 --> 
          </div>




            <div class="row">
                       <label for="firstname" class="col-sm-4 col-form-label" >CGST%</label>
                      <div class="col-md-5">
                          <div class="form-group" id="guest_cgst_rateerr">
                        
                                 <select class="form-control select2" name="guest_cgst_rate" id="guest_cgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['cgstrate'] as $cgstrate) {  
                               ?>
                               <option value="<?php echo $cgstrate->id?>" data-rate="<?php echo $cgstrate->rate; ?>"
                               <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->guest_cgst_id==$cgstrate->id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $cgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                          </div>
                      </div><!-- end of col-md-5 -->
                        <div class="col-md-3">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="guest_cgst_amt" name="guest_cgst_amt" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->guest_cgst_amt!=0) {
                                  echo $bodycontent['partybillEditdata']->guest_cgst_amt;
                                }
                                
                                }
                               ?>" readonly   >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->



         </div>

    

        <div class="row">
                       <label for="firstname" class="col-sm-4 col-form-label" >SGST%</label>
                      <div class="col-md-5">
                          <div class="form-group" id="guest_sgst_rateerr">
                        
                                 <select class="form-control select2" name="guest_sgst_rate" id="guest_sgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['sgstrate'] as $sgstrate) {  
                               ?>
                               <option value="<?php echo $sgstrate->id?>" data-rate="<?php echo $sgstrate->rate; ?>"
                                <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['partybillEditdata']->guest_sgst_id==$sgstrate->id) {
                                   echo "selected";
                                  }
                                }
                               ?>
                                ><?php echo $sgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                          </div>
                      </div><!-- end of col-md-1 -->
                         <div class="col-md-3">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="guest_sgst_amt" name="guest_sgst_amt" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->guest_sgst_amt!=0) {
                                  echo $bodycontent['partybillEditdata']->guest_sgst_amt;
                                }
                                
                                }
                               ?>"  readonly  >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->

         </div>

          <div class="row">
          <label for="firstname" class="col-sm-4 col-form-label" >Total</label>
          <div class="col-md-8">
              <div class="form-group">
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="guest_net_amt" name="guest_net_amt" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->guest_net_amt!=0) {
                                  echo $bodycontent['partybillEditdata']->guest_net_amt;
                                }
                                
                                }
                               ?>"   readonly >
                            </div>

               </div>
               </div><!-- end of col-md-3 -->
         </div>


         <div class="row">
          <label for="firstname" class="col-sm-4 col-form-label" >Deco Charges</label>
          <div class="col-md-8">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="deco_chages" name="deco_chages" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->deco_chages!=0) {
                                  echo $bodycontent['partybillEditdata']->deco_chages;
                                }
                                
                                }
                               ?>"    >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->
         </div>

           <div class="row">
          <label for="firstname" class="col-sm-4 col-form-label" >Electric Charges</label>
          <div class="col-md-8">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="electric_charges" name="electric_charges" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->electric_charges!=0) {
                                  echo $bodycontent['partybillEditdata']->electric_charges;
                                }
                                
                                }
                               ?>"    >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->
         </div>

         <div class="row">
          <label for="firstname" class="col-sm-4 col-form-label" >Other Charges</label>
          <div class="col-md-8">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="other_charges" name="other_charges" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->other_charges!=0) {
                                  echo $bodycontent['partybillEditdata']->other_charges;
                                }
                                
                                }
                               ?>"    >
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->
         </div>

         


          <div class="row">
          <label for="firstname" class="col-sm-4 col-form-label" >Total</label>
          <div class="col-md-8">
                          <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="final_total" name="final_total" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){
                                if ($bodycontent['partybillEditdata']->final_total!=0) {
                                  echo $bodycontent['partybillEditdata']->final_total;
                                }
                                
                                }
                               ?>"  readonly>
                            </div>

                          </div>
                      </div><!-- end of col-md-3 -->
         </div>

            







               
    </div>
             
           
         
           
            
            
              
             

           

             </div>
            

            </div> 

             <div class="formblock-box"> 
            
                   <div class="row">
                    <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-10">
                            <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                        <?php }else{  ?>
                          <div class="col-md-10">
                            <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                        <?php  }?>
                   
                     <div class="col-md-2">
                       <button type="submit" class="btn btn-sm action-button" id="gstsavebtn" style="width: 80%;"><?php echo $bodycontent['btnText']; ?></button>

                         <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 80%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                     </div>
                      <?php if($bodycontent['mode'] == 'ADD'){ ?>
                      <!-- <div class="col-md-2">
                       <button type="reset" id="resetgstform" class="btn btn-sm action-button" style="width: 80%;">Reset</button>
                     </div> -->
                   <?php } ?>
                   </div>
              </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </section>

