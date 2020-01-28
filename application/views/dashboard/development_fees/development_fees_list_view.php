<script src="<?php echo base_url(); ?>assets/js/customJs/member_facility/development_fees.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Development Fee - List</h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>developmentfees/addDevelopmentfees" class="btn btn-info btnpos">
              <i class="fas fa-plus"></i> Add </a>
                </div>
                           
              
            </div><!-- /.card-header -->

            <div class="card-body">

             <div class="formblock-box">
              <table id="benvolentfundList" class="table customTbl table-bordered table-hover  tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Category</th>
                    <th>Month</th>
                    
                  
                    <th>Amount</th>
                   
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;$total=0;
                foreach ($bodycontent['benvolentfundList'] as $benvolentfundlist) { 

                   if ($benvolentfundlist->total_amount!='') {
                   $total+=$benvolentfundlist->total_amount;
                  }
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $benvolentfundlist->member_code; ?></td>
                   <td><?php echo $benvolentfundlist->member_name; ?></td>
                   <td><?php echo $benvolentfundlist->category_name; ?></td>
                   <td><?php echo $benvolentfundlist->month_name; ?></td>
                  
                 
                
                 
                   <td align="right" ><?php echo $benvolentfundlist->total_amount; ?></td>

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

               <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>
