var finca_calculator_app_kg = angular.module('finca-calculator-app-kg', []);
finca_calculator_app_kg.controller('finca-calculator-app-kg-controller', function ($scope, $filter) {

	$scope.depositProducts = savings_data_product;
	$scope.depositProduct = $scope.depositProducts[0];

	$scope.depositProductRates = savings_data_product_rates;

	$scope.depositCurrencies = savings_data_currency;
	$scope.depositCurrency = $scope.depositCurrencies[0];

	$scope.depositFields = {
		"amount_principal":
			{ 
				"name": "amount_principal",
				"text": "Deposit amount",
				"value": 1000
			},
		"term":
			{
				"name": "term",
				"text": "Term",
				"value": 12
			},
		"amount_replenishment":
			{
				"name": "amount_replenishment",
				"text": "Replanishment amount",
				"value": 100
			}
	}

	

	$scope.depositOptions = {
		currencies: [
			{id: "dollar", text: "Dollar"},
			{id: "ruble", text: "Ruble"},
			{id: "som", text: "Som"}
		],
		frecuencies: [
			{ name: "Any time", value: "0" },
			{ name: "Monthly", value: "1" },
		],
		products: [
			{ name: "kelechek", value: 0},
			{ name: "Altyn-Kazyna", value: 1}
		],
		term: [
			{ name: "1 month", value: 1},
			{ name: "2 months", value: 2}
		],
		footnote: "The results of the calculator are preliminary. Please consult our bank specialists for more accurate calculations",
		startdate: moment().format('DD/MM/YYYY')
	}

	$scope.depositResult = [
	/*
		{
			date: "01/01/2017",
			amount_principal: "1000",
			amount_replenishment : "200",
			amount_interest: "200",
		}
	*/
	]

	// global result
	$scope.depositResult['global'] = {
		amount_principal : 0,
		amount_interest : 0
	}

	$scope.showReplenishment = function(number){

		if(number == 1){

			return true;

		}

		return false;

	}

	// set initial values
	$scope.initialValues = function(depositProductRate){

		$scope.depositFields.term.value = depositProductRate.period;
		$scope.depositFields.amount_principal.value = depositProductRate.amount_min;

	}

	// move to js library

	$scope.toNumber = function(numberString){
		return parseInt(numberString);
	}

	$scope.round = function(number){
        return parseFloat(number).toFixed(2)
    }
    
    $scope.prettyView = function(number){
        return $scope.round(number).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        //return number.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
    }

    $scope.getDepositInterestRate = function(product, term, amount){

    	var product;

    	var products = $filter('filter')($scope.depositProductRates,
    		{ "product_id": product.toString() }, true);

    	// cantidad de configuraciones para el mismo producto
    	var products_count = products.length;

    	// plazo maximo del producto
    	var product_term = 0;

    	// plazo minimo del producto
    	var product_term_last = 0;

    	for(var i = 0; i < products_count; i++){

    		product_term = parseInt(products[i].period);

			//if(product_term_last <= term && term <= product_term) {
			if( product_term_last <= term && term <= product_term &&
				amount <= products[i].amount_max)
			{

				// Toma el producto que tiene el rango de meses
				product = products[i];

				// stop for loop
				break;

			}		

			// term of the last product configuration
			product_term_last = product_term +1;

    	}

		return product;

    }

	$scope.depositCalculatorMain = function(){

		var date = document.getElementById('startdate').value;
		date = moment(date, "DD/MM/YYYY");
        
        // Si no recibe valores, asigna por defecto
        if(!date.isValid()){ 
            date = moment();
            jQuery('#loan_start').attr('placeholder',  moment().format('DD/MM/YYYY'));
        }
        

		var term = $scope.depositFields.term.value;
		var amount_principal = $scope.toNumber($scope.depositFields.amount_principal.value);
		var amount_replenishment = $scope.toNumber($scope.depositFields.amount_replenishment.value);
		

		var amount_interest_accumulated = 0;
		var month_no = 1;
		var global_amount_principal =0;
		var global_amount_interest =0;

		$scope.depositResult = [];

		for(var i = 1; i <= term; i++){

			var product_rate_settings = $scope.getDepositInterestRate($scope.depositProduct.id, term, global_amount_principal);

			// fecha anterior y fecha actual
			var datelast = date;
			var date = moment(datelast).add(1, 'M');


			// dias entre fechas
			var daysdiff = date.diff(datelast, 'days');

			// porcentaje anual de interes
			var interest_percent_annual = parseFloat(product_rate_settings.interest) / 100;
			var interest_percent_annual_bonus = $scope.toNumber(product_rate_settings.interest_bonus) / 100;


			// porcentaje de interes segun saldo de capital
			var amount_interest = daysdiff * interest_percent_annual * amount_principal / 365;

			// total global de ahorro
			global_amount_principal = amount_principal;
			global_amount_interest += amount_interest;

			$scope.depositResult.push({

				date: date.format('DD/MM/YYYY'),
				amount_principal: $scope.prettyView(amount_principal),
				amount_replenishment : $scope.prettyView(amount_replenishment),
				amount_interest: $scope.prettyView(amount_interest)

			});

			// * Next period calc

			// Saldo de capital segun configuracion de producto
			if( $scope.depositProduct.replenishment == 1){

				amount_principal = amount_principal + amount_replenishment;

			}
			
			amount_interest_accumulated += amount_interest;

			// * Verifica si debe capitalizar interes

			// capitalizacion a finde año calendario
			if( $scope.depositProduct.capitalization == "endyear" ){
				
				// es fin de año para capitalizar ?
				if (date.format('MM') == '12'){

					amount_principal += amount_interest_accumulated;
					amount_interest_accumulated = 0;

				}

			}else{

				// doce meses despues de aperturar la cuenta
				if(month_no == 12){

					amount_principal += amount_interest_accumulated;		
					amount_interest_accumulated = 0;

				}

			}

			if(month_no == 12){
				month_no=1;
			}

			// Numero de meses
			month_no++;

		}

		// Verifica si el producto tiene bono
		var amount_bonus = 0;

		if(product_rate_settings.interest_bonus > 0){
			product_rate_settings.interest_bonus = product_rate_settings.interest_bonus / 100;
			amount_bonus = global_amount_principal * product_rate_settings.interest_bonus;

		}

		$scope.depositResult['global'] = {
			amount_principal : $scope.prettyView(global_amount_principal),
			amount_interest : $scope.prettyView(global_amount_interest),
			amount_balance: $scope.prettyView(global_amount_principal+ global_amount_interest),
			amount_bonus: $scope.prettyView(amount_bonus)
		}

	}

	// set initial values
	$scope.initialValues($scope.depositProductRates[0]);

	jQuery( document ).ready(function(){

		jQuery( "#startdate" ).datepicker({
            inline: true,
            dateFormat: "dd/mm/yy"
        });

	});

});