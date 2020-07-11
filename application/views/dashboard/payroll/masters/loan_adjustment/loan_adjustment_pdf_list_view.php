<<!DOCTYPE html>
<html>
<head>
  <title>Loan Adjustment</title>
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
                            Loan Adjustment List
                           
                        </span></td>
                  
                </tr>

                  <tr>
                   <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            <?php echo $yearmonth;?>  Date:<?php echo date('d/m/Y');?>
                           
                        </span></td>
                </tr>
        </table>


           




 

                  <table class="demo" border="2" style="width: 100%">
                <thead>
                    <tr>
                   <td>Sl</td>
              
                  <td algn="center">Name</td>
                  <td algn="center">Balance(Rs.)</td>
                  <td algn="center">Adjustment Amount(Rs.)</td>
                  <td algn="center">Action</td>
                </tr>
                   
          
                </thead>
                <tbody>

                <?php 
               
              
                $i = 1;
                $row=1;
                $rowCount=0;
                  foreach ($loanList as $value) { 
                   $rowCount++;
                 
                  
                  ?>
                   <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['memberData']->name; ?></td>
                        <td><?php echo $value['balance']; ?></td>
                        <td id="monthdeduction_<?php echo $row;?>"><?php echo $value['adjAmount']; ?></td>

            <input type="hidden" name="employeename[]" id="employeename_<?php echo $row;?>" value="<?php echo $value['memberData']->name; ?>">      
            <input type="hidden" name="employeeid[]" id="employeeid_<?php echo $row;?>" value="<?php echo $value['memberData']->employee_id; ?>">
            <input type="hidden" name="balancedtl[]" id="balancedtl_<?php echo $row;?>" value="<?php echo $value['balance']; ?>">
            <input type="hidden" name="adjAmt[]" id="adjAmt_<?php echo $row;?>" value="<?php echo $value['adjAmount']; ?>">

             <td><i class="fas fa-edit editadj" id="edit_<?php echo $row;?>"></i></td>
                      
                      
                        
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
                           Loan Adjustment List
                           
                        </span></td>
                  
                </tr>

              
                </table>



                <table class="demo" width="100%;" style="width: 100%">
                <thead>
                <tr>
                   <td>Sl</td>
              
                  <td algn="center">Name</td>
                  <td algn="center">Balance(Rs.)</td>
                  <td algn="center">Adjustment Amount(Rs.)</td>
                  <td algn="center">Action</td>
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

