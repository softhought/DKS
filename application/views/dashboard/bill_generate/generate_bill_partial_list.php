<table class="table customTbl table-bordered table-striped dataTable">

                <thead>

                    <tr>

                    <th>Sl.No&emsp;&emsp;</th>

                    <th>Invoice No</th>
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
                    <th>Delete</th>

                                        

                    </tr>

                </thead>

                <tbody>



                  <?php  $i=1;$total=0;
                  $totalOpening=0;
                  $totalSubscription=0;
                  $totalTurnament=0;


                  foreach ($genbilllist as $genbilllist) { 



                     $total = $total + $genbilllist->total_amount;
                     $totalOpening+=$genbilllist->opening_bal;
                     $totalSubscription+=($genbilllist->subscription_fee-$genbilllist->discount_amt);;
                     $totalTurnament+=$genbilllist->intra_tournament_fee;



                    ?>



                   <tr>

                     <td><?php echo $i++; ?></td>
                     <td><?php echo $genbilllist->invoice_no; ?></td>
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

                             

                     <td align="right"><?php



                             



                                echo $genbilllist->opening_bal;

                            

                               ?></td>

                     <td align="right"><?php 

                             

                                 // echo $genbilllist->subscription_fee;
                              //  echo $genbilllist->discount_amt;

                            echo $subFees=($genbilllist->subscription_fee-$genbilllist->discount_amt);

                             

                               ?></td>

                     <td align="right"><?php 

                             

                                echo $genbilllist->hard_cout_fee;

                              

                               ?></td>

                     <td align="right"><?php 

                              



                                    echo $genbilllist->correction;

                             

                               ?></td>

                     <td align="right"><?php 

                             



                                echo $genbilllist->intra_tournament_fee;

                             

                               ?></td>

                     

                     <td align="right"><?php  if($genbilllist->total_amount > 0){



                                    echo $genbilllist->total_amount;

                               }   ?></td>

                  <td> <i class="fas fa-trash delBill" data-billid="<?php echo $genbilllist->bill_id; ?>"></i> </td>   

                   </tr>





                    

                 <?php   } ?>



                                   

                         

                </tbody>

              </table>

                 <input type="hidden" name="total_opening_amt" id="total_opening_amt" value="<?php echo number_format($totalOpening,2);?>">
              <input type="hidden" name="total_subscription_amt" id="total_subscription_amt" value="<?php echo number_format($totalSubscription,2);?>">
              <input type="hidden" name="total_turnament_amt" id="total_turnament_amt" value="<?php echo number_format($totalTurnament,2);?>">
              <input type="hidden" name="partial_total_amt" id="partial_total_amt" value="<?php echo number_format($total,2);?>">