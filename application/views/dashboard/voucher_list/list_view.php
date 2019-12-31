

    <hr> 
   <table id="voucherlistTable" class="table table-striped display" cellspacing="0" width="100%;" border="0" >
         
     <thead style="background:#db4849;color:white; font-size: 12px;text-indent: 4px;">
         <tr>
        <th>Sl.</th>
        <th>Voucher No.</th>
        <th>Voucher Date</th>
        <th>Narration</th>
        <th>Voucher Type</th>
        <th>Voucher Detail</th>
        <th>Action</th>
         </tr>
        
    </thead>
    
    <tbody>
           <?php if($voucherlist){
               $j=1;
               foreach($voucherlist as $content){?>
        <tr>
                <td><?php echo $j++;?></td>
                <td><?php echo $content['voucher_number']?></td>
                <td><?php echo $content['VoucherDate']?></td>
                <td><?php echo $content['narration']?></td>
                <td>
                    <?php $tran_type= $content['tran_type'];
                            if($tran_type=="PR"){
                                echo "Purchase";
                            }
                            if($tran_type=="CN"){
                                echo "Contra";
                            }
                            if($tran_type=="GV"){
                                echo "General";
                            }
                            if($tran_type=="JV"){
                                echo "Journal";
                            }
                            if($tran_type=="SL"){
                                echo "Sale";
                            }
                            if($tran_type=="RC"){
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

<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>application/assets/js/jquery.dataTables.min.js"></script>
<script>
$( document ).ready(function() {
    $("#voucherlistTable").DataTable();
});
</script>
     

