<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> -->




        <table id="salaryreg"  class="table customTbl table-bordered table-striped dataTable" >
                
                 <thead>
                  <tr>
                  <th>Sl</td>
                  <th algn="center">Employee Name</th>
                  <th algn="center">Department</th>   
                  <th algn="center">Month</th>             
                  <th algn="center" >PF No.</th>
                  <th algn="center">ESI No.</th>                 
                  <th algn="center">Net Payment</th>
                
                
                 
                  </tr>
                   
                 </thead>     
               
               <tbody>
                
                  <?php 
		
					
              		$i = 1;
                 
                 
              		foreach ($salaryregisterList as $value) { 
  
                                        
              		?>

					 <tr>
					              <td><?php echo $i; ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->dept_name; ?></td>
                        <td><?php echo $value->short_name; ?></td>
                        <td align="right"><?php echo $value->pf_no; ?></td>
                        <td align="right"><?php echo $value->esi_no; ?></td>                       
                        <td align="right"><?php echo $value->net_payable; ?></td>
                     
                        
                       
                        
				    </tr>              			
              	<?php
                    $i++;
                                  		}
              	?>
               
            </tbody>
              </table>

             

             
               

                 

       



