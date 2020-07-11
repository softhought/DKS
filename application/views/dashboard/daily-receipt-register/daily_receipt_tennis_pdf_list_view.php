<<!DOCTYPE html>
<html>
<head>
  <title>Tennis daily Receipt</title>
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
                            TENNIS COACHING DAILY BALANCE LIST
                           
                        </span></td>
                  
                </tr>

                <tr>
                   <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            <?php echo $dailybalanceDate;?>
                           
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
                    <th align="left">Sl.No</th>
                    <th align="left" >Payment Mode</th>

                    
                    <th align="left"  >Code</th>
                    <th align="left"  >Name</th>
                    <th align="left"  >Payment Date</th>
                   <!--  <th align="left"  >Tran. Type</th> -->

                    <th align="right"  >Amount</th>
                    
          
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
                foreach ($tennisReceiptList as $tennisReceiptlist) { 
                   $rowCount++;
                   if ($tennisReceiptlist['masterData']->total_amount!='') {
                   $grandTotal+=$tennisReceiptlist['masterData']->total_amount;
                 }
                      foreach ($tennisReceiptlist['detailsData'] as $detailsData) {
                       
                  
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $detailsData->payment_mode; ?></td>
                   <td><?php echo $detailsData->student_code; ?></td>
                   <td><?php echo $detailsData->title_one." ".$detailsData->student_name; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($detailsData->payment_date)); ?></td>
                <!--    <td align="left"><?php 

                          if ($detailsData->transaction_type=='ORADM') {
                            echo "Other Receipts(Admission)";
                          }else if($detailsData->transaction_type=='ORITM'){
                            echo "Other Receipts(Item)";
                          }else if($detailsData->transaction_type=='RCFS'){
                             echo "Receivable From Student";
                          }

                    ?></td> -->
                   <td align="right"><?php echo $detailsData->payment_amount; ?></td>
          
                       
               
                   

                 </tr>
                <?php 

                if ($rowCount==32) {   $rowCount=0;?>

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
                            TENNIS COACHING DAILY BALANCE LIST
                           
                        </span></td>
                  
                </tr>

                <tr>
                  <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            <?php echo $dailybalanceDate;?>
                           
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
                    <th align="left">Sl.No</th>
                    <th align="left" >Payment Mode</th>
                    <th align="left">Code</th>
                    <th align="left">Name</th>
                    <th align="left">Payment Date</th>
                   <!--  <th align="left"  >Tran. Type</th> -->
                   <th align="right"  >Amount</th>
                    
                 
                   
          
                </thead>
                <tbody>


                  <?php $rowCount=1; ?>

                

                <?php
                }

                $row++;} ?>

                <tr>
                  <td></td>
                  <td colspan="4" style="font-weight: bold;">Total </td>
                  <td style="font-weight: bold;" align="right"><?php echo $tennisReceiptlist['masterData']->total_amount;?></td>
                  
                </tr>

               <?php  } ?> 

                   <tr style="background:#F0F0F0;">
                     <td></td>
                     <td colspan="4" style="font-weight: bold;"> Grand Total </td>
                  <td style="font-weight: bold;" align="right"><?php echo number_format($grandTotal,2);?></td>
                   </tr>           
                         
                </tbody>
              </table>
           

        
  





</body>
</html>

