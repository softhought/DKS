<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">







        <table id="example33" class="table customTbl table-bordered table-striped dataTable" style="border-collapse: collapse !important;">
                
                 <thead>
                  <tr>
                  <td>Sl</td>
                  <td algn="center">Member Code</td>
                  <td algn="center">Name</td>
                  <td algn="center">Category</td>
                  <td algn="center">Copy Month</td>
                  <td algn="center">Amount</td>
                  <!-- <th align="center">
                 <input type="checkbox" class="rowCheckAll" name="rowCheckAll" id="rowCheckAll" value="Y" > Select All</th> -->
                
                 
                  </tr>
                   
                 </thead>     
               
               <tbody>
                
                  <?php 
		
					
              		$i = 1;
                  $row=1;
                  $numberofdata=0;

                  if ($memberList) {
                   
              		foreach ($memberList as $value) { 
                  $numberofdata++;
                                           
              		?>

					 <tr>
					              <td><?php echo $i; ?></td>
                        <td><?php echo $value->member_code; ?></td>
                        <td><?php echo $value->title_one." ".$value->member_name; ?></td>
                        <td><?php echo $value->category_name; ?></td>
                        <td><?php echo $value->month_name; ?></td>
                        <td><?php echo $value->total_amount; ?></td>
                      <!--      <td align="center">

               <input type="hidden" name="memberid_<?php echo $row;?>" id="memberid_<?php echo $row;?>" value="<?php echo $value->member_id;?>" >
               <input type="checkbox" class="rowCheck" name="rowCheck[]" id="rowCheck_<?php echo $row;?>" value="<?php echo $row;?>" >
               </td> -->
                        
				    </tr>              			
              	<?php
                    $i++;
                     $row++;
              		}

                }
              	?>
               


            </tbody>
              </table>


