<script src="<?php echo base_url();?>assets/js/customJs/user.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create User</h3>
              <a href="<?php echo base_url();?>user" class="link_tab"><span class="glyphicon glyphicon-plus"></span> List</a>
            </div><!-- /.card-header -->

            <div class="card-body">
                
                <form onsubmit="return CreateUserFrmValidate();" action="store" id="CreateUserFrm" method="post">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control forminputs typeahead" id="name" name="name" placeholder="Enter Name" autocomplete="off" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_name">Username *</label>
                            <input type="text" class="form-control forminputs typeahead" id="user_name" name="user_name" placeholder="Enter Username" autocomplete="off" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mobile_no">Mobile No.</label>
                            <input type="text" class="form-control forminputs typeahead" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No." autocomplete="off" >
                        </div>
                        <div id="user_role_idDiv" class="form-group col-md-6">                          
                            <label for="user_role_id">User Role*</label>
                            <select class="form-control selectpicker" data-show-subtext="true" name="user_role_id" id="user_role_id" data-live-search="true"  >
                                <option  value="0">Select</option>
                                <?php foreach ($bodycontent['userRoleList'] as $value) { ?>
                                    <option  value="<?php echo $value->id; ?>" ><?php echo $value->role; ?></option>   
                                <?php  }  ?>                                        
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password *</label>
                            <input type="password" class="form-control forminputs typeahead" id="password" name="password" placeholder="Enter Mobile No." autocomplete="off" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cpassword">Confirm Password *</label>
                            <input type="password" class="form-control forminputs typeahead" id="cpassword" name="cpassword" placeholder="Enter Mobile No." autocomplete="off" >
                        </div>

                        <button type="submit" class="btn btn-block btn-primary btn-sm">Create</button>
                    </div>
                </form>
                

           
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->