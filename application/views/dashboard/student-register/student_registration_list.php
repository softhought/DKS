
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Student Registration</h3>
                           
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <table class="table table-bordered table-hover dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Student Code</th>
                    <th>Student Name</th>
                    <th>Father's/Mother's Name</th>
                    <th>Contact</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['studentregisterdtl'] as $studentregisterdtl) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $studentregisterdtl->student_code; ?></td>
                   <td><?php echo $studentregisterdtl->title_one.''.$studentregisterdtl->student_name; ?></td>
                    <td><?php echo $studentregisterdtl->title_two.''.$studentregisterdtl->guardian_name; ?></td>
                   <td><?php if($studentregisterdtl->phone_one != '' && $studentregisterdtl->phone_two != ''){

                     echo  $studentregisterdtl->phone_one.'/'.$studentregisterdtl->phone_two;
                     }else if($studentregisterdtl->phone_one != ''){

                          echo $studentregisterdtl->phone_one;
                     }

                     else{
                            echo $studentregisterdtl->phone_two;
                     } 
                     ?></td>
                   <td>
                     <a href="<?php echo base_url(); ?>Studentregister/addeditstudrestration/<?php echo $studentregisterdtl->admission_id; ?>" class="btn bg-gradient-info padbtn">
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