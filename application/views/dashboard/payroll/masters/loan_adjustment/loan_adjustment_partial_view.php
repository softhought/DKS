<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">


       <div class="row">
        <div class="col-md-1"></div>
        <label for="is_openingadvance" class="col-md-1">Name</label>
         <div class="col-md-3">
                               
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="emp_name" id="emp_name" placeholder="Name"  value="" readonly >
                                            
                                         </div>
                                      </div>
                       <input type="hidden" name="rowid" id="rowid" value="">  
                        <input type="hidden" name="oldadjamt" id="oldadjamt" value="">                
                              </div>
                          <label for="is_openingadvance" class="col-md-2">Adjustment Amount</label>
                              <div class="col-md-2">
                               
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="newadjamt" id="newadjamt" placeholder="Adjustment Amount"  value="" onKeyUp="numericFilter(this);" >
                                            
                                         </div>
                                      </div>
                              </div>


              <div class="col-md-2">
                 <div class="form-group">
                            
                            <div class="input-group input-group-sm">
                           <button type="button" class="btn btn-sm action-button
                           " id="updatebtn">Update</button>
                           
                            </div>

                          </div>
              </div>



                       </div>




        <table id="example33" class="table customTbl table-bordered table-striped dataTable" style="border-collapse: collapse !important;">
                
                 <thead>
                  <tr>
                  <td>Sl</td>
              
                  <td algn="center">Name</td>
                  <td algn="center">Balance(Rs.)</td>
                  <td algn="center">Adjustment Amount(Rs.)</td>
                  <td algn="center">Action</td>
                 
                
                 
                  </tr>
                   
                 </thead>     
               
               <tbody>
                 <input type="hidden" name="monthid" id="monthid" value="<?php echo $monthid; ?>">
                  <?php 
		
					
              		$i = 1;
                  $row=1;
                
              		foreach ($loanList as $value) { 
  
                                           
              		?>

					 <tr>
					              <td><?php echo $i; ?></td>
                        <td><?php echo $value['memberData']->name; ?></td>
                        <td><?php echo $value['balance']; ?></td>
                        <td id="monthdeduction_<?php echo $row;?>"><?php echo $value['adjAmount']; ?></td>

            <input type="hidden" name="employeename[]" id="employeename_<?php echo $row;?>" value="<?php echo $value['memberData']->name; ?>">      
            <input type="hidden" name="employeeid[]" id="employeeid_<?php echo $row;?>" value="<?php echo $value['memberData']->employee_id; ?>">
            <input type="hidden" name="balancedtl[]" id="balancedtl_<?php echo $row;?>" value="<?php echo $value['balance']; ?>">
            <input type="hidden" name="adjAmt[]" id="adjAmt_<?php echo $row;?>" value="<?php echo $value['adjAmount']; ?>">

             <td><i class="fas fa-edit editadj" id="edit_<?php echo $row;?>"></i></td>
                      
                      
                        
				    </tr>              			
              	<?php
                    $i++;
                     $row++;
              		}
              	?>
               
            </tbody>
              </table>

<br>
    <?php          

                  if ($loanList){

    ?>
                 <div class="row">

                     
                          <div class="col-md-5">
           
                          <p id="errormsgsave" class="errormsgcolor" style="color: #21bf21;"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="button" class="btn btn-sm action-button" id="loanadjustsavebtn" style="width: 60%;">Save</button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;">Saving...</span>
                           </div>

                 
                   </div>
                   <?php } ?>
                      
            </div>


