
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Hard Court</h3>
              <a href="<?php echo base_url(); ?>hardcourt/addhardcourt" class="">
              <button class="btn btn-info btnpos">ADD</button></a>
             
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <table class="table table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Transaction No.</th>
                    <th>Student Name</th>
                    <th>Transaction Date</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

              <?php $i=1;
                foreach ($bodycontent['hardcourtlist'] as $hardcourtlist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $hardcourtlist->tran_no; ?></td>
                   <td><?php echo $hardcourtlist->student_name; ?></td>
                   <td><?php 
                          if($hardcourtlist->tran_date != ''){
                             echo date('d-m-Y',strtotime($hardcourtlist->tran_date));
                          }
                   ?></td>
                   <td><?php echo $hardcourtlist->quntity; ?></td>
                   <td><?php echo $hardcourtlist->rate; ?></td>
                   <td><?php echo $hardcourtlist->amount; ?></td>
                   <td>
                     <a href="<?php echo base_url(); ?>hardcourt/addhardcourt/<?php echo $hardcourtlist->id; ?>" class="btn bg-gradient-info padbtn">
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