<script src="<?php echo base_url(); ?>assets/js/customJs/tennisopening/tennisopening.js"></script>

<section class="layout-box-content-format1">

        <div class="card card-primary">

            <div class="card-header box-shdw">

              <h3 class="card-title">Student Tennis Closing</h3>



              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >

              <a href="<?php echo base_url(); ?>tennisopening" class="btn btn-default btnpos">

               <i class="fas fa-plus"></i> Add </a>

             </div>

             

             

              

            </div><!-- /.card-header -->



            <div class="card-body">

              <div class="formblock-box">

              <table id="studtennisopening" class="table customTbl table-bordered table-hover dataTable tablepad">

                <thead>

                    <tr>

                    <th>Sl.No</th>

                    <th>Student Code</th>

                    <th>Student Name</th>

                    <th>Month</th>

                    <th>Bill Style</th>

                    <th>Opening Balance</th>

                                        

                    </tr>

                </thead>

                <tbody>



                <?php $i=1;

                foreach ($bodycontent['Alltennisopeninglist'] as $Alltennisopeninglist) { ?>

                   <tr>

                   <td><?php echo $i++; ?></td>

                   <td><?php echo $Alltennisopeninglist->studcode; ?></td>

                   <td><?php echo $Alltennisopeninglist->title_one.''.$Alltennisopeninglist->student_name; ?></td>

                   <td><?php 

                          if($Alltennisopeninglist->short_name != ''){



                           echo $Alltennisopeninglist->short_name;

                          }else{

                            echo $Alltennisopeninglist->quarter;

                          }

                    ?></td>

                   <td><?php if($Alltennisopeninglist->billing_style == "M"){



                       echo 'Monthly';

                       }else if($Alltennisopeninglist->billing_style == "Q"){



                       echo 'Quarterly';

                   } ?></td>

                   <td><?php echo $Alltennisopeninglist->opening_balance; ?>

                                        

                  </td>





                 </tr>

                <?php } ?>                       

                         

                </tbody>

                <tfoot>

                           <tr>

                           <th></th>

                           <th></th>

                           <th></th>

                           <th></th>

                           <th></th>

                           <th></th>

                          

                         

                           </tr>

                           </tfoot> 

              </table>

            </div>



            </div><!-- /.card-body -->

        </div><!-- /.card -->

   </section>