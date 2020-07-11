<script src="<?php echo base_url(); ?>assets/js/customJs/master/membermaster.js"></script>
<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Special Member List</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>specialmember/print_specialmember" target="_blank" class="btn btn-default btnpos">
               <i class="fas fa-print"></i> Print </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table id="memberlist" class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                     <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Occupation</th>
                    <th>Phone/Mobile No.</th>
                    <th>Status</th>
                    <!-- <th>Action</th> -->
                                        
                    </tr>
                </thead>
                <tbody>

                  <?php $i=1;

                  foreach ($bodycontent['specialmemberlist'] as $specialmemberlist) { ?>
 
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $specialmemberlist->member_code; ?></td>
                    <td><?php echo $specialmemberlist->title_one.' '.$specialmemberlist->member_name; ?></td>
                    <td><?php echo $specialmemberlist->occupation_name; ?></td>
                    <td><?php  if($specialmemberlist->phone != ''){
                                   echo  $specialmemberlist->phone.'/'.$specialmemberlist->mobile; 
                                  }else{
                                    echo $specialmemberlist->mobile;
                                  }
                                  ?></td>
                     <td><?php echo $specialmemberlist->status; ?></td>
                    <!-- <td> <a href="<?php echo base_url(); ?>membermaster/addeditmember/<?php echo $specialmemberlist->member_id; ?>" class="btn tbl-action-btn padbtn">
                   <i class="fas fa-edit"></i> 
                  </a></td> -->
                  </tr>

                   
                  <?php } ?>
                       
                         
                </tbody>
                 <!-- <tfoot>
                           <tr>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                          
                         
                           </tr>
              </tfoot>  -->
              </table>
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>