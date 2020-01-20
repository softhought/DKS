<script src="<?php echo base_url(); ?>assets/js/customJs/correction/correction.js"></script>
<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Corrections-Tennis Coaching</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>correction/addeditcorrection" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
             </div>
              
             
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <div class="formblock-box">
                <div class="row">
                  <label for="from_dt" class="col-sm-1">From Date</label>
                      <div class="col-sm-2">
                         <div class="form-group">
                          <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="from_dt" id="from_dt" im-insert="false" value="">
                            </div>
                          </div>
                          <p id="fromdaterr" style="font-size: 12px;"></p>
                      </div>
                      <label for="to_date" class="col-sm-1">To Date</label>
                      <div class="col-sm-2">
                         <div class="form-group">
                          <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                              </div>
                              <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="to_date" id="to_date" im-insert="false" value="">
                            </div>
                          </div>
                           <p id="todateerr" style="font-size: 12px;"></p>
                      </div>

                      <label for="student" class="col-sm-1">Student</label>
                      <div class="col-sm-2">
                        <div class="form-group">
                         <div class="input-group input-group-sm">
                              
                         <select class="form-control select2" id="student_code" name="student_code" style="width: 100%;">
                      <option value=''>Select</option>
                      <?php foreach ($bodycontent['studentcodelist'] as $studentcodelist) { ?>

                        <option value="<?php echo $studentcodelist->student_id; ?>"

                           ><?php echo $studentcodelist->student_code; ?></option>
                       
                    <?php   } ?>
                     
                    </select>
                            </div>
                          </div>
                          <p id="studenterr" ></p>
                      </div> 

                  <div class="col-md-2">
                   <button type="button" class="btn btn-sm action-button padbtn" id="correctionshowbtn" style="padding: 4px 15px;">Show</button>

                    
                 </div>
                </div>

              <div id="correctionlist">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Transaction No.</th>
                    <th>Student Code</th>
                    <th>Student Name</th>
                    <th>Billing Style</th>
                    <th>Amount</th>
                    <th>Correction Date</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['correctiondtl'] as $correctiondtl) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $correctiondtl->tran_no; ?></td>
                   <td><?php echo $correctiondtl->student_code; ?></td>
                   <td><?php echo $correctiondtl->title_one.''.$correctiondtl->student_name; ?></td>
                   <td><?php 
                        if($correctiondtl->bill_style == 'M'){

                           echo 'Monthly';
                        }else if($correctiondtl->bill_style == 'Q'){
                         
                          echo 'Quarterly';

                        }
                      ?></td>
                   <td><?php echo $correctiondtl->amount; ?></td>
                   <td><?php 
                           if($correctiondtl->date_of_correction != ''){

                            echo date('d-m-Y',strtotime($correctiondtl->date_of_correction));
                           }
                        ?></td>
                   <td>
                     <a href="<?php echo base_url(); ?>correction/addeditcorrection/<?php echo $correctiondtl->id; ?>" class="btn btn-sm action-button padbtn">
                  <i class="fas fa-edit"></i> 
                   </a>
                   <button class="btn tbl-del-action-btn padbtn" onclick="deletetennisopening(<?php echo $correctiondtl->id; ?>)"><i class="fas fa-trash"></i></button>
                  <!--  <a href="<?php echo base_url(); ?>correction/deletecorrection/<?php echo $correctiondtl->id; ?>" class="btn btn-sm action-button padbtn">
                  <i class="fas fa-trash"></i>  --> 
                  </td>


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              </div>
              </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->