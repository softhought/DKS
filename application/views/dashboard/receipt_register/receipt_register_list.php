
  <section class="layout-box-content-format1">
        <div class="card card-primary">
            

            <div class="card-header box-shdw">
              <h3 class="card-title">Receipt Register</h3>

              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">hgjuyg
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Tran no</th>
                    <th>Tran dt.</th>
                    <th>Student Code</th>
                    <th>Student Name</th>
                    <th>Tran Type</th>
                    <th>Amount</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['studentregisterdtl'] as $studentregisterdtl) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php //echo $studentregisterdtl->student_code; ?></td>
                   <td><?php //echo $studentregisterdtl->student_code; ?></td>
                   <td><?php //echo $studentregisterdtl->student_code; ?></td>
                   <td><?php //echo $studentregisterdtl->student_code; ?></td>
                   <td><?php //echo $studentregisterdtl->student_code; ?></td>
                   <td><?php //echo $studentregisterdtl->student_code; ?></td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>