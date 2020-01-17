<script src="<?php echo base_url(); ?>assets/js/customJs/tennisopening/tennisopening.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Student Tennis Opening</h3>
              <a href="<?php echo base_url(); ?>tennisopening" class="">
              <button class="btn btn-info btnpos">ADD</button></a>
             
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <table id="studtennisopening" class="table table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Student Code</th>
                    <th>Student Name</th>
                    <th>Month</th>
                    <th>Bill Style</th>
                    <th>Opening Balance</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['Alltennisopeninglist'] as $Alltennisopeninglist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $Alltennisopeninglist->studcode; ?></td>
                   <td><?php echo $Alltennisopeninglist->title_one.''.$Alltennisopeninglist->student_name; ?></td>
                   <td><?php 
                          if($Alltennisopeninglist->short_name != ''){

                           echo $Alltennisopeninglist->short_name;
                          }else{
                            echo $Alltennisopeninglist->quarter;
                          }
                    ?></td>
                   <td><?php if($Alltennisopeninglist->billing_style == "M"){

                       echo 'Monthly';
                       }else if($Alltennisopeninglist->billing_style == "Q"){

                       echo 'Quarterly';
                   } ?></td>
                   <td><?php echo $Alltennisopeninglist->opening_balance; ?>
                                        
                  </td>


                 </tr>
                <?php } ?>                       
                         
                </tbody>
                <tfoot>
                           <tr>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                          
                         
                           </tr>
                           </tfoot> 
              </table>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->