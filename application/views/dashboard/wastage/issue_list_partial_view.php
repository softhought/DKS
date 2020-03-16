        <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Issue No</th>
                    <th>issue Dt.</th>
                    <th>Department</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($issueList as $issuelist) { 
               
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $issuelist->issue_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($issuelist->issue_date)); ?></td>
                   <td><?php echo $issuelist->department_name; ?></td>
                   <td>
                         <a href="<?php echo base_url(); ?>issue/addIssue/<?php echo $issuelist->issue_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                  
                        
                    </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>