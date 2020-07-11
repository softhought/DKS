   <div id="recpay_list_data">
                <table id="voucherlistTable" class="table customTbl table-bordered table-striped dataTable" cellspacing="0" width="100%;" border="0" >
         
     <thead>
         <tr>
        <th>Sl. &emsp;</th>
        <th>Voucher No.&emsp;</th>
        <th>Voucher Date&emsp;</th>
        <th>Narration</th>
        <th>Voucher Type&emsp;</th>
        <th>Voucher Detail&emsp;</th>
        <th>Action&emsp;</th>
         </tr>
        
    </thead>
    
    <tbody>
           <?php if($paymentReceiptList){
               $j=1;
               foreach($paymentReceiptList as $content){?>
        <tr>
                <td><?php echo $j++;?></td>
                <td><?php echo $content['voucher_number']?></td>
                <td><?php echo $content['VoucherDate']?></td>
                <td><?php echo $content['narration']?></td>
                <td>
                    <?php $tran_type= $content['tran_type'];
                            if($tran_type=="PV"){
                                echo "Payment";
                            }
                            if($tran_type=="RV"){
                                echo "Receipt";
                            }
                           
                    ?>
                    
                
                </td>
                <td>
                    <table width="100%" style="font-size: 10px;">
                     
                    <tr style="color: #db4849;">
                         <th>A/C Description </th>
                         <th>Amount</th>
                         <th>Dr/Cr</th>
                     </tr>
                     <?php if($content['voucherDtl']){
                         foreach($content['voucherDtl'] as $value){
                         ?>
                     
                     <tr>
                         <td><?php echo $value->account_name;?></td>
                         <td><?php echo $value->amount;?></td>
                         
                          <td><?php echo $dbCr= $value->drCr;?></td>
                     
                     </tr>
                    
                     <?php }}?>
                 </table>
                    
                </td>
                <td>
                    
              <a href="<?php echo base_url(); ?>receiptpayment/addReceiptpayment/<?php echo $content['id']; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                    
                </td>
                
        </tr>
        
               <?php }
           }else{?>
                
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>No Data</td>
              <td>Found;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
        
           <?php } ?>
        
         
    </tbody>                                              
    </table>
             
              </div>