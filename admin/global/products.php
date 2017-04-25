<?php
global $wpdb;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty( $_POST)){

	$wpdb->update('deposit_calculator_product',
		array('name'=>$_POST['name'],'capitalization'=>$_POST['capitalization'],'replenishment'=>$_POST['replenishment']),
		array('id'=>$_POST['id']));
    
}



//
$sql = 'SELECT id, name, capitalization, replenishment FROM deposit_calculator_product;';
$deposit_product = $wpdb->get_results($sql);

?>

<div class="products">

	<div class="content">
		<h3>Products</h3>

		<?php foreach($deposit_product as $product): ?>

		
		<?php
		/*
		echo '<pre>';
		print_r($product);
		echo '</pre>';
		// */
		?>

		<form method="post" action="">
			<input type="hidden" name="id" value="<?php echo $product->id ?>" />
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Name:</th>
					<td><input type="text" name="name" value="<?php echo $product->name ?>"/></td>
				</tr>
				<tr valign="top">
					<th scope="row">Capitalization:</th>
					<td>
						<select name="capitalization">
							<option value="afteryear" <?php selected($product->capitalization, 'afteryear') ?>>After year</option>	
							<option value="endyear" <?php selected($product->capitalization, 'endyear') ?>>End of year</option>
						</select>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">Replanishment allowed:</th>
					<td>
						<select name="replenishment">
							<option value="0" <?php selected($product->replenishment, 0) ?>>Yes</option>	
							<option value="1" <?php selected($product->replenishment, 1) ?>>No</option>
						</select>
					</td>
				</tr>

				<tr valign="top">
					<td colspan="2">
						<a 	href="?page=finca-calculator&tab=product_settings&product_id=<?php echo $product->id ?>"
							class="">Rates settings</a>
					</td>
				</tr>

			</table>
			<?php submit_button(); ?>
		</form>

		<hr>

		<?php endforeach; ?>

	</div>

</div>

