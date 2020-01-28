<table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Transaction No.</th>
                    <th>Student Code</th>
                    <th>Student Name</th>
                    <th>Billing Style</th>
                    <th>Amount</th>
                    <th>Correction Date</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($correctiondtl as $correctiondtl) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $correctiondtl->tran_no; ?></td>
                   <td><?php echo $correctiondtl->student_code; ?></td>
                   <td><?php echo $correctiondtl->title_one.''.$correctiondtl->student_name; ?></td>
                   <td><?php 
                        if($correctiondtl->bill_style == 'M'){

                           echo 'Monthly';
                        }else if($correctiondtl->bill_style == 'Q'){
                         
                          echo 'Quarterly';

                        }
                      ?></td>
                   <td><?php echo $correctiondtl->amount; ?></td>
                    <td><?php 
                           if($correctiondtl->date_of_correction != ''){

                            echo date('d-m-Y',strtotime($correctiondtl->date_of_correction));
                           }
                        ?></td>
                   <td>
                     <a href="<?php echo base_url(); ?>correction/addeditcorrection/<?php echo $correctiondtl->id; ?>" class="btn btn-sm action-button padbtn">
                  <i class="fas fa-edit"></i> 
                   </a>
                  <!--  <a href="<?php echo base_url(); ?>correction/deletecorrection/<?php echo $correctiondtl->id; ?>" class="btn btn-sm action-button padbtn">
                  <i class="fas fa-trash"></i></a>  --> 
                  </td>


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>