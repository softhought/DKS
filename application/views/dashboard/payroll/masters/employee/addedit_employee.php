<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/employee.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Employee <?php echo $bodycontent['mode']; ?></h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>employee" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="employeeFrom" id="employeeFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="emplId" id="emplId" value="<?php echo $bodycontent['emplId']; ?>">
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Personal Info</h3>  
                           
                         <div class="row">
                           
                             <label for="name" class="col-md-1">Name*</label>
                              <div class="col-md-3">                                 
                                     <div class="form-group">
                                         <div class="input-group input-group-sm" id="nameerr">
                                              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Employee Name" style="text-transform:uppercase ;" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->name; } ?>">
                                             
                                         </div>
                                      </div>
                           
                               </div>
                               <label for="emp_dob" class="col-md-1">DOB*</label>
                               <div class="col-md-2">                                  
                                     <div class="form-group">
                                         <div class="input-group input-group-sm" id="doberr">
                                              <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                 <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="emp_dob" id="emp_dob" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->dob != ''){ echo date('d/m/Y',strtotime($bodycontent['employeeEditdata']->dob)); } ?>">
                                             
                                         </div>
                                      </div>
                           
                               </div>
                               <label for="father_name" class="col-md-2">Father's Name</label>
                               <div class="col-md-3">
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              
                                                 <input type="text" class="form-control"  name="father_name" id="father_name" placeholder="Enter Father's Name" style="text-transform:uppercase ;" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->father_name; } ?>">
                                             
                                         </div>
                                      </div>
                           
                               </div>
                               </div>
                               <div class = "row">
                                    <label for="designation_id" class="col-md-1">Designation</label>
                                     <div class="col-md-3">
                                          <div class="form-group">
                                             
                                                   <div class="input-group input-group-sm" id="designationerr">
                                                       <select class="form-control select2" name="designation_id" id="designation_id" >
                                                            <option value="">Select</option>
                                                            <?php foreach ($bodycontent['Alldesignationlist'] as $value) { ?>

                                                            <option value="<?php echo $value->id; ?>"
                                                            <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->designation_id == $value->id){ echo 'selected'; } ?>
                                                              >
                                                              <?php echo $value->designation_name; ?></option>
                                                            
                                                            <?php } ?>
                                                                          
                                                         </select>
                                                     </div>

                                             </div>
                                        
                                      </div> 
                               
                               <label for="dept_id" class="col-md-1">Department</label>
                                 <div class="col-md-2">
                                          <div class="form-group">
                                              
                                                   <div class="input-group input-group-sm" id="depterr">
                                                       <select class="form-control select2" name="dept_id" id="dept_id" >
                                                            <option value="">Select</option>
                                                            <?php foreach ($bodycontent['Alldepartementlist'] as $value) { ?>

                                                            <option value="<?php echo $value->dept_id; ?>"
                                                               <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->dept_master_id == $value->dept_id){ echo 'selected'; } ?>
                                                              >
                                                              <?php echo $value->dept_name; ?></option>
                                                            
                                                            <?php } ?>
                                                                          
                                                         </select>
                                                     </div>

                                             </div>
                                        
                                      </div>
                          
                               <label for="retirement_date" class="col-md-2">Retirement Date</label>
                                  <div class="col-md-3">
                                    
                                        <div class="form-group">
                                            <div class="input-group input-group-sm" id="retiredateerr">
                                                  <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="retirement_date" id="retirement_date" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->retirement_date != ''){ echo date('d/m/Y',strtotime($bodycontent['employeeEditdata']->retirement_date)); } ?>">
                                                
                                            </div>
                                          </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <label for="mobile_no" class="col-md-1">Mobile No.</label>
                                        <div class="col-md-3">                                 
                                              <div class="form-group">
                                                  <div class="input-group input-group-sm" id="nameerr">
                                                        <input type="text" class="form-control numberonly" name="mobile_no" id="mobile_no" placeholder="Enter Mobile No." style="text-transform:uppercase ;" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->mobile_no; } ?>">
                                                      
                                                  </div>
                                                </div>
                                    
                                        </div>
                                    
                                    <label for="join_date" class="col-md-1">Joining Date*</label>
                                      <div class="col-md-2">
                                          
                                            <div class="form-group">
                                                <div class="input-group input-group-sm" id="joindaterr">
                                                      <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="join_date" id="join_date" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->joining_date != ''){ echo date('d/m/Y',strtotime($bodycontent['employeeEditdata']->joining_date)); } ?>">
                                                    
                                                </div>
                                              </div>
                                  
                                      </div>
                                      <label for="emp_address" class="col-md-2">Address</label>
                                      <div class="col-md-3">
                                          
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">
                                                        <textarea  class="form-control" name="emp_address" id="emp_address"><?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->address; } ?></textarea> 
                                                  </div>
                                                </div>
                                    </div>
                                      
                                  
                                                  
                          </div>

                </div>
                <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Official Info</h3> 
                        <div class="row">
                            <label for="is_pf" class="col-md-2">PF</label>
                             <div class="col-md-2">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                           <input type="checkbox" class="rowCheck showinput" data-showid = 'pf_no' name="is_pf" id="is_pf" <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->is_pfno == 'Y'){ echo 'checked'; } ?> value=" <?php if($bodycontent['mode'] == 'EDIT'  && $bodycontent['employeeEditdata']->is_pfno == 'Y'){ echo 'Y'; }else{ echo 'N'; } ?>">
                                        </div>
                                  </div>       
                             </div>
                             <label for="pf_no" class="col-md-1">PF No.</label>
                             <div class="col-md-3">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                            <input type="text" class="form-control"  name="pf_no" id="pf_no"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->pf_no; } ?>" <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->is_pfno == 'Y'){ echo ''; }else{ echo 'disabled'; } ?> >
                                          </div>
                                  </div>       
                             </div>
                             <label for="adhaar_no" class="col-md-1">Adhaar No.</label>
                             <div class="col-md-3">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                            <input type="text" class="form-control"  name="adhaar_no" id="adhaar_no"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->adhaar_no; } ?>">
                                          </div>
                                  </div>       
                             </div>
                       
                        </div>
                        <div class="row">
                            <label for="is_esi" class="col-md-2">ESI</label>
                             <div class="col-md-2">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                           <input type="checkbox" class="rowCheck showinput" name="is_esi" id="is_esi" data-showid = 'esi_no' <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->is_esino == 'Y'){ echo 'checked'; } ?> value=" <?php if($bodycontent['mode'] == 'EDIT'  && $bodycontent['employeeEditdata']->is_esino == 'Y'){ echo 'Y'; }else{ echo 'N'; } ?>" >
                                        </div>
                                  </div>       
                             </div>
                             <label for="esi_no" class="col-md-1">ESI No.</label>
                             <div class="col-md-3">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                            <input type="text" class="form-control"  name="esi_no" id="esi_no"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->esi_no; } ?>" 
                                            <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->is_esino == 'Y'){ echo ''; }else{ echo 'disabled'; } ?> >
                                          </div>
                                  </div>       
                             </div>
                             <label for="ptax" class="col-md-1">PTAX</label>
                             <div class="col-md-2">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                           <input type="checkbox" class="rowCheck showinput" name="ptax" id="ptax" <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->ptax == 'Y'){ echo 'checked'; } ?> value=" <?php if($bodycontent['mode'] == 'EDIT'  && $bodycontent['employeeEditdata']->ptax == 'Y'){ echo 'Y'; }else{ echo 'N'; } ?>" >
                                        </div>
                                  </div>       
                             </div>
                       
                        </div>
                        <div class="row">
                            <label for="salary_from_bank" class="col-md-2">Salary From Bank</label>
                             <div class="col-md-2">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                           <input type="checkbox" class="rowCheck showinput" name="salary_from_bank" data-showid = 'acc_no' id="salary_from_bank" <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->salary_from_bank == 'Y'){ echo 'checked'; } ?> value=" <?php if($bodycontent['mode'] == 'EDIT'  && $bodycontent['employeeEditdata']->salary_from_bank == 'Y'){ echo 'Y'; }else{ echo 'N'; } ?>" >
                                        </div>
                                  </div>       
                             </div>
                             <label for="acc_no" class="col-md-1">A/C No.</label>
                             <div class="col-md-3">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                            <input type="text" class="form-control" name="acc_no" id="acc_no"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->bank_acc_no; } ?>" <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['employeeEditdata']->salary_from_bank == 'Y'){ echo ''; }else{ echo 'disabled'; } ?>>
                                          </div>
                                  </div>       
                             </div>
                             
                       
                        </div>

                </div> 
                <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>ESI Info</h3>
                        <div class="row">
                             <label for="dispensary_name" class="col-md-2">Dispensary Name</label>
                              <div class="col-md-3">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                            <input type="text" class="form-control"  name="dispensary_name" id="dispensary_name" style="text-transform:uppercase ;"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->dispensary_name; } ?>">
                                          </div>
                                  </div>       
                             </div>
                             <div class="col-md-1"></div>
                             <label for="doctors_name" class="col-md-2">Doctors Name</label>
                              <div class="col-md-3">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                            <input type="text" class="form-control"  name="doctors_name" id="doctors_name" style="text-transform:uppercase ;"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->doctors_name; } ?>">
                                          </div>
                                  </div>       
                             </div>
                              
                        </div>
                        <div class="row">
                             <label for="doctors_degree" class="col-md-2">Doctors Degree</label>
                              <div class="col-md-3">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                            <input type="text" class="form-control" style="text-transform:uppercase ;"  name="doctors_degree" id="doctors_degree"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->doctors_degree; } ?>">
                                          </div>
                                  </div>       
                             </div>
                             <div class="col-md-1"></div>
                             <label for="doctors_address" class="col-md-2">Doctors Address</label>
                              <div class="col-md-3">                                                                
                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                               <textarea  class="form-control" name="doctors_address" id="join_date"><?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['employeeEditdata']->doctors_address; } ?> </textarea>
                                        </div>
                                  </div>       
                             </div>
                              
                        </div>
                <div>  
                <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Salary Info</h3> 
                       <div class="row">
                            
                                <div class="col-md-3">
                                     <label for="month_id">Month</label>
                                          <div class="form-group">
                                              <div class="input-group input-group-sm" id="montherr">
                                                   <select class="form-control select2" name="month_id" id="month_id" >
                                                        <option value="">Select</option>
                                                          <?php foreach ($bodycontent['monthlist'] as $value) { ?>

                                                            <option value="<?php echo $value->id; ?>"
                                                              >
                                                              <?php echo $value->short_name; ?></option>
                                                            
                                                            <?php } ?>
                                                                          
                                                         </select>
                                                     </div>

                                             </div>
                                        
                                      </div>
                                      
                                      <div class="col-md-2"> 
                                         <label for="basic_salary">Basic</label>                                                               
                                          <div class="form-group">
                                                <div class="input-group input-group-sm" id="basicerr">                                           
                                                    <input type="text" class="form-control decimalnumber"  name="basic_salary" id="basic_salary"  value="">
                                                  </div>
                                          </div>       
                                    </div>
                                   
                                    <!--   <div class="col-md-2">  
                                        <label for="salary_da">DA</label>                                                              
                                          <div class="form-group">
                                                <div class="input-group input-group-sm">                                           
                                                    <input type="text" class="form-control decimalnumber"  name="salary_da" id="salary_da"  value="">
                                                  </div>
                                          </div>       
                                    </div> --> 
                                   
                                      <div class="col-md-2">   
                                         <label for="house_rent">HRA</label>                                                             
                                          <div class="form-group">
                                                <div class="input-group input-group-sm">                                           
                                                    <input type="text" class="form-control decimalnumber"  name="house_rent" id="house_rent"  value="">
                                                  </div>
                                          </div>       
                                    </div> 

                                      <div class="col-md-2">  
                                        <label for="salary_da">Traveling</label>                                                              
                                          <div class="form-group">
                                                <div class="input-group input-group-sm">                                           
                                                    <input type="text" class="form-control decimalnumber"  name="traveling" id="traveling"  value="">
                                                  </div>
                                          </div>       
                                    </div>
                                    <div class="col-md-2">   
                                         <label for="acc_no">&nbsp;</label>                                                             
                                          <div class="form-group">
                                                <div class="input-group input-group-sm">                                           
                                                <button type="button" class="btn btn-sm action-button" id="addmoresalry" ><i class="fas fa-plus"></i> Add</button>
                                                  </div>
                                          </div>       
                                    </div> 

                        </div>  
                        <div class="row">
                            <div class="col-sm-12">
                                <div  id="detail_employeesalry" style="#border: 1px solid #e49e9e;">
                                  <div class="table-responsive">
                                      <?php
                                                $rowno=0;
                                                $detailCount = 0;
                                                if($bodycontent['mode']=="EDIT")
                                                {
                                                $detailCount = sizeof($bodycontent['employeesalarydtl']);
                                                //$detailCount = 0;
                                                }

                                                // For Table style Purpose
                                                if($bodycontent['mode']=="EDIT" && $detailCount>0)
                                                {
                                                  $style_var = "display:inline-table;width:100%;";
                                                }
                                                else
                                                {
                                                  $style_var = "display:none;width:100%;";
                                                }
                                              ?>

                      <table id="salarytabl" class="table table-bordered" style="font-size: 13px;color: #354668;<?php echo $style_var; ?>">
                          <thead>                  
                              <tr>                                          
                                  <th>Month</th>
                                  <th>Basic</th>
                                  <th>HRA</th>
                                  <th>Traveling</th>
                                                                                   
                                  <th style="width: 80px;">Action</th>
                                </tr>
                          </thead>
                        <tbody>
                        <input type="hidden" name="delIds" id="delIds" value="">

                        <?php 
                          if($bodycontent['mode']=="EDIT" ){

                         foreach($bodycontent['employeesalarydtl'] as $employeesalarydtl){ ?>

                          <tr id="rowsalarydetails_<?php echo $rowno; ?>" class="salaryDtlCls" >

                          <input type="hidden" name="editbtncheck" id="editbtncheck_<?php echo $rowno; ?>" value="N">  
                          <input type="hidden" name="employeedtlId[]" id="employeedtlId_<?php echo $rowno; ?>" value="<?php echo $employeesalarydtl->emp_dtl_id;  ?>"> 
                        
                        <td style="text-align: left;width: 20%"> 
                                <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                                        <div class="input-group input-group-sm">                         
                                            <select class="form-control select2 monthIds" name="dtl_month_id[]" id="dtl_month_id_<?php echo $rowno; ?>">
                                                  <option value=''>&nbsp; </option>
                                                          
                                                          <?php foreach($bodycontent['monthlist'] as  $monthlist){ ?>

                                                              <option value="<?php echo $monthlist->id; ?>"
                                                                
                                                                    <?php if($monthlist->id == $employeesalarydtl->month_id){
                                                                        echo 'selected'; $month_name = $monthlist->short_name;
                                                                    } ?>
                                                                    >
                                                                    <?php echo  $monthlist->short_name; ?>
                                                                </option>
                                                                <?php } ?>

                                                                  
                                            </select>


                                        </div>
                                    </div> 
                        <span class="showdata_<?php echo $rowno; ?>"><?php echo $month_name;?></span>       		        
                        </td>
                        <td style="text-align: right;width: 20%"> 
                            <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                                <div class="input-group input-group-sm">
                                        
                                  <input type="hidden" class="form-control decimalnumber  editemployeedtl_<?php echo $rowno; ?>"   name="dtl_basic_sal[]" id="dtl_basic_sal_<?php echo $rowno; ?>" value="<?php echo $employeesalarydtl->basic_salary; ?>">
                                </div>
                            </div>          
                        <span class="showdata_<?php echo $rowno; ?>"><?php echo $employeesalarydtl->basic_salary;?></span>                   
                        </td>
                        
                      
                     

                        <td style="text-align: right;width: 20%">
                          <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                                <div class="input-group input-group-sm"> 
                                    <input type="hidden" class="form-control decimalnumber editemployeedtl_<?php echo $rowno; ?>" name="dtl_salary_hra[]" id="dtl_salary_hra_<?php echo $rowno; ?>" value="<?php echo $employeesalarydtl->hra_amount;?>" > 
                                </div>
                            </div>         
                        <span class="showdata_<?php echo $rowno; ?>"><?php echo $employeesalarydtl->hra_amount;?> </span>                  
                        </td>
                           <td style="text-align: right;width: 20%">
                          <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
                                <div class="input-group input-group-sm"> 
                                    <input type="hidden" class="form-control decimalnumber editemployeedtl_<?php echo $rowno; ?>" name="dtl_salary_traveling[]" id="dtl_salary_traveling_<?php echo $rowno; ?>" value="<?php echo $employeesalarydtl->traveling_amount;?>" > 
                                </div>
                            </div>         
                        <span class="showdata_<?php echo $rowno; ?>"><?php echo $employeesalarydtl->traveling_amount;?> </span>                  
                        </td>
                      
                        
                        <td style="vertical-align: left;">
                                 
                        <a href="javascript:;" class="editemployeedetails" id="editDocRow_<?php echo $rowno; ?>" title="edit"> <i class="far fa-edit" style="color: #d04949;; font-weight:700;"></i>
                        </a>&emsp;
                              
                      <a href="javascript:;" class="delemployeeDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
                        
                              <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
                               

                        </a>
                            
                            
                          </td>				
                            
                        
                        </tr>

                       <?php $rowno++;   } } ?>





                        <input type="hidden" name="rowno" id="rowno" value="<?php echo $rowno;?>">     
                        </tbody>
                    </table>
                  </div><!-- end of table responsive -->
                  </div>
                                  
                 </div>
                                            
               </div>

                </div>    


               <div class="formblock-box">
                   <div class="row">

                      <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-8">
                        <?php }else{  ?>
                          <div class="col-md-10">
                        <?php  }?>
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="employeesavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

                    <?php if($bodycontent['mode'] == 'ADD'){ ?>
                      <div class="col-md-2">
                       <button type="reset" id="resetgrpform" class="btn btn-sm action-button" style="width: 60%;">Reset</button>
                     </div>
                   <?php } ?>
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

