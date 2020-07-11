<script src="<?php echo base_url(); ?>assets/js/customJs/member_facility/subscription.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">

           <div class="list-summary">
              <div class="row summary-box-container">

             
                 <div class="col-md-9"></div>
                <div class="col-md-3 summary-box bg-4">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3>Total Amount</h3>
                      <h4><span  id="total_amount_value"></span><i class="fa fa-inr" aria-hidden="true"></i></h4>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="card-header box-shdw">
              <h3 class="card-title">Member Subscription Fee - List</h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>membersubscription/addSubscription" class="btn btn-info btnpos">
              <i class="fas fa-plus"></i> Add </a>
                </div>
                           
              
            </div><!-- /.card-header -->

            <div class="card-body">

             <div class="formblock-box">

             <div class="row">

                 <div class="col-md-3">
                   <div class="form-group">
                            <label for="member_code">Member Code</label>
                                <div class="input-group input-group-sm">
                                   <select class="form-control select2 searchdata" name="member_code" id="member_code" >
                                  <option value="">Select</option>
                                  <?php foreach ($bodycontent['allmembercodelist'] as  $value) { ?>

                                  <option value="<?php echo $value->member_code; ?>" >
                                    <?php echo $value->member_code; ?></option>
                                   
                                  <?php } ?>
                                                               
                                </select>
                                </div>

                          </div>
                 </div>
                 <div class="col-md-3">
                   <div class="form-group">
                            <label for="category">Category</label>
                                <div class="input-group input-group-sm">
                                   <select class="form-control select2 searchdata" name="category" id="category" >
                                  <option value="">Select</option>
                                  <?php foreach ($bodycontent['allmembercatlist'] as  $value) { ?>

                                  <option value="<?php echo $value->cat_id; ?>" >
                                    <?php echo $value->category_name; ?></option>
                                   
                                  <?php } ?>
                                                               
                                </select>
                                </div>

                          </div>
                 </div>
              
               </div>

            <div id="subscriptionlist">
              <table  class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Category</th>
                  
                    
                  
                    <th>Amount</th>
                   
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;$total=0;
                foreach ($bodycontent['subscriptionList'] as $subscriptionlist) { 

                   if ($subscriptionlist->subscription_amount!='') {
                   $total+=$subscriptionlist->subscription_amount;
                  }
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $subscriptionlist->member_code; ?></td>
                   <td><?php echo $subscriptionlist->member_name; ?></td>
                   <td><?php echo $subscriptionlist->category_name; ?></td>
               
                  
                 
                
                 
                   <td align="right" ><?php echo number_format($subscriptionlist->subscription_amount,2); ?></td>

                 </tr>
                <?php } ?>                       
                         
                </tbody>
                <!--  <tfoot>
                           <tr>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                          
                         
                           </tr>
                           </tfoot>  -->
              </table>

               <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
               </div>
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>
