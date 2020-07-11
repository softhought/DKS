<script src="<?php echo base_url(); ?>assets/js/customJs/bill/member_bill_generate.js"></script>
<style type="text/css">
  .table td, .table th {
    padding: .01rem;
    
}
</style>

  <section class="layout-box-content-format1">
        <div class="card card-primary">
            
            <div class="list-summary">
              <div class="row summary-box-container">

                <div class="col-md-9  bg-3">
                
                </div>
                <div class="col-md-3 summary-box bg-4">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3>Total Amount</h3>
                      <h4><span  id="total_amount_value"></span></h4>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>


            <div class="card-header box-shdw">
              <h3 class="card-title">MEMBER BILL Register</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>memberbillgenerate/addBill" class="btn btn-info btnpos">
                  <i class="fas fa-plus"></i> Add </a>
                </div>
      
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
               <div class="row box">

                    <label for="student" class="col-md-1">Category</label>

                      <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                     <select class="form-control select2" name="category" id="category" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['catogaryList'] as $categorylist) { ?>

                              <option value="<?php echo $categorylist->cat_id; ?>"
                                >
                                <?php echo $categorylist->category_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                          </div>
                        </div>
                        <p id="studenterr" ></p>
                    </div>
                 
                 

                    <label for="student" class="col-sm-1">Member Code</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                        <select class="form-control select2" name="sel_member" id="sel_member"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($bodycontent['memberList'] as $memberlist) {
                              ?>
                              <option value="<?php echo $memberlist->member_id;?>"><?php echo $memberlist->member_code?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <p id="studenterr" ></p>
                    </div>

                    <label for="student" class="col-sm-1">Month</label>

                           <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                     <select class="form-control select2" name="month" id="month" >
                             <!--  <option value="">Select</option> -->
                              <?php foreach ($bodycontent['monthList'] as $key => $value) { ?>
                              <option value="<?php echo $value->id; ?>"
                                >
                                <?php echo $value->short_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                          </div>
                        </div>
                        <p id="studenterr" ></p>
                    </div>

               




                <div class="col-md-1">
                 <button type="button" class="btn btn-block action-button btn-sm" id="memberbillshowbtn">Show</button>

                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
               <div class="col-md-1">
                 <button type="button" class="btn btn-block action-button btn-sm" id="multiplebillprint">Print</button>

                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="memberbill_list_data">
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Bill No.</th>
                    <th>Bill dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Month</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Action</th>
                  
          
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['billList'] as $billlist) { 
                  if ($billlist->net_amount!='') {
                   $total+=$billlist->net_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $billlist->member_bill_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($billlist->bill_date)); ?></td>
                   <td><?php echo $billlist->member_code; ?></td>
                   <td><?php echo $billlist->member_name; ?></td>
                   <td><?php echo $billlist->month_name; ?></td>
                   <td><?php echo $billlist->category_name; ?></td>
                   <td align="right"><?php echo $billlist->net_amount; ?></td>
                   <td> <span  class="btn tbl-action-btn btn-xs receivableDtl" data-toggle="modal" data-target="#billModalDetails" id="bill_dtl_btn"
                    data-billid="<?php echo $billlist->bill_id; ?>" style="padding-right:7px;"  ><i class="fas fa-cog"></i> </span>
                    
                    <a href="<?php echo base_url(); ?>memberbillgenerate/memberbillprintJasper/<?php echo $billlist->bill_id; ?>" target="_blank" class="btn tbl-action-btn padbtn" style="padding-right:7px;">
                      <i class="fas fa-print"></i> 
                    </a>
                    
                    </td>
                   
                  

               
                
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>



    <div id="billModalDetails" class="modal fade customModal format1 right"  data-keyboard="false" data-backdrop="false">
  <div class="modal-dialog modal-xs" style="width: 350px;margin-top: 90px;">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, #A60711 0%,#4E3FFB 100%);background-color: rgba(0, 0, 0, 0);
padding: 5px;color: #fff;">
       <h4 class="frm_header">Bill Details</h4>
        <button type="button" class="close" data-dismiss="modal"  >&times;<span class="sr-only">Close</span></button>
       
      </div>
      <div class="modal-body" style="height: 450px;
    overflow-y: auto;">
        <div id="bill_details_data"></div>
      </div>
    </div>
  </div>
</div>
