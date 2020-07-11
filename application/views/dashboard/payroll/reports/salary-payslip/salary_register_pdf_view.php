<<!DOCTYPE html>
<html>
<head>
  <title>Reminder</title>
  <style type="text/css">
  .demo {
    #border:1px solid #C0C0C0;
    border-collapse:collapse;
    padding:5px;
    margin-left:-30px;
    margin-right:-30px;
    }
    .demo th {
    #border:1px solid #C0C0C0;
    padding:4px;
    background:#F0F0F0;
    font-family:Verdana, Geneva, sans-serif;
    font-size:11px;
    font-weight:bold;
    padding-left:5px;
   }
   .demo td {
    #border:1px solid #C0C0C0;
    padding:6px;
    font-family:Verdana, Geneva, sans-serif;
    font-size:11px;   
    
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
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold;">
                            DAKSHIN KALIKATA SANSAD <br/>
                           
                        </span>
                          <span style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">
                          93/1B, Rashbehari Avenue, Kolkata - 700029 <br/>
                              PHONE--2464 4933, 2465 4950
                              </span>
                    </td>
                </tr>
                <tr>
                <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            Salary Register List
                           
                        </span></td>
                  
                </tr>

                <tr>
                   <td align="right">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            Date:<?php echo date('d/m/Y');?>
                           
                        </span></td>
                </tr>
        </table>


           




 

                  <table class="demo" width="100%;">
                <thead>
                    <tr>
                  <th width="4%;">Sl</th>
                  <th algn="left" width="15%;">Employee Name</th>
                  <th algn="center" width="9%;">Basic</th>
                  <th algn="center" width="8%;">HRA</th>
                  <th algn="center" width="8%;">Travel Exp.</th>
                  <th algn="center" width="8%;">Gross</th>
                  <th algn="center" width="7%;">PF</th>
                  <th algn="center" width="7%;">ESI</th>
                  <th algn="center" width="7%;">PT</th>
                  <th algn="center" width="7%;">Loan</th>
                  <th algn="center" width="7%;">Lip</th>
                  <th algn="center" width="9%;">Total Deduct</th>
                  <th algn="center" width="9%;">Net Payment</th>
                   
                  </tr>
                </thead>
                <tbody>

                <?php 
              
              
                $i = 1;
                $row=1;
                $rowCount=0;
                foreach ($salaryregisterList as $value) { 
                   $rowCount++;
                        
                  
                  ?>
                   <tr>
                    <td><?php echo $i++; ?></td>
                        <td><?php echo $value->name; ?></td>
                                           
                        <td align="right"><?php echo $value->basic; ?></td>
                        <td align="right"><?php echo $value->hra; ?></td>
                        <td align="right"><?php echo $value->travelling; ?></td>
                        <td align="right"><?php echo $value->gross; ?></td>
                        <td align="right"><?php echo $value->pf_ded; ?></td>
                        <td align="right"><?php echo $value->esi_ded; ?></td>
                        <td align="right"><?php echo $value->pt_ded; ?></td>
                        <td align="right"><?php echo $value->loan_ded; ?></td>
                        <td align="right"><?php echo $value->lip_ded; ?></td>
                        <td align="right"><?php echo $value->total_deduction; ?></td>
                        <td align="right"><?php echo $value->net_payable; ?></td>
               
                   

                 </tr>
                <?php 

                if ($rowCount==32) {   $rowCount=0;?>

                </tbody>
              </table>
           
                <div class="break"></div>

   <table width="100%">
               <tr>
                   <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold;">
                            DAKSHIN KALIKATA SANSAD <br/>
                           
                        </span>
                          <span style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">
                          93/1B, Rashbehari Avenue, Kolkata - 700029 <br/>
                              PHONE--2464 4933, 2465 4950
                              </span>
                    </td>
                </tr>
                   <tr>
                <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            Block/Unblock List
                           
                        </span></td>
                  
                </tr>

                <tr>
                   <td align="right">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            Date:<?php echo date('d/m/Y');?>
                           
                        </span></td>
                </tr>
                </table>



                <table class="demo" width="100%;">
                <thead>
                    <tr>
                    <th>Sl</th>
                    <th algn="center">Employee Name</th>
                  <th algn="center">Basic</th>
                  <th algn="center">HRA</th>
                  <th algn="center">Traveling</th>
                  <th algn="center">Gross</th>
                  <th algn="center">PF</th>
                  <th algn="center">ESI</th>
                  <th algn="center">PT</th>
                  <th algn="center">Total Deduction</th>
                  <th algn="center">Net Payment</th>
             </tr>         
          
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

