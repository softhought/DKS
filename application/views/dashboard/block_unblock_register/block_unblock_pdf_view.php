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
                  <th algn="center">Member Code</th>
                  <th algn="center">Name</th>
                  <th algn="center">Daily Balance</th>
                  <th algn="center">Resedual Balance</th>
                  <th algn="center">Blocked</th>
                   
          
                </thead>
                <tbody>

                <?php 
              
              
                $i = 1;
                $row=1;
                $rowCount=0;
                foreach ($memberList as $value) { 
                   $rowCount++;
                        
                  
                  ?>
                   <tr>
                    <td><?php echo $i++; ?></td>
                        <td><?php echo $value->member_code; ?></td>
                        <td><?php echo $value->title_one." ".$value->member_name; ?></td>
                    
                        <td align="right"><?php echo $value->daily_balance; ?></td>
                        <td align="right"><?php //echo $value->daily_balance; ?></td>
                        <td align="left"><?php echo $value->blocked_y_n; ?></td>
               
                   

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
                            Block/Unblock List
                           
                        </span></td>
                  
                </tr>

                <tr>
                   <td align="center">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
                            Date:<?php echo date('d/m/Y');?>
                           
                        </span></td>
                </tr>
                </table>



                <table class="demo" width="100%;">
                <thead>
                    <tr>
                    <th>Sl</th>
                  <th algn="center">Member Code</th>
                  <th algn="center">Name</th>
                  <th algn="center">Daily Balance</th>
                  <th algn="center">Resedual Balance</th>
                  <th algn="center">Blocked</th>
                   
          
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

