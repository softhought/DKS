<script src="<?php echo base_url(); ?>assets/js/customJs/studentregister.js"></script>

  <section class="layout-box-content-format1">

        <div class="card card-primary">

            



            <div class="card-header box-shdw">

              <h3 class="card-title">Student Registration</h3>



              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >

                <!-- <button type="button" class="btn btn-default"><i class="fas fa-plus"></i> Add </button>

                <button type="button" class="btn btn-default"><i class="fas fa-clipboard-list"></i> List</button>

                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#codegeneration_modal" id="codegenbtn"><i class="fas fa-cog"></i> Generate Code</button> -->

              </div>

            </div><!-- /.card-header -->



            <div class="card-body">

              <div class="formblock-box">

                   <div class="row">
                  <div class="col-md-4"></div>
                 <div class="col-md-3">
                   <div class="form-group">
                            <label for="member_code">Billing Style</label>
                                <div class="input-group input-group-sm">
                                   <select class="form-control select2 searchdata" name="billing_st" id="billing_st" >
                                  <option value="All">All</option>
                                  <option value="M">Mothly</option>
                                  <option value="Q">Quarterly</option>
                                 
                                                               
                                </select>
                                </div>

                          </div>
                 </div>
            
              
               </div>
              <div id="response_msg"></div>
              <div id ="studentlist">
              <table class="table customTbl table-bordered table-striped dataTable">

                <thead>

                    <tr>

                    <th>Sl No.&ensp;</th>

                    <th>Student Code</th>

                    <th>Student Name</th>

                    <th>Father's/Mother's Name</th>

                    <th>Contact</th>
                    <th>Billing Style</th>
                    <th>Action</th>

                                        

                    </tr>

                </thead>

                <tbody>



                <?php $i=1;

                foreach ($bodycontent['studentregisterdtl'] as $studentregisterdtl) { ?>

                   <tr>

                   <td><?php echo $i++; ?></td>

                   <td><?php echo $studentregisterdtl->student_code; ?></td>

                   <td><?php echo $studentregisterdtl->title_one.' '.$studentregisterdtl->student_name; ?></td>

                    <td><?php echo $studentregisterdtl->title_two.' '.$studentregisterdtl->guardian_name; ?></td>

                   <td><?php if($studentregisterdtl->phone_one != '' && $studentregisterdtl->phone_two != ''){



                     echo  $studentregisterdtl->phone_one.'/'.$studentregisterdtl->phone_two;

                     }else if($studentregisterdtl->phone_one != ''){



                          echo $studentregisterdtl->phone_one;

                     }



                     else{

                            echo $studentregisterdtl->phone_two;

                     } 

                     ?></td>
                   <td><?php 
                              if ($studentregisterdtl->bill_style=='M') {
                                    echo "Monthly";
                              }else{
                                    echo "Quarterly";
                              }

                    ?></td>
                   <td>

                     <a href="<?php echo base_url(); ?>Studentregister/addeditstudrestration/<?php echo $studentregisterdtl->admission_id; ?>" class="btn tbl-action-btn padbtn">

                   <i class="fas fa-edit"></i> 

                  </a>

                    

                  </td>





                 </tr>

                <?php } ?>                       

                         

                </tbody>

              </table>

              </div>




              </div>



            </div><!-- /.card-body -->

        </div><!-- /.card -->

  </section>