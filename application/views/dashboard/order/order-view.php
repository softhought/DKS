<script src="<?php echo base_url(); ?>assets/js/customJs/order/kot_bot.js"></script>

<script src="<?php echo base_url(); ?>assets/js/JsLocalSearch.js"></script>



<form name="barcatorderFrom" id="barcatorderFrom" enctype="multipart/form-data">



<div class="order-view-panel layout-box-content-format1">





<div class="card card-primary">

              <input type="hidden" name="orderID" id="orderID" value="<?php echo $bodycontent['orderId']; ?>" />

             <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />



            <div class="card-body">

                <div class="member-info formblock-box">

                    <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Member Info</h3>



                    <div class="row">

                        <div class="col-md-1">

                            <div class="form-group">

                                <div class="input-group input-group-sm">

                                    <input type="text" class="form-control" placeholder="KOT No" readonly value="<?php 

                                    if($bodycontent['mode'] == 'EDIT'){

                                    echo $bodycontent['orderEditdata']->order_no;

                                    }

                                    ?>" >

                                </div>

                            </div>

                        </div>

                        <div class="col-md-1">

                            <div class="form-group">

                                <div class="input-group input-group-sm">

                                   

                                      <input type="text" class="form-control datemask kotbotorderdate" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="order_dt" id="order_dt" value="<?php 

                                       if($bodycontent['mode'] == 'EDIT'){

                                    echo date("d/m/Y", strtotime($bodycontent['orderEditdata']->order_date));

                                    }else{



                                      echo date('d/m/Y'); }

                                      ?>" placeholder="KOT Date"  >

                                </div>

                            </div>

                        </div>

                           <div class="col-md-2">

                          <div class="form-group ">

                          

                            <div id="resetstudentlist">

                             <div class="input-group input-group-sm" id="sel_member_codeerr">

                              <select class="form-control select2" name="sel_member_code" id="sel_member_code" >

                              <option value=""

                               data-name=""

                               data-titleone=""

                              >Member Code</option>

                              <?php 

                              foreach ($bodycontent['memberCodeList'] as  $membercode) {

                                

                              ?>

                              <option value="<?php echo $membercode->member_id;?>"

                               data-name="<?php echo $membercode->member_name; ?>"

                               data-titleone="<?php echo $membercode->title_one; ?>"



                               <?php if($bodycontent['mode'] == 'EDIT'){

                                  if ($bodycontent['orderEditdata']->member_id==$membercode->member_id) {

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

                        <div class="col-md-2">

                            <div class="form-group">

                                <div class="input-group input-group-sm">

                                    <input type="text" class="form-control" placeholder="Member Name" name="membername" id="membername" readonly value="<?php 



                               if($bodycontent['mode'] == 'EDIT'){

                                  echo $bodycontent['orderEditdata']->title_one." ".$bodycontent['orderEditdata']->member_name;

                                  

                                }

                               ?>">

                                </div>

                            </div>

                        </div>

                        

                    

                        <div class="col-md-2">

                           

                            <div class="form-group">

                              <div class="input-group input-group-sm" id="sel_location_codeerr">

                                    <select class="form-control select2" name="sel_location" id="sel_location" style="width: 100%;">

                                      <option value=''>Choose Location</option>

                                        <?php 

                                      foreach ($bodycontent['locationList'] as  $locrow) {

                                        

                                      ?>

                                      <option value="<?php echo $locrow->location_id;?>"

                                      



                                       <?php if($bodycontent['mode'] == 'EDIT'){

                                          if ($bodycontent['orderEditdata']->location_id==$locrow->location_id) {

                                           echo "selected";

                                          }

                                        }

                                       ?>



                                      ><?php echo $locrow->location;?></option>

                                      <?php } ?>

                                    </select>

                              </div>

                            </div>

                        </div>

                      

                        <div class="col-md-2">

                            <!-- <label for="category">Category</label> -->

                            <div class="form-group">

                              <div class="input-group input-group-sm">

                                    <select class="form-control select2" id="item_category" name="item_category" style="width: 100%;">

                                      

                                      <option value="CAT" <?php if($bodycontent['mode'] == 'EDIT'){

                                          if ($bodycontent['orderEditdata']->category=="CAT") {

                                           echo "selected";

                                          }

                                        }

                                       ?>>CANTEEN</option>

                                      <option value="BAR"  <?php if($bodycontent['mode'] == 'EDIT'){

                                          if ($bodycontent['orderEditdata']->category=="BAR") {

                                           echo "selected";

                                          }

                                        }

                                       ?>>BAR</option>

                                    </select>

                              </div>

                            </div>

                        </div>







                        <div class="col-md-2">

                            <!-- <label for="category">Waiter</label> -->

                            <div class="form-group">

                              <div class="input-group input-group-sm">

                                    <select class="form-control select2" id="waiter" name="waiter" style="width: 100%;">

                                      <option value=''> Waiter</option>

                                       <?php 

                                      foreach ($bodycontent['waiterList'] as  $waiterrow) {

                                        

                                      ?>

                                      <option value="<?php echo $waiterrow->id;?>"

                                      



                                       <?php if($bodycontent['mode'] == 'EDIT'){

                                          if ($bodycontent['orderEditdata']->waiter_id==$waiterrow->id) {

                                           echo "selected";

                                          }

                                        }

                                       ?>



                                      ><?php echo $waiterrow->waiter_name;?></option>

                                      <?php } ?>

                                    </select>

                              </div>

                            </div>

                        </div>

                    </div>

                     <div class="row">

                       <div class="col-md-8">

                          <p id="error_msg" class="error" style="color: #bf2929;"></p>

                       </div>

                       </div>



                </div>

            </div>



        </div>







    <div class="left-order-panel">

        <div class="card card-primary">

            <div class="card-header box-shdw">

              <h3 class="card-title" id="items_title">Items</h3>



              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons">

                <!-- <button type="button" class="btn btn-default"><i class="fas fa-plus"></i> Add </button> -->

              <a href="<?php echo base_url(); ?>order">  <button type="button" class="btn btn-default"><i class="fas fa-clipboard-list"></i>KOT/BOT List</button></a>

                <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#codegeneration_modal" id="codegenbtn"><i class="fas fa-cog"></i> Generate Code</button> -->

              </div>

            </div>



            <div class="card-body">



                <!-- ---------------------------- -->



   <!--          <div class="container mt-3">

  <h2>Filterable List</h2>

  <p>Type something in the input field to search the list for specific items:</p>  

  <input class="form-control" id="myInput" type="text" placeholder="Search..">

  <br>

  <div class="list-group myList" >

    <div class="list-group-item s">First item </div>

    <div class="list-group-item s">Second item</div>

    <div class="list-group-item s">Third item</div>

    <div class="list-group-item s">Fourth</div>

  </div> 



   <div class="list-group myList" >

    <div class="list-group-item s">ten item </div>

    <div class="list-group-item s">tw item</div>

    <div class="list-group-item s">Thirxxd item</div>

    <div class="list-group-item s">Fourth</div>

  </div>  

</div> -->



            <!-- ---------------------------- -->

                <div class="formblock-box">

                    <!-- <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Items Info</h3> -->

                    <div class="itemsearchabr">

                        <div class="input-group add-on">

                            <input class="form-control no-border h25" placeholder="Search Items" name="srch-term" id="srch-term" type="text">

                            <div class="input-group-btn">

                                <button class="btn btn-default btn-sm" type="submit"><i class="fas fa-search"></i></button>

                            </div>

                        </div>

                    </div>

                    <div class="filtergroup">

                        <div class="d-flex justify-content-center flex-filter-alphabet">



                         <div class="p-2 letter " id="letterblock_0">

                                    <span>ALL</span>

                            </div>

                        <?php 

                            $class="";

                            for($letter=1;$letter<=26;$letter++){ 

                              /*  if(chr(64+$letter)=="M") {

                                    $class="active";

                                }

                                else {

                                    $class="";

                                } */

                                ?>

                            <div class="p-2 letter <?php echo $class; ?>" id="letterblock_<?php echo $letter?>" >

                                    <span><?php echo chr(64+$letter);?></span>

                            </div>

                        <?php

                            }

                        ?>

                        </div>

                    </div>



                <div style="text-align: center;display:none;margin-top: 25%;" id="loader">

                   <img src="<?php echo base_url(); ?>assets/img/loader_bar.gif" width="110" height="100" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>

                  <!--  <span style="color: #bb6265;">Loading...</span> -->

               </div>



                    <div class="itemblocks customscrollbar" id="itemlist_details">

                       

                    </div> <!-- End of Item Block -->

                </div>

            </div>



        </div>

        

    </div><!-- End of Left Order Panel -->





    <div class="right-order-panel ordersummery-panel">

        <div class="card card-primary">

            <div class="card-header box-shdw">

              <div data-toggle="modal" data-target="#orderSummeryModal" id="orderSumeryBtn">

              <h3 class="card-title">Order Summary</h3> <h2 class="card-title" id="noofitem">Selected Items:<span id="itemtotalcount"></span></h2>

              </div>



              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons">

                <!-- <button type="button" class="btn btn-default"><i class="fas fa-plus"></i> Add </button> -->

                <!-- <button type="button" class="btn btn-default"><i class="fas fa-clipboard-list"></i>Order List</button> -->

                <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#codegeneration_modal" id="codegenbtn"><i class="fas fa-cog"></i> Generate Code</button> -->

              </div>

            </div>



            <div class="card-body">



        <div class="formblock-box">

                  

                    <div class="orderedlist customscrollbar" id="detail_orderitem">

                    <div id="blank_order_summery">

                         <img src="<?php echo base_url(); ?>assets/img/bar_res_blur2.jpg"  width="400" height="500">

                        <h3 class="order_sumh3">Order Details will appear here</h3>

                    </div>

                         

                        <?php

                            $rowno=0;



                            if ($bodycontent['orderDetailsData']) {



                                foreach ($bodycontent['orderDetailsData'] as $detailsrowdata) {

                                  

                               

                        ?>

                             

                        <!-- -------------------------------- start of order details edit data ------------------------- -->



                               <div class="row selected-item" id="rowOrderDtl_<?php echo $rowno;?>">

                                    <div class="col-md-1 detail-row1 deletOrddtl" id="delDtlRow_<?php echo $rowno; ?>">

                                        <i class="fas fa-times delete"></i>

                                    </div>

                                    <div class="col-md-4 detail-row1">

                                          <?php echo $detailsrowdata->item_name; ?>

                                    </div>

                                    <div class="col-md-4 detail-row1">

                                        <div class="form-group">

                                            <div class="input-group input-group-sm">

                                                 <input type="text" name="manualkot[]" class="form-control bottom-border h25 manualkot" placeholder="Manual KOT" value="<?php echo $detailsrowdata->menual_kot; ?>" id="mankotRow_<?php echo $rowno; ?>"  />

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

                                                <input type="text" name="quantity[]" class="form-control input-number h25 text-center no-border qty-input" value="<?php echo $detailsrowdata->quantity; ?>" readonly  id="itemQuantity_<?php echo $rowno; ?>">

                                                <span class="input-group-btn">

                                                    <button type="button" class="btn btn-default btn-sm btn-number qty-btn btn-plus"  id="btnplus_<?php echo $rowno; ?>">

                                                        <i class="fas fa-plus"></i>

                                                    </button>

                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                         <?php 



                                         if ($detailsrowdata->is_free=='N') {

                                         

                                            $cgstamt=($detailsrowdata->item_rate*$detailsrowdata->cgst_rate)/100;

                                            $sgstamt=($detailsrowdata->item_rate*$detailsrowdata->sgst_rate)/100;

                                            $toalgst=($cgstamt+$sgstamt);

                                            $totalamount=($detailsrowdata->item_rate+$toalgst);

                                        }else{

                                            $totalamount=0;

                                            $cgstamt=0;

                                            $toalgst=0;

                                            $totalamount=0;

                                        }

                                    ?>

                                    <div class="col-md-3 detail-row2">

                                        Rate : <i class="fas fa-rupee-sign"></i>  

                                        <span id="showrowrate_<?php echo $rowno; ?>"><?php if ($detailsrowdata->is_free=='N') { echo $detailsrowdata->item_rate; }else{echo "0";}?></span>

                                    </div>

                                    <div class="col-md-3 detail-row2">

                                       CGST : <span id="showrowcgstrate_<?php echo $rowno; ?>" ><?php if ($detailsrowdata->is_free=='N') {echo $detailsrowdata->cgst_rate."%";}else{echo "0%";} ?></span>

                                    </div>

                                    <div class="col-md-3 detail-row2">

                                        SGST :<span id="showrowsgstrate_<?php echo $rowno; ?>"><?php if ($detailsrowdata->is_free=='N') {echo $detailsrowdata->sgst_rate."%";}else{echo "0%";} ?></span> 

                                    </div>

                                    <div class="col-md-3 detail-row2">

                               



                                      <input class="orderitemid" type="hidden" name="oitemid[]" id="oitemid_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->item_mst_id; ?>">  

                                      <input type="hidden" name="ocgstid[]" id="ocgstid_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->cgst_id;?>">  

                                      <input type="hidden" name="ocgstrate[]" id="ocgstrate_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->cgst_rate;?>">  

                                      <input type="hidden" name="osgstid[]" id="osgstid_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->sgst_id;?>">  

                                      <input type="hidden" name="osgstrate[]" id="osgstrate_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->sgst_rate;?>">  



                                         <input type="hidden" name="itemrate[]" id="itemrate_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->item_rate;?>"> 

                                    

                                      <input type="hidden" name="rowamount[]" id="rowamount_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->taxable;?>">  

                                      <input type="hidden" name="rowtotalcgst[]" id="rowtotalcgst_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->cgst_amount;?>">  

                                      <input type="hidden" name="rowtotalsgst[]" id="rowtotalsgst_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->sgst_amount;?>">  

                                      <input type="hidden" name="rowtotalamount[]" id="rowtotalamount_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->total_amount;?>">  







                                        Total : <i class="fas fa-rupee-sign"></i><span id="showrowtotal_<?php echo $rowno; ?>"> <?php echo $totalamount;?> </span>

                                    </div>

                                   

                                   <input type="hidden" name="isFree[]" id="isFree_<?php echo $rowno; ?>" value="<?php echo $detailsrowdata->is_free;?>">



                                    <div class="freelebel">

                                    <label  for="freeCheck_<?php echo $rowno; ?>" id="freeChecklb">Free&nbsp;</label>

                                   <input type="checkbox" id="freeCheck_<?php echo $rowno; ?>"  class="freecheckbox" <?php if ($detailsrowdata->is_free=='Y') {echo "checked";}?>>



                                   </div>



                        

                                </div>









                        <!-- -------------------------------- end of order details edit data ------------------------- -->

                             

                        <?php    $rowno++;   } 

                                 }

                                    ?>



                    </div> <!-- End of Item Block -->

                       <input type="hidden" name="rowno" id="rowno" value="<?php echo $rowno;?>">  

                    <div class="ordered-total">

                        

                        <ul class="list-group">

                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                Item Total

                                <span class="" id="sp_itemtotal"><?php 

                                    if($bodycontent['mode'] == 'EDIT'){

                                          echo $bodycontent['orderEditdata']->item_total; 

                                        }else{

                                          echo "-";

                                        }

                                ?></span>

                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                Total CGST 

                                <span class="" id="sp_totalcgst">

                                <?php 

                                    if($bodycontent['mode'] == 'EDIT'){

                                          echo $bodycontent['orderEditdata']->total_cgst; 

                                        }else{

                                          echo "-";

                                        }

                                ?>  

                                </span>

                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">

                               Total SGST

                                <span class="" id="sp_totalsgst"><?php 

                                    if($bodycontent['mode'] == 'EDIT'){

                                          echo $bodycontent['orderEditdata']->total_sgst; 

                                        }else{

                                          echo "-";

                                        }

                                ?> </span>

                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">

                               Total Amount to be paid

                                <span class="" id="sp_totaltobepaid"><?php 

                                    if($bodycontent['mode'] == 'EDIT'){

                                          echo $bodycontent['orderEditdata']->total_to_be_paid; 

                                        }else{

                                          echo "-";

                                        }

                                ?></span>

                            </li>

                        </ul>

                    </div>



                     <input type="hidden" name="itemtotalsum" id="itemtotalsum" value="<?php 

                                    if($bodycontent['mode'] == 'EDIT'){

                                          echo $bodycontent['orderEditdata']->item_total; 

                                        }else{

                                          echo "0";

                                        }

                                ?>">  

                     <input type="hidden" name="totalcgstsum" id="totalcgstsum" value=" <?php 

                                    if($bodycontent['mode'] == 'EDIT'){

                                          echo $bodycontent['orderEditdata']->total_cgst; 

                                        }else{

                                          echo "0";

                                        }

                                ?> ">  

                     <input type="hidden" name="totalsgstsum" id="totalsgstsum" value="<?php 

                                    if($bodycontent['mode'] == 'EDIT'){

                                          echo $bodycontent['orderEditdata']->total_sgst; 

                                        }else{

                                          echo "0";

                                        }

                                ?>">  

                     <input type="hidden" name="totaltobepaid" id="totaltobepaid" value="<?php 

                                    if($bodycontent['mode'] == 'EDIT'){

                                          echo $bodycontent['orderEditdata']->total_to_be_paid; 

                                        }else{

                                          echo "0";

                                        }

                                ?>">  



                    <div class="order-placed">

                        <div class="row">

                            <div class="col-md-8 text-left">

                                 <p id="response_msg" class="error" style="color: #42cb16;"></p>

                            </div>

                            <div class="col-md-4 text-right">

                              <!--   <button class="btn btn-sm action-button">Save <i class="fas fa-arrow-right"></i></button> -->

                              

                                 <button type="submit" class="btn btn-sm action-button" id="odersavebtn"><?php echo $bodycontent['btnText']; ?><i class="fas fa-arrow-right"></i></button>

                                  <span class="btn btn-sm action-button formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>

                            </div>

                        </div>

                    </div>



                </div>

        </div>



        </div>

        

    </div><!-- End of Right Order Panel -->





    <div class="last-entry-view">



        <div class="card card-primary">

            



            <div class="card-body">

                <div class="member-info formblock-box">

                    <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Last Entry</h3>



                    <div class="row">

                        <div class="col-md-2">

                            <div class="form-group">

                                <div class="input-group input-group-sm">

                                <div class="input-group-prepend">

                              <span class="input-group-text" id="hist_edit">



                  <a href="<?php echo base_url(); ?>order/addOrder/<?php echo $bodycontent['lastOrder']->order_id;?>" id="hist_edit_link">

                      <i class="fas fa-edit"></i> 

                  </a> 



                    </span>

                            </div>

                                    <input type="text" class="form-control" id="orederpn_kotnumber" placeholder="KOT No" value="<?php echo $bodycontent['lastOrder']->order_no;?>" readonly >

                                </div>

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <div class="input-group input-group-sm">

                                    <input type="text" class="form-control" id="orederpn_kotdt" placeholder="KOT Date" value="<?php echo date("d/m/Y", strtotime($bodycontent['lastOrder']->order_date));?>" readonly >

                                </div>

                            </div>

                        </div>

                        <div class="col-md-1">

                            <div class="form-group">

                                <div class="input-group input-group-sm">

                                    <input type="text" class="form-control" id="orederpn_member_code" placeholder="Enter Member Code" readonly value="<?php echo $bodycontent['lastOrder']->member_code;?>" />

                                </div>

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <div class="input-group input-group-sm">

                                    <input type="text" class="form-control" id="orederpn_member" placeholder="Member Name" readonly value="<?php echo $bodycontent['lastOrder']->title_one." ".$bodycontent['lastOrder']->member_name;?>">

                                </div>

                            </div>

                        </div>



                          <div class="col-md-1">

                            <div class="form-group">

                                <div class="input-group input-group-sm">

                                    <input type="text" class="form-control" id="orederpn_price" readonly value="<?php echo $bodycontent['lastOrder']->total_to_be_paid;?>" />

                                </div>

                            </div>

                        </div>

                        

                    

                       

                        <div class="col-md-2">

                            <!-- <label for="category">Category</label> -->

                            <div class="form-group">

                              <div class="input-group input-group-sm">

                                    <select class="form-control select2" id="category_view" name="category_view" style="width: 100%;">

                                    

                                      <option value="CAT">CANTEEN</option>

                                      <option value="BAR">BAR</option>

                                    </select>

                              </div>

                            </div>

                        </div>

                        

                        <div class="col-md-2 text-center">

                          <input type="hidden" name="orderhistoryid" id="orderhistoryid" value="<?php echo $bodycontent['lastOrder']->order_id;?>">



                            <button class="btn btn-sm action-button previousorder"><i class="fas fa-arrow-left"></i></button>

                            <button class="btn btn-sm action-button nextorder"><i class="fas fa-arrow-right"></i></button>

                        </div>

                       

                    </div>



                </div>

            </div>



        </div>



    </div> <!-- End of last-entry-view -->





</div><!-- End of order-view-panel ---->





</form>







    <div class="modal fade" id="orderaftersavemodel" data-backdrop="static" data-keyboard="false">

        <div class="modal-dialog modal-xs" style="width: 300px;margin-top: 260px;">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="frm_header"> Saved Succesfully <span class="kotmodalspan">( For Print Click Yes )</span> </h5>            

            

              

            </div>

             

           <!--  <div class="modal-body" style="font-size: 12px;">

            

             

          </div> -->

          

           <div class="modal-footer">

          

           <button type="button" class="btn btn-block btn-danger btn-xs kotprintbtn" data-dismiss="modal" aria-label="Close" id="printbtn">Yes</button>

               <button type="button" class="btn btn-block btn-danger btn-xs" data-dismiss="modal" aria-label="Close" id="close_btn_ordersave">Close</button>

           </div>

          <!-- /.modal-content -->

        </div>

        <!-- /.modal-dialog -->

      </div>

      <!-- /.modal -->

      </div>















