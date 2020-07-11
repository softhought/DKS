<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> -->




        <table id="salaryreg"  class="table customTbl table-bordered table-striped dataTable" >
                
                 <thead>
                  <tr>
                  <th>Sl</td>
                  <th algn="center">Employee Name</th>
                  <th algn="center">Department</th>   
                  <th algn="center">Month</th>             
                  <th algn="center" >Basic</th>
                  <th algn="center">HRA</th>
                  <th algn="center">Travelling</th>
                  <th algn="center">Incentive Bar Amt</th>
                  <th algn="center">Tennis Exp. Amt</th>
                  <th algn="center">Gross</th>
                  <th algn="center">PF</th>
                  <th algn="center">ESI</th>
                  <th algn="center">PT</th>
                  <th algn="center">Loan</th>
                  <th algn="center">Lip</th>
                  <th algn="center">Total Deduct</th>
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
                        <td align="right"><?php echo $value->basic; ?></td>
                        <td align="right"><?php echo $value->hra; ?></td>
                        <td align="right"><?php echo $value->travelling; ?></td>
                        <td align="right"><?php echo $value->incentive_bar_amt; ?></td>
                        <td align="right"><?php echo $value->tennis_exp_amt; ?></td>
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
                    $i++;
                                  		}
              	?>
               
            </tbody>
              </table>

             

             
               

                 

       



