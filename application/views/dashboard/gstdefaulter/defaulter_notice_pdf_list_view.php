<<!DOCTYPE html>
<html>
<head>
  <title>Reminder</title>
  <style type="text/css">
  .demo {
    #border:1px solid #C0C0C0;
    border-collapse:collapse;
    padding:5px;
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
                            MEMBER OUTSTANDING LIST
                           
                        </span></td>
                  
                </tr>

                <tr>
                   <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                           billing Upto <?php echo $month.",".$yearmonth;?> - Payment Upto <?php echo $noticeDate;?> >= <?php echo $equal_above;?> Date:<?php echo date('d/m/Y');?>
                           
                        </span></td>
                </tr>
        </table>


           




 

                  <table class="demo" border="2"  style="width: 100% !important;">
                <thead>
                    <tr>
                    <th align="left">Sl.No</th>

                    <th  width="10%" align="left">Code</th>
                    <th width="30%" align="left">Name</th>
                    
                    <th align="right">Billing</th>
                    <th align="right">Paid</th>
                    <th align="right">Adj</th>
                    <th align="right">Due</th>
                    <th align="left">Mobile</th>
                   
          
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
                foreach ($billList as $billlist) { 
                   $rowCount++;
                        $totalbillAmt+=$billlist['billAmount'];
                        $totalpaidAmt+=$billlist['paidAmount'];
                        $totaladjustmentAmt+=$billlist['adjustmentAmount'];
                        $totaloutstandingAmt+=$billlist['outstandingAmount'];
                  
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $billlist['memberData']->member_code; ?></td>
                   <td><?php echo $billlist['memberData']->member_name; ?></td>
                
                   <td align="right"><?php echo $billlist['billAmount'];?></td>
                   <td align="right"><?php echo $billlist['paidAmount'];?></td>
                   <td align="right"><?php echo $billlist['adjustmentAmount'];?></td>
                   <td align="right"><?php echo number_format($billlist['outstandingAmount'],2);?></td>
                     <td><?php echo $billlist['memberData']->mobile; ?></td>
                       
               
                   

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
                            MEMBER OUTSTANDING LIST
                           
                        </span></td>
                  
                </tr>

                <tr>
                   <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                           billing Upto <?php echo $month.",".$yearmonth;?> - Payment Upto <?php echo $noticeDate;?> >= <?php echo $equal_above;?> Date:<?php echo date('d/m/Y');?>
                           
                        </span></td>
                </tr>
                </table>



                <table class="demo" width="100%;">
                <thead>
                    <tr>
                    <th align="left">Sl.No</th>

                    <th  width="10%" align="left">Code</th>
                    <th width="30%" align="left">Name</th>
                    
                    <th align="right">Billing</th>
                    <th align="right">Paid</th>
                    <th align="right">Adj</th>
                    <th align="right">Due</th>
                    <th align="left">Mobile</th>
                   
          
                </thead>
                <tbody>


                  <?php $rowCount=1; ?>

                

                <?php
                }

                $row++;} ?> 

                              
                         
                </tbody>
              </table>
           

        
  





</body>
</html>

