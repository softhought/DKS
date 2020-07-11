<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">







        <table class="table table-bordered table-striped dataTable" style="border-collapse: collapse !important;">
                
                 <thead>
                  <tr>
                  <td>Sl</td>
                  <td algn="center">Student Code</td>
                  <td algn="center">Name</td>
                  <td algn="center">Billing Style</td>
                  <th align="center">
                 <input type="checkbox" class="rowCheckAll" name="rowCheckAll" id="rowCheckAll" value="Y" > Select All</th>
                
                 
                  </tr>
                   
                 </thead>     
               
               <tbody>
                
                  <?php 
		
					
              		$i = 1;
                  $row=1;
                 
              		foreach ($studentList as $value) { 
  
                                           
              		?>

					 <tr>
					              <td><?php echo $i; ?></td>
                        <td><?php echo $value->student_code; ?></td>
                        <td><?php echo $value->student_name; ?></td>
                        <td><?php 
                          if($value->bill_style=='Q'){
                            echo "Quarterly";

                          }elseif ($value->bill_style=='M') {
                              echo "Monthly";
                          } ?></td>
                      
                           <td align="center">

               <input type="hidden" name="admissionid_<?php echo $row;?>" id="admissionid_<?php echo $row;?>" value="<?php echo $value->admission_id;?>" >
               <input type="checkbox" class="rowCheck" name="rowCheck[]" id="rowCheck_<?php echo $row;?>" value="<?php echo $row;?>" >
               </td>
                        
				    </tr>              			
              	<?php
                    $i++;
                     $row++;
              		}
              	?>
               
            </tbody>
              </table>


