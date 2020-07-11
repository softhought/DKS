<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Loan List</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>paymentadvance/addPaymentAdvance" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Employee</th>                   
                    <th>Loan Date</th>                   
                    <th>Loan Amount</th>                   
                    <th>Monthly Deduction</th>                   
                                 
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['loanList'] as $loanlist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $loanlist->name; ?></td>                   
                   <td><?php echo date("d-m-Y", strtotime($loanlist->date_of_advance)); ?></td>                   
                   <td><?php echo $loanlist->adv_amount; ?></td>                   
                   <td><?php echo $loanlist->monthly_deduct_amt; ?></td>                   
                               
                   <td>
                     <a href="<?php echo base_url(); ?>paymentadvance/addPaymentAdvance/<?php echo $loanlist->payment_adv_id; ?>" class="btn tbl-action-btn padbtn">
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