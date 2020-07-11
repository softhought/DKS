<script src="<?php echo base_url(); ?>assets/js/customJs/grn/grn.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">
            

            <div class="card-header box-shdw">
              <h3 class="card-title">Discount List</h3>
               <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>goodsreceiptnote/addGrn" class="btn btn-info btnpos">
                  <i class="fas fa-plus"></i> Add </a> 
                </div> -->
      
       
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
           


              <div class="formblock-box">
               
              <div id="grn_list_data">
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Discount Rate</th>
                    <th>Narration</th>                   

                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['discountList'] as $discountList) { 
               
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $discountList->discount_rate; ?></td>
                 
                   <td><?php echo $discountList->narration; ?></td>              
                
                  
                   
                    <td>
                         <a href="<?php echo base_url(); ?>discount/addeditdiscount/<?php echo $discountList->id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                  
                        
                    </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
             
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>