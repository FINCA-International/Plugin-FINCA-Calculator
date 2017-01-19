<?php
function data(){
	return array(
		"currencies" => array(
			array(
				"code" => 1,
				"name" => "dollar",
				"text" => "USD"
			),
			array(
				"code" => 2,
				"name" => "ruble",
				"text" => "RUB"
			),
			array(
				"code" => 3,
				"name" => "som",
				"text" => "KGS"
			)
		),
		"products" => array(
			array(
				"code" => 1,
				"name" => "Altyn Bulak",
				"interest_percent_bonus" => 4,
				"interest_percent_annual" => 11,
				"capitalization" => "afteryear",
				"replenishment" => 0
			),
			array(
				"code" => 2,
				"name" => "Kireshe",
				"interest_percent_bonus" => 4,
				"interest_percent_annual" => 11,
				"capitalization" => "afteryear",
				"replenishment" => 0
			),
			array(
				"code" => 3,
				"name" => "Altyn Kazina",
				"interest_percent_bonus" => 4,
				"interest_percent_annual" => 11,
				"capitalization" => "endyear",
				"replenishment" => 1
			),
			array(
				"code" => 4,
				"name" => "Kyal",
				"interest_percent_bonus" => 4,
				"interest_percent_annual" => 11,
				"capitalization" => "endyear",
				"replenishment" => 1
			),
			array(
				"code" => 5,
				"name" => "kelecheck",
				"interest_percent_bonus" => 4,
				"interest_percent_annual" => 11,
				"capitalization" => "endyear",
				"replenishment" => 1
			)
		)
	);
}
?>