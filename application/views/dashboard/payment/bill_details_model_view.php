
<div class="table-responsive">

<?php
if ($billData) {

?>

<span  class="bg-gradient-warning btn-xs" >Billing Date : <?php echo date("d-m-Y", strtotime($billData->billing_date));?> </span>
<span  class="bg-gradient-info btn-xs" style="float: right;">Invoice No : <?php echo $billData->invoice_no;?> </span>
<table class="table table-striped" style="color: #561a4c;margin-top: 5px;">
  <thead>

    <tr>
      <th colspan="2"></th>
   
    </tr>
  </thead>
  <tbody>
    <tr>
      <th >Opening Balance</th>
      <td align="right"><?php echo $billData->opening_bal;?></td>
      
    </tr>
    <tr>
      <th><?php if($billData->billing_style=='M'){echo "Monthly";}else{ echo "Quarterly";}?> Fees</th>
        <td align="right"><?php echo $billData->subscription_fee;?></td>
     
    </tr>
    <tr>
      <th>Hard Cout Extra</th>
      <td align="right"><?php echo $billData->hard_cout_fee;?></td>
    </tr>

     <tr>
      <th>Correction</th>
      <td align="right"><?php echo $billData->correction;?></td>
    </tr>

     <tr>
      <th>Intra. Tournament fees</th>
      <td align="right"><?php echo $billData->intra_tournament_fee;?></td>
    </tr>

    <tr>
      <th>Total Amount</th>
      <td align="right"><span class="btn badge badge-info" style="font-size: 12px;"><?php echo $billData->total_amount;?></span></td>
    </tr>

  </tbody>
</table>
<?php }else{
	echo "No bill details exist.";
	} ?>

</div>