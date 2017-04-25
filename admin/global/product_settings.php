<?php

global $wpdb;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty( $_POST )){

	if($_POST['_method'] == 'post'){

		$wpdb->update('deposit_calculator_product_rate',
			array(
				'currency_id'=>$_POST['currency_id'],
				'period'=>$_POST['period'],
				'interest'=>$_POST['interest'],
				'amount_min'=>$_POST['amount_min'],
				'amount_max'=>$_POST['amount_max'],
				'interest_bonus'=>$_POST['interest_bonus']),
			array('id'=>$_POST['id']));

	}else{

		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		*/

		var_dump(
		$wpdb->insert('deposit_calculator_product_rate',[
				'product_id'=>$_POST['product_id'],
				'currency_id'=>$_POST['currency_id'],
				'period'=>$_POST['period'],
				'interest'=>$_POST['interest'],
				'amount_min'=>$_POST['amount_min'],
				'amount_max'=>$_POST['amount_max'],
				'interest_bonus'=>$_POST['interest_bonus']
			])
		);

	}

    
}


//
$product_id = isset($_GET['product_id']) ? htmlentities($_GET['product_id']) : 0;

//
$sql = 'SELECT id, product_id,currency_id,period,interest,amount_min,amount_max,interest_bonus ';
$sql .= 'FROM deposit_calculator_product_rate ';
$sql .= 'WHERE product_id = %d';

$deposit_product_rate = $wpdb->get_results($wpdb->prepare($sql, $product_id));

echo '<h3>Product rate configuration</h3><br>';

$row=0;
foreach($deposit_product_rate as $rate):
$row++;
?>

	<form method="post" action="">
		<input type="hidden" name="id" value="<?php echo $rate->id ?>">
		<input type="hidden" name="_method" value="post" />
		<table class="table-form">
			<?php if($row == 1) { ?>
				<tr>
					<th><?php echo __('Currency', 'finca-calculator') ?></th>
					<th><?php echo __('Period in months', 'finca-calculator') ?></th>
					<th><?php echo __('Interest %', 'finca-calculator') ?></th>
					<th><?php echo __('Min amount', 'finca-calculator') ?></th>
					<th><?php echo __('Max amount', 'finca-calculator') ?></th>
					<th><?php echo __('Interest bonus %', 'finca-calculator') ?></th>
					<th></th>
				</tr>
			<?php } ?>
				<tr>
					<td>
						<select name="currency_id">
							<option value="1"
								<?php selected($rate->currency_id, 1) ?>>USD
							</option>	
							<option value="2"
								<?php selected($rate->currency_id, 2) ?>>RUB
							</option>
							<option value="3"
								<?php selected($rate->currency_id, 3) ?>>KGS
							</option>
						</select>
						<?php 
						/*
						<input type="text" name="currency_id"
						value="<?php echo $rate->currency_id ?>" />
						*/
						?>
					</td>
					<td><input type="text" name="period" value="<?php echo $rate->period ?>" /></td>
					<td><input type="text" name="interest" value="<?php echo $rate->interest ?>" /></td>
					<td><input type="text" name="amount_min" value="<?php echo $rate->amount_min ?>" /></td>
					<td><input type="text" name="amount_max" value="<?php echo $rate->amount_max ?>" /></td>
					<td><input type="text" name="interest_bonus" value="<?php echo $rate->interest_bonus ?>" /></td>
					<td><input id="submit" class="button button-primary" value="Save Changes" type="submit"></td>
				</tr>
		</table>
	</form>
	<hr>
<?php endforeach; ?>

<br><br>

<h3>Add new rate</h3>

<form method="POST" action="">
		<input type="hidden" name="_method" value="put" />
		<input type="hidden" name="product_id" value="<?php echo $product_id ?>" />
		<table class="table-form">
			<tr>
				<th><?php echo __('Currency', 'finca-calculator') ?></th>
				<th><?php echo __('Period in months', 'finca-calculator') ?></th>
				<th><?php echo __('Interest %', 'finca-calculator') ?></th>
				<th><?php echo __('Min amount', 'finca-calculator') ?></th>
				<th><?php echo __('Max amount', 'finca-calculator') ?></th>
				<th><?php echo __('Interest bonus %', 'finca-calculator') ?></th>
				<th></th>
			</tr>
			<tr>
				<td>
					<select name="currency_id">
						<option value="1">USD</option>	
						<option value="2">RUB</option>
						<option value="3">KGS</option>
					</select>
				</td>
				<td><input type="text" name="period" /></td>
				<td><input type="text" name="interest" /></td>
				<td><input type="text" name="amount_min" /></td>
				<td><input type="text" name="amount_max" /></td>
				<td><input type="text" name="interest_bonus" /></td>
				<td>
					<input
						id="submit" class="button button-primary"
						value="Save Changes" type="submit"></td>
			</tr>
		</table>
	</form>