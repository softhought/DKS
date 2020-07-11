<<!DOCTYPE html>
<html>
<head>
  <title>Bill Generation List </title>
  <style type="text/css">
  .demo {
    #border:1px solid #C0C0C0;
    border-collapse:collapse;
    padding:5px;
    width:100%;
    margin-top: 20px;
    }
    .demo th {
    #border:1px solid #C0C0C0;
    padding:4px;
    background:#F0F0F0;
    font-family:Verdana, Geneva, sans-serif;
    font-size:12px;
    font-weight:bold;
   }
   .demo td {
    #border:1px solid #C0C0C0;
    padding:6px;
    font-family:Verdana, Geneva, sans-serif;
    font-size:12px;   
    
    }
    .table_head{
            height:45px;
            border:none;
    }
   .break{
            page-break-after: always;
    }


  </style>
</head>
<body>




   <table width="100%">
               <tr>
                   <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold;">
                            DAKSHIN KALIKATA SANSAD <br/>
                           
                        </span>
                          <span style="font-family:Verdana, Geneva, sans-serif; font-size:10px;">
                          93/1B, Rashbehari Avenue, Kolkata - 700029 <br/>
                              PHONE--2464 4933, 2465 4950
                              </span>
                    </td>
                </tr>
                <tr>
                <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            TENNIS COACHING BILL LIST
                           
                        </span></td>
                  
                </tr>

                <tr>
                   <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            <?php echo $billDateRange;?>
                           
                        </span>
                      </td> 
                     <!--  <td align="right">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            Print Date:<?php echo date('d/m/Y');?>
                           
                        </span></td> -->
                </tr>
        </table>


           




 

                  <table class="demo" border="2">
               <thead>

                    <tr>
                    <th>Sl.No&emsp;&emsp;</th>
                    <th>Student Name</th>
                    <th>Student Code</th>
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

                <?php 
                $totalbillAmt=0;
                $totalpaidAmt=0;
                $totaladjustmentAmt=0;
                $totaloutstandingAmt=0;
              
                $i = 1;
                $row=1;
                $rowCount=0;
                $paymentmode="";
                $grandTotal=0;

                $openTotal=0;
                $subTotal=0;
                $hardTotal=0;
                $correctionTotal=0;
                $intraTotal=0;
                $rowSumTotal=0;
                foreach ($genbilllist as $genbilllist) { 
                   $rowCount++;

                        $openTotal+=$genbilllist->opening_bal;
                        $subTotal+=$genbilllist->subscription_fee;
                        $hardTotal+=$genbilllist->hard_cout_fee;
                        $correctionTotal+=$genbilllist->correction;
                        $intraTotal+=$genbilllist->intra_tournament_fee;
                        $rowSumTotal+=$genbilllist->total_amount;
                 
                       
                  
                  ?>

                    <tr>
                     <td><?php echo $i++; ?></td>
                     <td><?php echo $genbilllist->title_one.' '.$genbilllist->student_name; ?></td>
                     <td><?php echo $genbilllist->student_code; ?></td>
                     <td><?php echo $genbilllist->short_name; ?></td>       
                     <td><?php echo $genbilllist->quarter; ?></td>       
                     <td><?php
                              if($genbilllist->billing_date != ''){
                                 echo date('d-m-Y',strtotime($genbilllist->billing_date)); 
                                }

                               ?>
                                  
                      </td>
                     <td align="right"><?php
                              if($genbilllist->opening_bal > 0){
                               echo $genbilllist->opening_bal;
                              }  
                               ?></td>

                     <td align="right"><?php 

                              if( $genbilllist->subscription_fee > 0){
                                echo $genbilllist->subscription_fee;
                              }
                              ?></td>

                     <td align="right"><?php 

                               if($genbilllist->hard_cout_fee > 0){
                                echo $genbilllist->hard_cout_fee;
                               }

                               ?></td>

                     <td align="right"><?php 
                               if($genbilllist->correction > 0){
                               echo $genbilllist->correction;
                               }
                               ?></td>
                     <td align="right"><?php 
                              if($genbilllist->intra_tournament_fee > 0){
                                echo $genbilllist->intra_tournament_fee;
                              }
                               ?></td>
               
                     <td align="right"><?php  if($genbilllist->total_amount > 0){
                                    echo $genbilllist->total_amount;
                               }   ?></td>

                 

                   </tr>

                <?php 

                if ($rowCount==20) {   $rowCount=0;?>

                </tbody>
              </table>
           
                <div class="break"></div>

   <table width="100%">
               <tr>
                   <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold;">
                            DAKSHIN KALIKATA SANSAD <br/>
                           
                        </span>
                          <span style="font-family:Verdana, Geneva, sans-serif; font-size:10px;">
                          93/1B, Rashbehari Avenue, Kolkata - 700029 <br/>
                              PHONE--2464 4933, 2465 4950
                              </span>
                    </td>
                </tr>
                   <tr>
                <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            TENNIS COACHING BILL LIST
                           
                        </span></td>
                  
                </tr>

                <tr>
                  <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            <?php echo $billDateRange;?>
                           
                        </span>
                      </td>
                  <!--  <td align="right">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            Print Date:<?php echo date('d/m/Y');?>
                           
                        </span></td> -->
                </tr>
                </table>


               
                <table class="demo" width="100%;" >
                <thead>
                    <tr>
                    <th>Sl.No&emsp;&emsp;</th>
                    <th>Student Name</th>
                    <th>Student Code</th>
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


                  <?php $rowCount=1; ?>

                

                <?php
                }

                $row++;


                 ?>

               

               <?php  } ?> 

                   <tr style="background:#F0F0F0;">
                       
                  <td></td>
                  <td colspan="5" style="font-weight: bold;">Total </td>
                  <td style="font-weight: bold;" align="right"><?php if($openTotal!=0){ echo number_format($openTotal,2);}?></td>
                  <td style="font-weight: bold;" align="right"><?php if($subTotal!=0){ echo number_format($subTotal,2);}?></td>
                  <td style="font-weight: bold;" align="right"><?php if($hardTotal!=0){ echo number_format($hardTotal,2);}?></td>
                  <td style="font-weight: bold;" align="right"><?php if($correctionTotal!=0){ echo number_format($correctionTotal,2);}?></td>
                  <td style="font-weight: bold;" align="right"><?php if($intraTotal!=0){ echo number_format($intraTotal,2);}?></td>
                  <td style="font-weight: bold;" align="right"><?php if($rowSumTotal!=0){ echo number_format($rowSumTotal,2);}?></td>
                  
                </tr>           
                         
                </tbody>
              </table>
           

        
  





</body>
</html>

