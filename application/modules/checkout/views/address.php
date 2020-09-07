<?php
	$checked='';
 foreach ($useraddress as $key => $value) {
		if(!empty($insertedaddress)){
			if($insertedaddress == $value->address_id){
				$checked = 'checked';
			}
		}

	?>
	<div class="col-sm-6 col-md-6">	
	<div class="account-address">
		<input type="hidden" name="address_id" name="address_id" value="<?php echo $value->address_id; ?>">
		<p class="tag-address"><strong><?php echo $value->addresstype; ?></strong></p>
		<p class="tag-address"><strong><?php echo $value->first_name;?></strong></p>				
		<p class="full-address"><?php echo $value->room_no .','.$value->buildingchawl.','.$value->address.'<br/>'.$value->pincode ?></p>
		<?php if(!empty($profile) ){?>
			<!-- <a href="javascript:void(0)" onclick="editAddress(<?php echo $value->address_id;?>)">Edit</a> -->
			<a href="javascript:void(0)" onclick="deleteAddress(<?php echo $value->address_id;?>)">Delete</a>
		<?php }else{?>
		<label for="add"><input type="radio" id="add<?php echo $value->address_id;?>" name="add" value="<?php echo $value->address_id;?>"  <?php  echo $checked;?>/> Deliver Here	</label>				
		<?php }?>	
	</div>
</div>
<?php } ?>