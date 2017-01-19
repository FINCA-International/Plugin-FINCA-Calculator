<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'
	&& !empty( $_POST['action'] )
	&& $_POST['action'] == 'updateProducts' ) {

	//$wpdb->update('wp_finca_calculator', array('products'=>'ddd'), array('subsidiary'=>2));
	echo "Guardar productos";
    
}
?>
<form method="post" action="">
	<input type="hidden" name="action" value="updateProducts">
	<table class="form-table">
	<tr valign="top">
	<th scope="row">Extra post info:</th>
	<td><input type="text" name="extra_post_info" value=""/></td>
	</tr>
	</table>
	<?php submit_button(); ?>
</form>

<?php

return;
global $wpdb;

//$wpdb->insert('wp_finca_calculator', array('subsidiary' => 2));



//$ufResponses = serialize($_POST["responseFields"]);
if ($_SERVER['REQUEST_METHOD'] == 'POST'
	&& !empty( $_POST['action'] )
	&& $_POST['action'] == 'updateProducts' ) {

	//$wpdb->update('wp_finca_calculator', array('products'=>'ddd'), array('subsidiary'=>2));
    
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function(){

	$('#addrow').click(function(){
		$('.rows').append("<div class='product-row'> <label> Product name<input type='text' id='product_name[]'></label></div>");
		});

	$(document).on('click', '.remove', function(){

		$(this).closest('.course-row').remove();

	});	
});

</script>

<form action="post" action="">
	<?php wp_nonce_field('update', 'finca-calculator', true ) ?>
	<div class='rows'>
	  <div class='product-row'>

	  	<label>
	  		Product name
			<input type='text' id='product_name[]'>
		</label>
		<?php
		/*
		<label>
			Any time replenishment
			<select>
				<option>yes</option>
				<option>no</option>
			</select>
		</label>
		<label>
			Recurring replenishment
			<select>
				<option>yes</option>
				<option>no</option>
			</select>
		</label>
		<label>
			With withdrawal
			<select>
				<option>yes</option>
				<option>no</option>
			</select>
		</label>
		<label>
			No withdrawal
			<select>
				<option>yes</option>
				<option>no</option>
			</select>
		</label>

		<label>
			Timeframe from 
			<input type="number" name="">
			to
			<input type="number" name="">
		</label>

		<label>
			Minimal amount of initial
			<input type="number" name="">
		</label>

		<label>
			Maximal amount of initial
			<input type="number" name="">
		</label>

		<label>
			Minimal amount of replenishment
			<input type="number" name="">
		</label>
		
		<label>
			Maximal amount of replenishment
			<input type="number" name="">
		</label>

		<button class='remove'>remove</button>
		*/ ?>
	  </div>
	</div>
	<input type="submit" value="Save products" />
</form>
<button id='addrow'>Add row</button>