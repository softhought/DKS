<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Member Facility Rate List</h3>
              <!--  <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>membermaster/addmember" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div> -->
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                     <th>Description</th>
                    <th>Rate</th>
                    <th>CGST</th>
                    <th>SGST</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                  <?php $i=1;

                  foreach ($bodycontent['allfacilityrate'] as $allfacilityrate) { ?>
 
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $allfacilityrate->description; ?></td>
                    <td><?php echo $allfacilityrate->rate; ?></td>
                    <td><?php echo $allfacilityrate->cgstdes; ?></td>
                    <td><?php echo $allfacilityrate->sgstdes;  ?></td>
                    <td> <a href="<?php echo base_url(); ?>memeberfacilityrate/addeditfacilityrate/<?php echo $allfacilityrate->parameter_id; ?>" class="btn tbl-action-btn padbtn">
                   <i class="fas fa-edit"></i> 
                  </a></td>
                  </tr>

                   
                  <?php } ?>
                       
                         
                </tbody>
              </table>
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>