<<!DOCTYPE html>
<html>
<head>
  <title>Special Members</title>
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
                            Special Member List
                           
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
                 
                    <th>Sl.No</th>
                     <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Occupation</th>
                    <th>Phone/Mobile No.</th>
                    <th>Status</th>
                   
                                        
                    </tr>
                   
          
                </thead>
                <tbody>

                <?php 
             
              
                $i = 1;
                $row=1;
                $rowCount=0;
                foreach ($specialmemberlist as $specialmemberlist) { 
                   $rowCount++;
                      
                  
                  ?>
                  
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $specialmemberlist->member_code; ?></td>
                    <td><?php echo $specialmemberlist->title_one.' '.$specialmemberlist->member_name; ?></td>
                    <td><?php echo $specialmemberlist->occupation_name; ?></td>
                    <td><?php  if($specialmemberlist->phone != ''){
                                   echo  $specialmemberlist->phone.'/'.$specialmemberlist->mobile; 
                                  }else{
                                    echo $specialmemberlist->mobile;
                                  }
                                  ?></td>
                     <td><?php echo $specialmemberlist->status; ?></td>
                    
                  </tr>
                <?php 

                if ($rowCount==28) {   $rowCount=0;?>

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
                             Special Member List
                           
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
                    <   <tr>
                 
                    <th>Sl.No</th>
                     <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Occupation</th>
                    <th>Phone/Mobile No.</th>
                    <th>Status</th>
                   
                                        
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

