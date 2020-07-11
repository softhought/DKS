 <div class="row itemz">

                            <?php 
                                $img1 = "";
                                $img2 = "";
                                $class="";
                                $i=0;
                                $display_img="";
                                if ($itemlist) {
                                    
                              
                                foreach ($itemlist as $key => $itemlist) {
                                if ($itemlist->item_category=='BAR') {
                                   $display_img='bar.png';
                                }else{
                                    $display_img='food.png';
                                }
                             
                                    if($i%2 == 0) { 


                                        ?>
                                        <div class="col-md-3 item-box evenbox">
                                            <img src="<?php echo base_url(); ?>assets/img/<?php echo $display_img;?>" alt=""  class="center-img"> 
                                            <h4 class="item-name "><?php echo $itemlist->item_name;?> </h4>
                                            <p class="item-price"><i class="fas fa-rupee-sign"></i> <?php echo $itemlist->item_rate;?> /-</p>
                                            <button class="btn btn-sm addItem"
                                             data-itemid="<?php echo $itemlist->item_id;?>"
                                            ><i class="fas fa-plus"></i> Add</button>
                                        </div>
                                    <?php
                                    }
                                    else { ?>
                                        <div class="col-md-3 item-box oddbox"> 
                                            <img src="<?php echo base_url(); ?>assets/img/<?php echo $display_img;?>" alt=""  class="center-img"> 
                                            <h4 class="item-name"><?php echo $itemlist->item_name;?>  </h4>
                                            <p class="item-price"><i class="fas fa-rupee-sign"></i><?php echo $itemlist->item_rate;?>/-</p>
                                            <button class="btn btn-sm addItem"
                                             data-itemid="<?php echo $itemlist->item_id;?>"
                                            ><i class="fas fa-plus"></i> Add</button>
                                        </div>
                                    <?php
                                    }


                                        $i++;
                                }

                            }else{
                            ?>
                            <div style="text-align: center;margin-top:5%;margin-left: auto;margin-right: auto;">
                   <img src="<?php echo base_url(); ?>assets/img/empty-product.png" width="200" height="200" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                    <span style="color: #bb6265;display: block;">Sorry! No Item Found</span> 
               </div>
                            
                        
                       <?php } ?>
                        </div>