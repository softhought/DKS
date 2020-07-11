

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
  <hr>

  <?php

if ($paymentList) { ?>
<span  class="bg-gradient-info btn-xs" style="float: right;">Payment Details </span>
  <table class="table table-striped" style="color: #561a4c;margin-top: 5px;">

  <thead>

    <th>Date</th>
    <th>Amount</th>
    <th>Fine</th>
    <th>Total</th>
    <th>Payment</th>

  </thead>
  <tbody>
    
  </tbody>
  <?php
  $total= 0;
        foreach ($paymentList as $paymentlist) {

          $total=$paymentlist->payment_amount;
          
    ?>
    <tr>
  <td><?php echo date("d-m-Y", strtotime($paymentlist->payment_date));?></td>
  <td align="right"><?php echo $paymentlist->taxable_amount-$paymentlist->fine_amt;?></td>
  <td align="right"><?php echo $paymentlist->fine_amt;?></td>
  <td align="right"><?php echo $paymentlist->total_amount;?></td>
  <td align="right"><?php echo $paymentlist->payment_amount;?></td>
</tr>
<?php } ?>

<tr>
  <td colspan="4">Total </td>
  <td align="right"><?php echo $total;?></td>
  
</tr>

  </table>



<?php } ?>





</div>