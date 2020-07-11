<table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No&emsp;&emsp;</th>
                    <th>Student Code</th>
                    <th>Student Name</th>
                    <th>Subscription</th>
                    <th>Admission Date</th>
                    <th>DOB</th>
                    <th>Age As On Date</th>
                    <th>Mobile No.</th>
                   
                                        
                    </tr>
                </thead>
                <tbody>

                  <?php  $i=1; $age = "";$total = 0;
                  foreach ($studstatuslist as $studstatuslist) { 

                    $total += $studstatuslist->subscription;
                    if($studstatuslist->student_dob != ""){
                      $bday = new DateTime($studstatuslist->student_dob); // Your date of birth
                      $today = new Datetime(date('Y-m-d'));
                      $diff = $today->diff($bday);
                      $age = $diff->y." years";                     
                      
                      }
                    
                    ?>

                   <tr>
                     <td><?php echo $i++; ?></td>
                     <td><?php echo $studstatuslist->student_code; ?></td>
                     <td><?php echo $studstatuslist->student_name; ?></td>                    
                    <td><?php echo $studstatuslist->subscription; ?></td>       
                       <td><?php  if($studstatuslist->admission_dt != ""){ echo date('d-m-Y',strtotime($studstatuslist->admission_dt)); } ?></td>       
                       <td><?php  if($studstatuslist->student_dob != ""){ echo date('d-m-Y',strtotime($studstatuslist->student_dob)); } ?></td>       
                       <td><?php echo $age; ?></td>       
                       <td><?php echo $studstatuslist->phone_one; if($studstatuslist->phone_two != ''){ echo " / ".$studstatuslist->phone_two; } ?></td>       
                     
                             
                     
                     
                   </tr>


                    
                 <?php   } ?>

                                   
                       <input type="hidden" name="total_sub" id="total_sub" value="<?php echo number_format($total,2);?>"> 
                </tbody>
              </table>
              
            