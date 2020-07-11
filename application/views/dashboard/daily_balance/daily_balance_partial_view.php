<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">





        <table id="example33" class="table customTbl table-bordered table-striped dataTable" style="border-collapse: collapse !important;">
                
                 <thead>
                  <tr>
                  <td>Sl</td>
                  <td algn="center">Member Code</td>
                  <td algn="center">Name</td>
                  <td algn="center">Daily Balance</td>
                  <td algn="center">Upd. Date</td>
                  <td algn="center">Upd. Time</td>
                  
                
                 
                  </tr>
                   
                 </thead>     
               
               <tbody>
                
                  <?php 
		
					
              		$i = 1;
                  $row=1;
                 
              		foreach ($memberList as $value) { 
  
                                           
              		?>

					 <tr>
					              <td><?php echo $i; ?></td>
                        <td><?php echo $value->member_code; ?></td>
                        <td><?php echo $value->title_one." ".$value->member_name; ?></td>
                    
                        <td align="right"><?php echo $value->daily_balance; ?></td>
                        <td ><?php echo date("d-m-Y",strtotime($value->updatedate)); ?></td>
                        <td ><?php echo date("h:s A",strtotime($value->updatetime)); ?></td>
                       
                        
				    </tr>              			
              	<?php
                    $i++;
                     $row++;
              		}
              	?>
               
            </tbody>
              </table>


