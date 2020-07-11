<table class="table customTbl table-bordered table-striped dataTable">

                <thead>

                    <tr>

                    <th>Sl No.&ensp;</th>

                    <th>Student Code</th>

                    <th>Student Name</th>

                    <th>Father's/Mother's Name</th>

                    <th>Contact</th>
                    <th>Billing Style</th>

                    <th>Action</th>

                                        

                    </tr>

                </thead>

                <tbody>



                <?php $i=1;

                foreach ($studentregisterdtl as $studentregisterdtl) { ?>

                   <tr>

                   <td><?php echo $i++; ?></td>

                   <td><?php echo $studentregisterdtl->student_code; ?></td>

                   <td><?php echo $studentregisterdtl->title_one.' '.$studentregisterdtl->student_name; ?></td>

                    <td><?php echo $studentregisterdtl->title_two.' '.$studentregisterdtl->guardian_name; ?></td>

                   <td><?php if($studentregisterdtl->phone_one != '' && $studentregisterdtl->phone_two != ''){



                     echo  $studentregisterdtl->phone_one.'/'.$studentregisterdtl->phone_two;

                     }else if($studentregisterdtl->phone_one != ''){



                          echo $studentregisterdtl->phone_one;

                     }



                     else{

                            echo $studentregisterdtl->phone_two;

                     } 

                     ?></td>
                   <td><?php 
                              if ($studentregisterdtl->bill_style=='M') {
                                    echo "Monthly";
                              }else{
                                    echo "Quarterly";
                              }

                    ?></td>
                   <td>

                     <a href="<?php echo base_url(); ?>Studentregister/addeditstudrestration/<?php echo $studentregisterdtl->admission_id; ?>" class="btn tbl-action-btn padbtn">

                   <i class="fas fa-edit"></i> 

                  </a>

                    

                  </td>





                 </tr>

                <?php } ?>                       

                         

                </tbody>

              </table>