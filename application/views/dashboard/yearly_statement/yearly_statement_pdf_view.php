<<!DOCTYPE html>
<html>
<head>
  <title>Yearly Statement</title>
  <style type="text/css">
  .demo {
    border:1px solid #C0C0C0;
    border-collapse:collapse;
    padding:5px;
    }
    .demo th {
    border:1px solid #C0C0C0;
    padding:4px;
    background:#F0F0F0;
    font-family:Verdana, Geneva, sans-serif;
    font-size:12px;
    font-weight:bold;
   }
   .demo td {
    border:1px solid #C0C0C0;
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
                            Yearly Statement
                           
                        </span></td>
                  
                </tr>

                
        </table>

          <table width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;" >
               <tr>
                   <td width="40%" align="Left">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; ">
                            Dated:<?php echo date('d/m/Y');?>
                           
                        </span>
                         
                    </td>
                    <td width="30%">&nbsp;</td>
                    <td>To,<br>
                      <?php echo $memberData->member_code; ?><br>
                      <?php echo $memberData->title_one." ".$memberData->member_name; ?>
                      <?php echo $memberData->address_one; ?><br>
                      <?php if($memberData->address_two!=''){ echo $memberData->address_two."<br>";} ?>
                      <?php if($memberData->address_three!=''){ echo $memberData->address_three."<br>";} ?>

                    </td>
                </tr>
              
        </table><br>


           




 

                  <table class="demo" width="100%;">
                <thead>
                    <tr>
                   
                    <tr>

                    <th >Month</th>

                    <th style="text-align: center;" >Open Bal</th>

                    <th style="text-align: center;">Bill Amt</th>

                    <th style="text-align: center;">Payment</th>               

                    <th style="text-align: center;">Outstanding</th>
                  </tr>
                   
          
                </thead>
                <tbody>

                <?php 
              
              
                $i = 1;
                $row=1;
                $rowCount=0;
                foreach ($billList as $billlist) { 
                   $rowCount++;
                   $billtotal += ($billlist->net_amount+$billlist->receipt_amt);

                   $paymenttotal += $billlist->receipt_amt;
                  
                  ?>
                   
                   <tr>

                   <td><?php echo $billlist->short_name; ?></td>

                   <td align="right"><?php echo number_format($billlist->month_open,2); ?></td>

                   <td align="right"><?php 

                   echo number_format(($billlist->net_amount+$billlist->receipt_amt),2); ?></td>

                   <td align="right"><?php echo number_format($billlist->receipt_amt,2); ?></td>

                 

                   <td align="right"><?php echo number_format($billlist->net_amount,2); ?></td>

                   

                  

      

                 </tr>
                <?php 

              }
                ?>
                   <tr style="font-weight: bold;">

                  <td> Total</td>

                  <td> &nbsp;</td>

                  <td align="right"><?php echo number_format($billtotal,2);?></td>

                  <td align="right"><?php echo number_format($paymenttotal,2);?></td>

                  <td></td>

                </tr>                       

                </tbody>
              </table>
           
              




   
           

        
  





</body>
</html>

