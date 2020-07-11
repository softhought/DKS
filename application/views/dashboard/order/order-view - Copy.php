<div class="order-view-panel layout-box-content-format1">


<div class="card card-primary">
            

            <div class="card-body">
                <div class="member-info formblock-box">
                    <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Member Info</h3>

                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="KOT No" readonly >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="KOT Date" readonly >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Enter Member Code" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Member Name" readonly>
                                </div>
                            </div>
                        </div>
                        
                    
                        <div class="col-md-2">
                            <!-- 
                            https://dribbble.com/shots/3730167-Foms-Best-Restaurant-Point-of-Sale-Systems    
                            <label for="category">Location</label> -->
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                    <select class="form-control select2" style="width: 100%;">
                                      <option value=''>Choose Location</option>
                                      <option value="1">Location 1</option>
                                    </select>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- <label for="category">Category</label> -->
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                                      <option value=''>Choose Category</option>
                                      <option value="1">Catg 1</option>
                                    </select>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- <label for="category">Waiter</label> -->
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                    <select class="form-control select2" style="width: 100%;">
                                      <option value=''>Choose Waiter</option>
                                      <option value="1">Waiter 1</option>
                                    </select>
                              </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>



    <div class="left-order-panel">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Items</h3>

              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons">
                <!-- <button type="button" class="btn btn-default"><i class="fas fa-plus"></i> Add </button> -->
                <button type="button" class="btn btn-default"><i class="fas fa-clipboard-list"></i>Order List</button>
                <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#codegeneration_modal" id="codegenbtn"><i class="fas fa-cog"></i> Generate Code</button> -->
              </div>
            </div>

            <div class="card-body">
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

                       
                        <?php 
                            $class="";
                            for($letter=1;$letter<=26;$letter++){ 
                                if(chr(64+$letter)=="M") {
                                    $class="active";
                                }
                                else {
                                    $class="";
                                }
                                ?>
                            <div class="p-2 letter <?php echo $class; ?>" >
                                    <span><?php echo chr(64+$letter);?></span>
                            </div>
                        <?php
                            }
                        ?>
                        </div>
                    </div>

                    <div class="itemblocks customscrollbar">
                        <div class="row">

                            <?php 
                                $img1 = "";
                                $img2 = "";
                                $class="";
                                for($i=0;$i<36;$i++) {
                                    if($i%2 == 0) { ?>
                                        <div class="col-md-3 item-box evenbox">
                                            <img src="<?php echo base_url(); ?>assets/img/food.png" alt=""  class="center-img"> 
                                            <h4 class="item-name">Food Name 1 </h4>
                                            <p class="item-price"><i class="fas fa-rupee-sign"></i> 250/-</p>
                                            <button class="btn btn-sm"><i class="fas fa-plus"></i> Add</button>
                                        </div>
                                    <?php
                                    }
                                    else { ?>
                                        <div class="col-md-3 item-box oddbox"> 
                                            <img src="<?php echo base_url(); ?>assets/img/food-and-restaurant.png" alt=""  class="center-img"> 
                                            <h4 class="item-name">Food Name 2 </h4>
                                            <p class="item-price"><i class="fas fa-rupee-sign"></i> 250/-</p>
                                            <button class="btn btn-sm"><i class="fas fa-plus"></i> Add</button>
                                        </div>
                                    <?php
                                    }
                                }
                            ?>
                            
                            
                        
                       
                        </div>
                    </div> <!-- End of Item Block -->
                </div>
            </div>

        </div>
        
    </div><!-- End of Left Order Panel -->
    <div class="right-order-panel ordersummery-panel">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Order Summary</h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons">
                <!-- <button type="button" class="btn btn-default"><i class="fas fa-plus"></i> Add </button> -->
                <!-- <button type="button" class="btn btn-default"><i class="fas fa-clipboard-list"></i>Order List</button> -->
                <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#codegeneration_modal" id="codegenbtn"><i class="fas fa-cog"></i> Generate Code</button> -->
              </div>
            </div>

            <div class="card-body">
        <div class="formblock-box">
                  
                    <div class="orderedlist customscrollbar">
                       

                            <?php 
                                for($k=0;$k<15;$k++) {
                            ?>
                          
                                <div class="row selected-item">
                                    <div class="col-md-1 detail-row1">
                                        <i class="fas fa-times delete"></i>
                                    </div>
                                    <div class="col-md-4 detail-row1">
                                         Chilly Chiken <?php echo $k; ?>
                                    </div>
                                    <div class="col-md-4 detail-row1">
                                        <div class="form-group">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control bottom-border h25 manualkot" placeholder="Manual KOT" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 detail-row1">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number qty-btn btn-minus" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="quant[1]" class="form-control input-number h25 text-center no-border qty-input" value="1" min="1" max="10">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-sm btn-number qty-btn btn-plus" data-type="plus" data-field="quant[1]">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 detail-row2">
                                        Rate : <i class="fas fa-rupee-sign"></i> 150 
                                    </div>
                                    <div class="col-md-3 detail-row2">
                                       CGST : 5%
                                    </div>
                                    <div class="col-md-3 detail-row2">
                                        SGST : 5%
                                    </div>
                                    <div class="col-md-3 detail-row2">
                                        Total : <i class="fas fa-rupee-sign"></i> 150 
                                    </div>
                                    <!-- <div class="remove-item">
                                        <i class="fas fa-trash"></i>
                                    </div> -->
                                   
                                </div>
                          
                            <?php } ?>
                      
                    </div> <!-- End of Item Block -->
                    <div class="ordered-total">
                        
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Item Total
                                <span class="">4000.00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total CGST 
                                <span class="">200.00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                               Total SGST
                                <span class="">200.00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                               Total Amount to be paid
                                <span class="">4400.00</span>
                            </li>
                        </ul>
                    </div>

                    <div class="order-placed">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-sm action-button">Save <i class="fas fa-arrow-right"></i></button>
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
                                    <input type="text" class="form-control" placeholder="KOT No"  >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="KOT Date"  >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Enter Member Code" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Member Name" readonly>
                                </div>
                            </div>
                        </div>
                        
                    
                       
                        <div class="col-md-2">
                            <!-- <label for="category">Category</label> -->
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                                      <option value=''>Choose Category</option>
                                      <option value="1">Catg 1</option>
                                    </select>
                              </div>
                            </div>
                        </div>

                        <div class="col-md-2 text-center">
                            <button class="btn btn-sm action-button">View <i class="fas fa-eye"></i></button>
                        </div>
                       
                    </div>

                </div>
            </div>

        </div>

    </div> <!-- End of last-entry-view -->


</div><!-- End of order-view-panel ---->


