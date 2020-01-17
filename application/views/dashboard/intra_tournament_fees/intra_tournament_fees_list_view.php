<script src="<?php echo base_url(); ?>assets/js/customJs/master/intra_tournament_fees.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Intra Tournament Fess List</h3>
               <a href="<?php echo base_url(); ?>intratournament/addFees" class="">
              <button class="btn btn-info btnpos">ADD</button></a> 
             
              
            </div><!-- /.card-header -->

            <div class="card-body">


              <table id="tournamentList" class="table table-bordered table-hover  tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Student Code</th>
                    <th>Student Name</th>
                    <th>Billing Style</th>
                    
                  
                    <th>Fees Amt.</th>
                   
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['StudentList'] as $studentlist) { 

                  
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $studentlist->student_code; ?></td>
                   <td><?php echo $studentlist->student_name; ?></td>
                   <td><?php 
                                if ($studentlist->billing_style=='M') {
                                     echo "Monthly";
                                }else if($studentlist->billing_style=='Q'){
                                     echo "Quarterly";
                                }
                              

                                ?></td>
                 
                
                 
                   <td><?php echo $studentlist->fees; ?></td>

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
                          
                         
                           </tr>
                           </tfoot> 
              </table>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->
