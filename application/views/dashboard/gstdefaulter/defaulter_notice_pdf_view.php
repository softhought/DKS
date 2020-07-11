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

<?php
  
    $totallist=count($billList);
    $loop=1;
		foreach ($billList as $billlist) {
     

			?>


   <table width="100%" class="">
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
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold;">
                            REMINDER
                           
                        </span></td>
                	
                </tr>
        </table>


           <table width="100%" class="demo">
               <tr>
                   <td width="40%" align="Left">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; ">
                            Dated:<?php echo date('d/m/Y');?>
                           
                        </span>
                         
                    </td>
                    <td width="30%">&nbsp;</td>
                    <td>To,<br>
                      <?php echo $billlist['memberData']->member_code; ?><br>
                  	  <?php echo $billlist['memberData']->title_one." ".$billlist['memberData']->member_name; ?>
                      <?php echo $billlist['memberData']->address_one; ?><br>
                      <?php if($billlist['memberData']->address_two!=''){ echo $billlist['memberData']->address_two."<br>";} ?>
                      <?php if($billlist['memberData']->address_three!=''){ echo $billlist['memberData']->address_three."<br>";} ?>

                    </td>
                </tr>
              
        </table>

          <table width="50%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; " >
               <tr>
                   <td align="Left">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; ">
                          Please note the following
                           
                        </span>
                         
                    </td>
                  
                </tr>

                <tr>
                <td>Outstanding till</td>
                <td><?php echo $billlist['selMonthdispatchDate']; ?></td>
                <td>Rs.</td>
                <td><?php echo $billlist['selMonthbillAmount'];?></td> 
                </tr>

                <tr>
                <td>Outstanding till</td>
                <td><?php echo $billlist['nxtMonthdispatchDate']; ?></td>
                <td>Rs.</td>
                <td><?php echo $billlist['nxtMonthbillAmount'];?></td>
                </tr>

                <tr>
                <td>Outstanding till date</td>
                <td>&nbsp;</td>
                <td>Rs.</td>
                <td><?php echo $billlist['dailyBalance'];?></td> 
                </tr>
              
        </table><br>
             <table width="100%" >
               <tr>
                   <td align="Left">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; ">
                          Please make your payment urgently
                           
                        </span>
                         
                    </td>
                  
                </tr>

               <tr>

                  <td align="Left">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; ">
                         Further to please note that we are constrained to debit your account towards cost of pointing and delivery etc. of this reminder.
                           
                        </span>
                         
                </td>
                </tr>
              
        </table><br><br>


     <table width="100%" >
               <tr>
                   <td width="70%"> </td>
                   <td width="30%" align="center">
                   <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; ">
                   Yours faithfully,<br><br>
                   <b>For DAKSHIN KALIKATA SANSAD</b></span> </td>
                  
                </tr>

        </table><br><br><br>
         <table width="100%" >
               <tr>
                   <td width="70%"> </td>
                   <td width="30%" align="center">
                   <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; ">
                   Tamal Kanti Dey,<br><br>
                   Hony.Treasurer</span> </td>
                  
                </tr>

        </table>



        <?php if($loop!=$totallist){?>
			 <div class="break"></div>
       <?php } ?>
			
<?php	$loop++;	}

?>

</body>
</html>

