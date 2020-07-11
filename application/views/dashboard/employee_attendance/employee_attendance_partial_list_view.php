 <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Employee Name</th>                   
                    <th>Department</th>                   
                    <th>Designation</th>                   
                    <th>Month</th>                                        
                    <th>Days</th>                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($employeeList as $employeeList) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $employeeList->name; ?></td>                   
                   <td><?php echo $employeeList->dept_name; ?></td>                   
                   <td><?php echo $employeeList->designation_name; ?></td>                  
                   <td><?php echo $employeeList->month_name; ?></td>                  
                   <td><?php echo $employeeList->attendance_days; ?></td>                  
                   


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>