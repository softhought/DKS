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

		for ($i=0; $i < 5; $i++) { 


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
                   <td align="Left">
                        <span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; ">
                            Dated:<?php echo date('d/m/Y');?>
                           
                        </span>
                         
                    </td>
                    <td>&nbsp;</td>
                    <td>To,<br>
                  	  TC-017

                    </td>
                </tr>
              
        </table>


			 <div class="break"></div>
			
<?php		}

?>

</body>
</html>

