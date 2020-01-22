<table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No&emsp;&emsp;</th>
                    <th>Student Name</th>
                    <th>Student Code</th>
                   <!--  <th>Billing Style</th> -->
                    <th>Month</th>
                    <th>Quarter</th>
                    <th>Billing Date</th>
                    <th>Openiing Bal</th>
                    <th>Subscription Fee</th>
                    <th>Hardcourt Fee</th>
                    <th>Correction</th>
                    <th>Intra Tournament Fee</th>
                    <th>Total Amount</th>
                                        
                    </tr>
                </thead>
                <tbody>

                  <?php  $i=1;$total=0;
                  foreach ($genbilllist as $genbilllist) { 

                     $total = $total + $genbilllist->total_amount;

                    ?>

                   <tr>
                     <td><?php echo $i++; ?></td>
                     <td><?php echo $genbilllist->title_one.' '.$genbilllist->student_name; ?></td>
                     <td><?php echo $genbilllist->student_code; ?></td>
                     <!-- <td><?php  if($genbilllist->billing_style == 'M'){

                               echo 'Monthly';

                             }else if($genbilllist->billing_style == 'Q'){

                               echo 'Quarterly';
                             } ?></td> -->
                    <td><?php echo $genbilllist->short_name; ?></td>       
                       <td><?php echo $genbilllist->quarter; ?></td>       
                     <td><?php
                              if($genbilllist->billing_date != ''){

                                  echo date('d-m-Y',strtotime($genbilllist->billing_date)); 
                                }

                                   ?>
                                    
                      </td>
                             
                     <td><?php

                              if($genbilllist->opening_bal > 0){

                                echo $genbilllist->opening_bal;
                              }  
                               ?></td>
                     <td><?php 
                              if( $genbilllist->subscription_fee > 0){
                                echo $genbilllist->subscription_fee;
                              }
                               ?></td>
                     <td><?php 
                               if($genbilllist->hard_cout_fee > 0){
                                echo $genbilllist->hard_cout_fee;
                               }
                               ?></td>
                     <td><?php 
                               if($genbilllist->correction > 0){

                                    echo $genbilllist->correction;
                               }
                               ?></td>
                     <td><?php 
                              if($genbilllist->intra_tournament_fee > 0){

                                echo $genbilllist->intra_tournament_fee;
                              }
                               ?></td>
                     
                     <td><?php  if($genbilllist->total_amount > 0){

                                    echo $genbilllist->total_amount;
                               }   ?></td>
                     
                   </tr>


                    
                 <?php   } ?>

                                   
                         
                </tbody>
              </table>
              <input type="hidden" name="partial_total_amt" id="partial_total_amt" value="<?php echo number_format($total,2);?>">