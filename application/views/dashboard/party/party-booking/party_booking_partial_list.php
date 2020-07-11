<table class="table customTbl table-bordered table-hover dataTable tablepad">
                  <thead>
                      <tr>
                      <th>Sl.No</th>
                      <th>Member Code</th>
                      <th>Member Name</th>
                      <th>Party Member Name</th>
                      <th>Booking Date</th>
                      <th>Party Date</th>
                      <th>Time Slot</th>
                      <th>Party Location</th>
                      <th>Action</th>
                                          
                      </tr>
                  </thead>
                  <tbody>

                  <?php $i=1;
                  foreach ($bookingList as $Allpartybookingcode) { ?>
                    <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $Allpartybookingcode->member_master_code; ?></td>
                    
                    <td><?php echo $Allpartybookingcode->title_one.' '.$Allpartybookingcode->member_name; ?></td>
                    <td><?php echo $Allpartybookingcode->party_mem_name; ?></td>
                    <td><?php  if($Allpartybookingcode->booking_date != ''){
                                echo date('d/m/Y',strtotime($Allpartybookingcode->booking_date));
                    }; ?></td>
                    <td><?php if($Allpartybookingcode->party_date != ''){
                            echo date('d/m/Y',strtotime($Allpartybookingcode->party_date));
                    } ?></td>
                    <td><?php echo $Allpartybookingcode->time_slot; ?></td>
                    <td><?php echo $Allpartybookingcode->partylocation; ?></td>
                    
                    <td>
                      <a href="<?php echo base_url(); ?>partybooking/addeditpartybooking/<?php echo $Allpartybookingcode->booking_id; ?>" class="btn tbl-action-btn padbtn">
                    <i class="fas fa-edit"></i> 
                  </a>

                    <?php if($Allpartybookingcode->is_cancel == 'N'){ ?>
                      <button type="button" <?php if($Allpartybookingcode->party_bill_no != ""){ ?>disabled <?php } ?>  data-toggle="tooltip" data-placement="bottom" title = "Booking Confirm" data-bookingid = "<?php echo $Allpartybookingcode->booking_id; ?>"  data-iscancel = "Y"  class="cancelbtn btn tbl-action-btn padbtn" style="padding-right:7px;padding-left: 7px;"><i class="fas fa-check"></i> </button>
                    
                    <?php }else if($Allpartybookingcode->is_cancel == 'Y'){ ?>

                      <button type="button"  data-toggle="tooltip" data-placement="bottom" title = "Booking Cancel" data-bookingid = "<?php echo $Allpartybookingcode->booking_id; ?>"  data-iscancel = "N"  class="cancelbtn btn tbl-action-btn padbtn" style="padding-right:9px;padding-left: 9px;"><i class="fas fa-times"></i> </button>

                  

                  <?php   } ?>
                      
                    </td>


                  </tr>
                  <?php } ?>                       
                          
                  </tbody>
                </table>
        <script>
        $('[data-toggle="tooltip"]').tooltip();
        </script>        