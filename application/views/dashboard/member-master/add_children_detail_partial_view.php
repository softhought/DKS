

    <tr id="rowchilddetails_<?php echo $rowno; ?>" class="childDtlCls" >



      <input type="hidden" name="editbtncheck" id="editbtncheck_<?php echo $rowno; ?>" value="N">  

      <input type="hidden" name="childdtlId[]" id="childdtlId_<?php echo $rowno; ?>" value="0"> 

    

    <td style="text-align: left;width: 20%"> 

       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">

            <div class="input-group input-group-sm">   

	             <input type="hidden" class="form-control editchilddtl_<?php echo $rowno; ?>"  name="child_name[]" id="child_name_<?php echo $rowno; ?>" value="<?php echo $children_name;?>">  

             </div>

        </div> 

     <span class="showdata_<?php echo $rowno; ?>"><?php echo $children_name;?></span>       		        

    </td>

    <td style="text-align: left;width: 20%"> 

        <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">

            <div class="input-group input-group-sm">

                <div class="input-group-prepend">

                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>

                </div>     

               <input type="hidden" class="form-control datemask editchilddtl_<?php echo $rowno; ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask=""  name="children_dob[]" id="children_dob_<?php echo $rowno; ?>" value="<?php echo $child_dob; ?>">

            </div>

         </div>          

     <span class="showdata_<?php echo $rowno; ?>"><?php echo $child_dob;?></span>                   

    </td>

     <td style="text-align: left;width: 20%"> 



          <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">

             <div class="input-group input-group-sm"> 

                 

                  <select class="form-control select2" name="children_occup[]" id="children_occup_<?php echo $rowno; ?>">

                    <option value=''>&nbsp; </option>

                      <?php foreach ($occuptionlist as $occuptionlist) { ?>

                               <option value="<?php echo $occuptionlist->id; ?>" 

                                

                                <?php if($occuptionlist->id == $child_occupation){

                                    echo 'selected';

                                } ?>



                                >

                                    <?php echo $occuptionlist->occupation_name; ?>

                                </option>

                       <?php   } ?>

                  </select>





               </div>

         </div>          



  <!--   <input type="hidden" name="children_occup[]" id="children_occup_<?php echo $rowno; ?>" value="<?php echo $child_occupation;?>">  -->  

     <span class="showdata_<?php echo $rowno; ?>"><?php echo $occup_name;?></span>                   

    </td>

    <td style="text-align: left;width: 15%"> 



        <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">

             <div class="input-group input-group-sm"> 

                 

                  <select class="form-control select2" name="children_gender[]" id="children_gender_<?php echo $rowno; ?>">

                   <option value=''>&nbsp; </option>

                                  <?php $genderlist = json_decode (GENDER_LIST);



                                  foreach ($genderlist as $key => $genderlist) { ?>

                                   <option value="<?php echo $key; ?>"

                                    <?php if($key == $children_gender){

                                         echo 'selected';

                                      } ?>

                                     >

                                          <?php echo  $genderlist; ?>

                                    </option>

                                        <?php   } ?>

                  </select>





               </div>

         </div>

    <!-- <input type="hidden" name="children_gender[]" id="children_gender_<?php echo $rowno; ?>" value="<?php echo $children_gender;?>"> -->   

     <span class="showdata_<?php echo $rowno; ?>"><?php echo $gendername;?></span>                  

    </td>

     <td style="text-align: left;width: 15%">

       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">

            <div class="input-group input-group-sm"> 

                <input type="hidden" class="form-control editchilddtl_<?php echo $rowno; ?>" name="children_mobile[]" id="children_mobile_<?php echo $rowno; ?>" value="<?php echo $child_mobile;?>" maxlength=10 onKeyUp="numericFilter(this);"> 

             </div>

         </div>         

     <span class="showdata_<?php echo $rowno; ?>"><?php echo $child_mobile;?> </span>                  

    </td>

   <td style="text-align: center;width: 10%">

   <span  class="btn tbl-action-btn btn-xs" data-toggle="modal" data-target="#imageuploadmodal_<?php echo $rowno; ?>"style="color: #7d2cdf; font-weight:700;padding-right:7px;" ><i class="fas fa-file"></i> </span>

   <div id="imageuploadmodal_<?php echo $rowno; ?>" class="modal fade customModal format1 right"  data-keyboard="false" data-backdrop="false">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, #A60711 0%,#4E3FFB 100%);background-color: rgba(0, 0, 0, 0);
padding: 5px;color: #fff;">
       <h4 class="frm_header">Image Upload</h4>
        <button type="button" class="close" data-dismiss="modal"  >&times;<span class="sr-only">Close</span></button>
       
      </div>
      <div class="modal-body">
         <div class="row">
            <div class="col-md-12 uploadProfile">

            <label for="profilepic"></label>
            
            <div class="form-group profile-block">

                <img src='' id="childrenshowimage_<?php echo $rowno; ?>" style="width: 120px;height:125px;border: 1px solid #6d78cb;margin-bottom:13px;margin-right: 34px; ">

                <img src='' id="childrensignimage_<?php echo $rowno; ?>" style="width: 120px;height:125px;border: 1px solid #6d78cb;margin-bottom:13px; ">

            <div class="inputWrapper">

                <label class="btn  btn-default btn-flat" style="margin-right: 51px;">Upload Photo 

                <input class="fileInput"  type='file' custom-file-input name='childrenmagefile[]' id="childrenimagefile_<?php echo $rowno; ?>" size='20' onchange="readCommanURL(this);" data-showId="childrenshowimage_<?php echo $rowno; ?>"   data-isimage="isChildrenImage_<?php echo $rowno; ?>"style="display: none;" accept="image/*">

                </label>
                <input type="hidden" name="child_image[]" id="child_image_<?php echo $rowno; ?>" value="">
                <label class="btn  btn-default btn-flat">Upload Sign 

                    <input class="fileInput"  type='file' custom-file-input name='childrensignimagefile[]' id="childrensignimagefile_<?php echo $rowno; ?>" size='20' onchange="readCommanURL(this);" data-showId="childrensignimage_<?php echo $rowno; ?>" data-isimage="IsChildrenSign_<?php echo $rowno; ?>" style="display: none;" accept="image/*">

                    </label>
                    
                 <input type="hidden" name="childsign_image[]" id="childsign_image_<?php echo $rowno; ?>" value="">

                <input type='hidden' name='isChildrenImage[]' id="isChildrenImage_<?php echo $rowno; ?>" value="N">
                <input type='hidden' name='IsChildrenSign[]' id="IsChildrenSign_<?php echo $rowno; ?>" value="N">

            </div>
            

            </div>



            </div> <!-- end of uploadProfile section -->
        </div>
      </div>
    </div>
  </div>
</div></td>

    

    <td style="vertical-align: left;">

							<?php 

                  if ($rowno!=0) {

                  

              ?> 

     <a href="javascript:;" class="editchilddetails" id="editDocRow_<?php echo $rowno; ?>" title="edit"> <i class="far fa-edit" style="color: #d04949;; font-weight:700;"></i>

     </a>&emsp;

           

	 <a href="javascript:;" class="delchildDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">

     

           <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>

            <?php } ?> 



    </a>

        

        

			</td>				

				

		

    </tr>

    

<script type="text/javascript">

    $(document).ready(function(){



        $('.select2').select2()

        //$('.datemask').datepicker();



        $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })



    })

</script>