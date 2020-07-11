<script src="<?php echo base_url(); ?>assets/js/customJs/member_facility/benvolent_fund.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">

          <div class="list-summary">
              <div class="row summary-box-container">

                <!-- <div class="col-md-3 summary-box bg-1">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3> - </h3>
                      <h4> - </h4>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 summary-box bg-2">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3> - </h3>
                      <h4> - </h4>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 summary-box bg-3">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3> - </h3>
                      <h4> - </h4>
                    </div>
                  </div>
                </div> -->
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
              <h3 class="card-title">Benvolent Fund - List</h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>benvolentfund/addBenvolentFund" class="btn btn-info btnpos">
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
                 <div class="col-md-3">
                   <div class="form-group">
                            <label for="month">Month</label>
                                <div class="input-group input-group-sm">
                                   <select class="form-control select2 searchdata" name="month_id" id="month_id" >
                                  <option value="">Select</option>
                                  <?php foreach ($bodycontent['allmembermonthlist'] as  $value) { ?>

                                  <option value="<?php echo $value->id; ?>" >
                                    <?php echo $value->short_name; ?></option>
                                   
                                  <?php } ?>
                                                               
                                </select>
                                </div>

                          </div>
                 </div>
               </div>

            <div id ="benvoalllist">
              <table id="benvolentfundList" class="table customTbl table-bordered table-hover  tablepad dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Category</th>
                    <th>Month</th>
                    <th>Amount</th>
                   
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;$total=0;
                foreach ($bodycontent['benvolentfundList'] as $benvolentfundlist) { 

                   if ($benvolentfundlist->total_amount!='') {
                   $total+=$benvolentfundlist->total_amount;
                  }
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $benvolentfundlist->member_code; ?></td>
                   <td><?php echo $benvolentfundlist->member_name; ?></td>
                   <td><?php echo $benvolentfundlist->category_name; ?></td>
                   <td><?php echo $benvolentfundlist->month_name; ?></td>
                  
                 
                
                 
                   <td align="right" ><?php echo $benvolentfundlist->total_amount; ?>
                     
                   </td>

                 </tr>
                <?php } ?>                       
                         
                </tbody>
                 <!-- <tfoot>
                           <tr>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                          
                         
                           </tr>
                           </tfoot> --> 
              </table>

               <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
             </div>
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>
