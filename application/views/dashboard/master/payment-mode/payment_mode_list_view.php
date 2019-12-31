
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Payment Mode</h3>
             <!--  <a href="<?php echo base_url(); ?>paymentmode/addpaymentmodedtl" class="">
              <button class="btn btn-info btnpos">ADD</button></a> -->
             
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <table class="table table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Payment Mode</th>
                    <th>Account Name</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['paymentmodelist'] as $paymentmodelist) { 

                  
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $paymentmodelist->payment_mode; ?></td>
                   <td><?php echo $paymentmodelist->account_name; ?></td>
                   
                   <td>
                   <a href="<?php echo base_url(); ?>paymentmode/addpaymentmodedtl/<?php echo $paymentmodelist->id; ?>" class="btn bg-gradient-info padbtn">
                  <i class="fas fa-edit"></i> 
                </a>
                  </td>


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->
