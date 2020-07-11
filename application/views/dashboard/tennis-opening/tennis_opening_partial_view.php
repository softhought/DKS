

    <table class="table customTbl table-bordered table-hover dataTable tablepad">

                <thead>

                    <tr>

                    <th>Sl.No</th>

                    <th>Student Code</th>

                    <th>Student Name</th>

                    <th>Closing Balance</th>

                    <th>Action</th>

                                        

                    </tr>

                </thead>

                <tbody>



                <?php $i=1;

                foreach ($tennisopeninglist as $tennisopeninglist) { ?>



                   <tr>

                   <td><?php echo $i; ?></td>

                   <td>

                     <input type="hidden"  name="admission_id" id="admission_id_<?php echo $i; ?>" value="<?php echo $tennisopeninglist->admission_id; ?>">



                      <input type="hidden"  name="studcode" id="studcode_<?php echo $i; ?>" value="<?php echo $tennisopeninglist->studcode; ?>">



                      <input type="hidden"  name="bill_style" id="bill_style_<?php echo $i; ?>" value="<?php echo $tennisopeninglist->bill_style; ?>">



                    <?php echo $tennisopeninglist->studcode; ?>

                      

                    </td>

                   <td><?php echo $tennisopeninglist->title_one.''.$tennisopeninglist->student_name; ?></td>

                    <td>

                    <div class="form-group" style="margin-bottom: unset; width: 50%;">

                        <div class="input-group input-group-sm">



                      <input type="hidden"  name="opening_id" id="opening_id_<?php echo $i; ?>" value="<?php echo $tennisopeninglist->opening_id; ?>">

                            

                        <input type="text" class="form-control numberwithdecimal"  name="opening_bal" id="opening_bal_<?php echo $i; ?>" im-insert="false" value="<?php echo $tennisopeninglist->opening_balance;  ?>">

                          </div>

                        </div>

                    </td>

                   <td>



                    <?php if($tennisopeninglist->opening_id == ''){ ?>



                       <button type="button" class="btn btn-sm action-button padbtn formsubmitbtn" id="tennisopeningbtn_<?php echo $i; ?>">Insert</button>



                     <?php }else { ?>



                    <button type="button" class="btn btn-sm action-button padbtn formsubmitbtn" id="tennisopeningbtn_<?php echo $i; ?>">Update</button>



                  <?php } ?>



                       <span class="btn btn-sm action-button padbtn" id="loaderbtn_<?php echo $i; ?>"style="display: none;">Update...</span>

                    

                                        

                  </td>





                 </tr>

                <?php $i++; } ?>                       

                         

                </tbody>

              </table>

