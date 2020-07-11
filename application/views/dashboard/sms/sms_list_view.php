<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Sms List</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>sms/addSms" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th width="5%">Sl.No</th>
                    <th width="10%">Module</th>                                      
                    <th>Content</th>                                      
                                                    
                               
                    <th width="10%">Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['smsList'] as $smslist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $smslist->module; ?></td>
                   <td><?php echo $smslist->sms_content; ?></td>
                 
                   <td>
                     <a href="<?php echo base_url(); ?>sms/addSms/<?php echo $smslist->id; ?>" class="btn tbl-action-btn padbtn">
                  <i class="fas fa-edit"></i> 
                </a>
                    
                  </td>


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>