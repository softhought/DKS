<script src="<?php echo base_url(); ?>assets/js/customJs/tennisopening/tennisopening.js"></script>



<section class="layout-box-content-format1">

        <div class="card card-primary">

            <div class="card-header">

              <h3 class="card-title">Student Tennis Closing</h3>

               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >

               

                <a href="<?php echo base_url(); ?>tennisopening/tennisopeningbalist" class="btn btn-default"><i class="fas fa-clipboard-list"></i> List</a>

                

               

              </div>

             

                           

            </div><!-- /.card-header -->



            <div class="card-body">

               <div class="formblock-box">



              <div class="row">

                <div class="col-sm-3">

                  <label>Billing Style</label>

                </div>

                <div class="col-sm-3">

                      <!-- radio -->

                      <div class="form-group">

                        <div class="form-check">

                          <input class="form-check-input showblllsty" type="radio" name="billing_style" value="M">

                          <label class="form-check-label">Monthly</label>

                        </div>

                        

                      </div>

                    </div>

                    <div class="col-sm-3">

                      <!-- radio -->

                      <div class="form-group">

                        <div class="form-check">

                          <input class="form-check-input showblllsty" type="radio" name="billing_style" value="Q">

                          <label class="form-check-label">Quarterly</label>

                        </div>

                        

                      </div>

                    </div>

              </div>





             <form id="tennisopeningForm" name="tennisopeningForm" enctype="multipart/form-data">



              <div id="billstyle" style="display: none;">

                

           



              <div class="row">

                

              <label for="studentcode" class="col-sm-1 billstymonth" style="display: none;">Month</label>

                  <div class="col-sm-3 maxwidth billstymonth" style="display: none;">

                      <div class="form-group">

                       <div class="input-group input-group-sm">



                       <select class="form-control select2" id="month_id" name="month_id" style="width: 100%;">

                        <option value=''>&nbsp; </option>

                        <?php foreach ($bodycontent['ListOfMonth'] as $ListOfMonth) { ?>



                          <option value="<?php echo $ListOfMonth->id; ?>"><?php echo $ListOfMonth->month_name; ?></option>

                         

                      <?php   } ?>

                   

                  </select>

                </div>

                </div>



                <p id="montherr" class="perrmsg"></p>

                    </div>



                 

             



              <label for="studentcode" class="col-sm-1 bill_styquater" style="display: none;">Quteraly</label>

                <div class="col-sm-3 maxwidth bill_styquater" style="display: none;">

                      <div class="form-group">

                       <div class="input-group input-group-sm">



                       <select class="form-control select2" id="quter_id" name="quter_id" style="width: 100%;">

                        <option value=''>&nbsp; </option>

                        <?php foreach ($bodycontent['ListOfQuarterMonth'] as $ListOfQuarterMonth) { ?>



                          <option value="<?php echo $ListOfQuarterMonth->id; ?>"><?php echo $ListOfQuarterMonth->quarter; ?></option>

                         

                      <?php   } ?>

                   

                  </select>

                </div>

                </div>

                  <p id="qutererr" class="perrmsg"></p>

                    </div>



                  



                    <label for="pincode" class="col-sm-1">Year</label>

                    <div class="col-sm-3">

                       <div class="form-group">

                        <div class="input-group input-group-sm">

                            

                            <input type="text" class="form-control"  name="year" id="year" im-insert="false" value="<?php echo  $bodycontent['Financialyear']; ?>" readonly>

                          </div>

                        </div>

                         

                    </div>



                    

                <div class="col-sm-2">

                  <button type="button" class="btn btn-sm action-button" id="showopeninglist" style="width: 50%;font-size: 14px;">Show</button>



                   </div>

                

              </div>



             

                 </div>



          <div class="row" id="listloader" style="text-align: center;display: none;">

                   

            <img src="<?php echo base_url(); ?>assets/img/loader.gif" style="width: 8%;">

                   

          </div>

        <div id="openingballist"></div>



    </form>

             

             </div> 



            </div><!-- /.card-body -->

        </div><!-- /.card -->

    </section>