<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">



<script type="text/javascript">

  

/*

  $(document).ready(function () { 

    var oTable = $('#example33').dataTable({

        stateSave: true,

         "paging":   false,

         "ordering": false,

         "info":     false

    });

    var i=0;

    var allPages = oTable.fnGetNodes();

    console.log(i++)



    $('body').on('click', '.rowCheckAll', function () {

        if ($(this).hasClass('allChecked')) {

            $('input[type="checkbox"]', allPages).prop('checked', false);

              $("#benvolentAmountApplybtn").hide();

        } else {

            $('input[type="checkbox"]', allPages).prop('checked', true);

              $("#benvolentAmountApplybtn").show();

        }



         $('input[type="checkbox"]', allPages).each(function(){



          console.log(i++)

          });



        $(this).toggleClass('allChecked');

    });











});



  */

</script>









<b style="color: #561a4c !important;">Data Entered: <span id="data_entered"></span></b>

        <table id="example33" class="table customTbl table-bordered table-striped dataTable" style="border-collapse: collapse !important;">

                

                 <thead>

                  <tr>

                  <td>Sl</td>

                  <td algn="center">Member Code</td>

                  <td algn="center">Name</td>

                  <td algn="center">Category</td>
                  <td algn="center">Amount</td>

                  <th align="center">

                 <input type="checkbox" class="rowCheckAll" name="rowCheckAll" id="rowCheckAll" value="Y" > Select All</th>

                

                 <td algn="center">Del</td>

                  </tr>

                   

                 </thead>     

               

               <tbody>

                

                  <?php 

		

					

              		$i = 1;

                  $row=1;
                  $dataentered=0;

                 

              		foreach ($memberList as $value) { 

  

                                           

              		?>



					 <tr>

					              <td><?php echo $i; ?></td>

                        <td><?php echo $value->member_code; ?></td>

                        <td><?php echo $value->title_one." ".$value->member_name; ?></td>

                         <td><?php echo $value->category_name; ?></td>
                         <td align="right" id="amt_<?php echo $row;?>"><?php echo $value->total_amount; ?></td>

                      

                           <td align="center">



               <input type="hidden" name="memberid_<?php echo $row;?>" id="memberid_<?php echo $row;?>" value="<?php echo $value->member_id;?>" >

               <input type="checkbox" class="rowCheck" name="rowCheck[]" id="rowCheck_<?php echo $row;?>" value="<?php echo $row;?>" >
              

               </td>
               <td align="center" id="del_<?php echo $row;?>">
                  <?php if($value->dev_tran_id!=''){ 
                  $dataentered++;  ?>
               <a href="javascript:;"  class="btn tbl-action-btn padbtn delDevFees"  style="padding-right:7px;"
                data-monthid="<?php echo $value->month_id; ?>"
                data-rowid="<?php echo $row; ?>"
                data-devtranid="<?php echo $value->dev_tran_id; ?>"

                >
                      <i class="fas fa-trash"> </i> 
                     
                    </a>
                     <i class="fas fa-spinner fa-spin" aria-hidden="true" style="display: none;" id="load_<?php echo $row;?>"> </i> 
                <?php }  ?>
                 
               </td>

                        

				    </tr>              			

              	<?php

                    $i++;

                     $row++;

              		}

              	?>

               

            </tbody>

              </table>
              <input type="hidden"  name="totalrow" id="totalrow" value="<?php echo $row-1;?>" > 
              <input type="hidden"  name="totaldataenteredrow" id="totaldataenteredrow" value="<?php echo $dataentered;?>" > 





