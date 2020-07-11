<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">




<div style="max-height: 400px;overflow-y:scroll;">
        <table id="example33" class="table customTbl table-bordered table-striped dataTable" style="border-collapse: collapse !important;">
                
                 <thead>
                  <tr>
                  <th>Sl</td>
                  <th algn="center">Member Code</th>
                  <th algn="center">Name</th>
                  <th algn="center">Daily Balance</th>
                  <th algn="center">Resedual Balance</th>
                  <th algn="center">Blocked</th>
                
                  
                
                 
                  </tr>
                   
                 </thead>     
               
               <tbody>
                
                  <?php 
		
					
              		$i = 1;
                  $row=1;
                  $count=0;
                  $blocked=0;
                  $persentage=0;
                 
              		foreach ($memberList as $value) { 
  
                      $count+=1;

                      if ($value->blocked_y_n=='Y') {
                         $blocked+=1;                  
                       }                     
              		?>

					 <tr>
					              <td><?php echo $i; ?></td>
                        <td><?php echo $value->member_code; ?></td>
                        <td><?php echo $value->title_one." ".$value->member_name; ?></td>
                    
                        <td align="right"><?php echo $value->daily_balance; ?></td>
                        <td align="right"><?php //echo $value->daily_balance; ?></td>
                        <td align="left"><?php echo $value->blocked_y_n; ?></td>
                        
                       
                        
				    </tr>              			
              	<?php
                    $i++;
                     $row++;
              		}
              	?>
               
            </tbody>
              </table>

             

              </div><br>
                <div class="row">
              <div class="col-md-1" >
                 <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="total_member" name="total_member" placeholder="" autocomplete="off" value="<?php echo $count;?>" readonly    >
                            </div>
                          </div>
                  </div>
                  <div class="col-md-5" ></div>
                  <div class="col-md-5" >
                     <div class="form-group">
                     
                      <div class="input-group input-group-sm">
                      <button type="submit" class="btn btn-sm action-button" id="printblockunblockbtn">Print</button>
                      </div>
                 </div>
                  </div>

                   <div class="col-md-1" >
                    <?php 
                    if ($count!=0) {
                       $persentage=($blocked/$count)*100;
                    }
                   


                    ?>
                 <div class="form-group">
                           
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="persentage" name="persentage" placeholder="" autocomplete="off" value="<?php echo number_format($persentage,2)."%";?>" readonly    >
                            </div>
                          </div>
                  </div>

               
             </div>



