   <?php if($fixedhrdcourtList){?>


    <span class="badge badge-info">Other Member's Booking Details</span>
               <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Tran no</th>
                    <th>Tran dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Day</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Time</th>
                    <th>Court No</th>
              
                  
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($fixedhrdcourtList as $fixhrdcourtlist) { 
               
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $fixhrdcourtlist->tran_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($fixhrdcourtlist->tran_dt)); ?></td>
                   <td><?php echo $fixhrdcourtlist->member_code; ?></td>
                   <td><?php echo $fixhrdcourtlist->member_name; ?></td>
                   <td><?php echo $fixhrdcourtlist->day_name; ?></td>
                   <td ><?php echo $fixhrdcourtlist->day_night; ?></td>
                   <td ><?php echo $fixhrdcourtlist->single_double; ?></td>
                   <td ><?php echo date('h:i A', strtotime($fixhrdcourtlist->from_time))." - ".date('h:i A', strtotime($fixhrdcourtlist->to_time));?></td>
                   <td ><?php echo $fixhrdcourtlist->court_no; ?></td>
                  
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>

            <?php } ?>
             
            