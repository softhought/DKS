

<div class="table-responsive">



<?php

if ($billData) {



?>



<span  class="bg-gradient-warning btn-xs" >Billing Date : <?php echo date("d-m-Y", strtotime($billData->bill_date));?> </span>



<span  class="bg-gradient-primary btn-xs" style="float: right;" >Month : <?php echo $billData->short_name;?> </span>



<table class="table table-striped" style="color: #561a4c;margin-top: 5px;">

  <thead>



    <tr>

      <th colspan="2"></th>

   

    </tr>

  </thead>

  <tbody>

    <tr>

      <th >Opening Balance</th>

      <td align="right"><?php echo $billData->month_open;?></td>      

    </tr>

    <tr>

      <th >Monthly Subscription</th>

      <td align="right"><?php echo $billData->month_subs;?></td>      

    </tr>

    <tr>

      <th >Bar Amount</th>

      <td align="right"><?php echo $billData->bar_amount;?></td>      

    </tr>

    <tr>

      <th >Bar GST</th>

      <td align="right"><?php echo ($billData->bar_cgst+$billData->bar_sgst);?></td>      

    </tr>

     <tr>

      <th >Canteen Amount</th>

      <td align="right"><?php echo $billData->cat_amount;?></td>      

    </tr>



    <tr>

      <th >Canteen GST</th>

      <td align="right"><?php echo ($billData->cat_cgst+$billData->cat_sgst);?></td>      

    </tr>



    <tr>

      <th >Swimmng</th>

      <td align="right"><?php echo $billData->swimming;?></td>      

    </tr>



    <tr>

      <th >Gym</th>

      <td align="right"><?php echo $billData->gym;?></td>      

    </tr>



     <tr>

      <th >Locker Charges</th>

      <td align="right"><?php echo $billData->locker_charge;?></td>      

    </tr>



     <tr>

      <th >Hard Court Extra</th>

      <td align="right"><?php echo $billData->hard_court_extra;?></td>      

    </tr>



     <tr>

      <th >Guest Charge</th>

      <td align="right"><?php echo $billData->guest_charge;?></td>      

    </tr>



    <tr>

      <th >Towel Charge</th>

      <td align="right"><?php echo $billData->towel_charge;?></td>      

    </tr>



     <tr>

      <th >Benvolent Fund</th>

      <td align="right"><?php echo $billData->ben_fund;?></td>      

    </tr>



     <tr>

      <th>Fixed Hard Court</th>

      <td align="right"><?php echo $billData->fixed_hard;?></td>      

    </tr>



    <tr>

      <th>Card Play</th>

      <td align="right"><?php echo $billData->card_play;?></td>      

    </tr>



     <tr>

      <th>Development Charges</th>

      <td align="right"><?php echo $billData->development_charge;?></td>      

    </tr>



     <tr>

      <th>Puja Contribution</th>

      <td align="right"><?php echo $billData->puja_contribution;?></td>      

    </tr>



    <tr>

      <th>Corrections</th>

      <td align="right"><?php echo $billData->corrections;?></td>      

    </tr>



    <tr>

      <th>Receipt Amount</th>

      <td align="right"><?php echo $billData->receipt_amt;?></td>      

    </tr>



    <tr>

      <th>Min Bill Amt.</th>

      <td align="right"><?php echo $billData->min_bill_amt;?></td>      

    </tr>



    <tr>

      <th>Gst on outgoing charges</th>

      <td align="right"><?php echo number_format(($billData->outgoing_cgst+$billData->outgoing_sgst),2);?></td>      

    </tr>

   

   

    



   





    <!-- <tr>

      <th>Outstanding Amount</th>

      <td align="right"><span class="btn badge badge-info" style="font-size: 12px;"><?php echo $billData->net_amount;?></span></td>

    </tr> -->

    <tr>

      <th>Social Subscription</th>

      <td align="right"><?php echo $billData->social_subs;?></td>

    </tr>

    <tr>

      <th>Net Payable</th>

      <td align="right"><?php echo $billData->net_amount;?></td>

    </tr>

    <tr>

      <th>Arrear</th>

      <td align="right"><?php echo $billData->arrear_amt;?></td>

    </tr>

    <tr>

      <th>Current</th>

      <td align="right"><span class="btn badge badge-info" style="font-size: 12px;"><?php echo $billData->current_amt;?></span></td>

    </tr>



  </tbody>

</table>

<?php }else{

	echo "No bill details exist.";

	} ?>



</div>