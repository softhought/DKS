<script src="<?php echo base_url(); ?>assets/js/customJs/issue/issue.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Issue</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                
              <a href="<?php echo base_url(); ?>issue" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="issueEntryFrom" id="issueEntryFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="issueID" id="issueID" value="<?php echo $bodycontent['issueID']; ?>">
            <div class="card-body">

               <div class="formblock-box">
                           
                         <div class="row">
                           <div class="col-md-2"></div>
                              <div class="col-md-2">
                                <label for="groupname">Issue No</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="issue_no" id="issue_no" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['issueEditdata']->issue_no; } ?>" readonly >
                                </div>
                              </div>
                           
                              </div>
                             

                   <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">issue Date</label>
                            
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="issue_dt" id="issue_dt" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['issueEditdata']->issue_date));;}else{echo date('d/m/Y');}?>">
                          </div>
                        </div>
                 </div>

                       <div class="col-md-3">

                          <div class="form-group">
                            <label for="code">Department</label>
                             <div class="input-group input-group-sm" id="department_iderr"> 
                              <select class="form-control select2" name="department_id" id="department_id"  style="width: 100%;">
                              <option value="">Select</option>
                                <?php 
                                foreach ($bodycontent['departmentList'] as $departmentlist) {
                                ?>
                               <option value="<?php echo $departmentlist->department_id;?>"
                               <?php 
                                  if ($bodycontent['mode'] == 'EDIT') {
                                    if ($bodycontent['issueEditdata']->department_id==$departmentlist->department_id) {
                                        echo "selected";
                                    }
                                  }
                               ?>
                               >
                               <?php echo $departmentlist->department_name;?></option>
                               <?php } ?>
                            </select>

                            </div>

                          </div>
                 </div><!-- end of col-md-2 -->
        
                </div>

         



                 <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">

                          <div class="form-group">
                            <label for="code">Raw Meterial</label>
                             <div class="input-group input-group-sm" id="rawmeterial_iderr"> 
                              <select class="form-control select2" name="rawmeterial_id" id="rawmeterial_id"  style="width: 100%;">
                              <option value="">Select</option>
                                <?php 
                                foreach ($bodycontent['rawmeterialList'] as $rawmeteriallist) {
                                ?>
                               <option value="<?php echo $rawmeteriallist->raw_meterial_id;?>"
                                 data-rawunit="<?php echo $rawmeteriallist->item_unit_name; ?>"
                               >
                               <?php echo $rawmeteriallist->name;?></option>
                               <?php } ?>
                            </select>

                            </div>

                          </div>
                 </div><!-- end of col-md-2 -->
                 <div class="col-md-2">
                     <label for="groupname">UNIT</label>
                      <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="unit_name" id="unit_name" placeholder="" value=""  readonly>
                                </div>
                      </div>
                    </div>
                 
              

                   <div class="col-md-2">
                   <label for="groupname">Qty. Sent</label>
                   <div class="form-group">
                   <div class="input-group input-group-sm">
                   <input type="text" class="form-control" name="quantity_sent" id="quantity_sent" placeholder="" value=""  onKeyUp="numericFilter(this);" >
                    </div>
                    </div>
                    </div>


                    <div class="col-md-1">  
                    <label for="groupname">&nbsp;</label>
                    <div class="form-group">
                    <div class="input-group input-group-sm">
                    <button type="button" class="btn btn-sm action-button addRawmet" id="addRawmeterialbtn" style="width: 60%;">Add</button>
                    </div></div>  
                    </div>           

                 </div>


                 

                      <!-- ----------------------Item details Account --------------------------- -->
                         <div class="row">
                          <div class="col-md-2"></div>
                    <div class="col-sm-7">
                    <div  id="detail_itemamt" style="border: 1px solid #a84e7f;max-height: 250px;overflow: scroll;">

                    <div class="table-responsive">
                     <?php
                          $rowno=0;
                          $detailCount = 0;
                          if($bodycontent['mode']=="EDIT")
                          {
                           $detailCount = sizeof($bodycontent['issueDtlEditdata']);
                          
                          }

                          // For Table style Purpose
                          if($bodycontent['mode']=="EDIT" && $detailCount>0)
                          {
                            $style_var = "display:block;width:100%;";
                          }
                          else
                          {
                            $style_var = "display:none;width:100%;";
                          }
                        ?>

                 <table class="table table-bordered" style="font-size: 10px;color: #354668;<?php //echo $style_var; ?>">
                  <thead>                  
                    <tr>
                     
                      <th style="width:10%">Sl No</th>
                      <th style="width:50%">Raw meterial</th>
                      <th style="width:10%">Unit</th>
                      <th>Qty Sent</th>
                      
                      <th style="width:10%">Del</th>
                    </tr>
                  </thead>
                  <tbody>


                <?php 
                     if($bodycontent['issueDtlEditdata']){
                     $sl=1;
                     foreach ($bodycontent['issueDtlEditdata'] as $issuelist) {    
                ?>


    <tr id="rowItemdetails_<?php echo $rowno; ?>" class="itemDtlCls" >

    <td style="text-align: left;"> 
        
      <span id="serial_<?php echo $rowno; ?>"><?php echo $sl;?></span>                  
    </td>

     <td style="text-align: left;"> 
    <input type="hidden" class="rawmetcls" name="rawmeterialid[]" id="rawmeterialid_<?php echo $rowno; ?>" value="<?php echo $issuelist->raw_meterial_id;?>">    

           <?php echo $issuelist->rawmaterialname;?>              
    </td>

  

     <td style="text-align: left;"> 
    <input type="hidden"  name="rowunit[]" id="rowunit_<?php echo $rowno; ?>" value="<?php echo $issuelist->item_unit_name;?>">    

    <?php echo $issuelist->item_unit_name;?>                 
    </td>

         <td style="text-align: left;"> 
    <input type="hidden"  name="rowqtysent[]" id="rowqtysent_<?php echo $rowno; ?>" value="<?php echo $issuelist->quantity;?>">    

   <?php echo $issuelist->quantity;?>                   
    </td>


  
         

            <td style="vertical-align: middle;text-align: center;">
        


      <a href="javascript:;" class="delDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
      <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
          

        </a>
        
        
      </td>       
        
    
    </tr>
    



                


                  <?php   $sl++;
                          $rowno++;
                          }

                      }
                  ?>

                   
                  </tbody>
                </table>
                </div><!-- end of table responsive -->





                </div>

                <input type="hidden" name="rowno" id="rowno" value="<?php echo $rowno;?>">  
             
                </div>
                      
                    </div>


                    <!-- -------------End details account ------------------ -->
 
            
              </div>

               <div class="formblock-box">
                   <div class="row">

                        
                    

                      <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-10">
                        <?php }else{  ?>
                          <div class="col-md-10">
                        <?php  }?>
                          <p id="errormsg" class="errormsgcolor"></p>
                           <p id="response_msg" style="color: #689921;font-weight: bold;">  </p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="patrecsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

              
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

