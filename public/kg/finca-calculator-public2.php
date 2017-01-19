<section id="finca-calculator" class="finca-calculator-kg"
    ng-app="finca-calculator-app-kg" ng-controller="finca-calculator-app-kg-controller">


    <div class="deposit-questionary">
        <div class="header">
            Questions to choose the correct product
        </div>

        <?php // Question #01 ?>
        <form class="question">
            <p>In which currency do you want to save? #1</p>
            <div class="choices">
                <label>
                    <input type="radio" name="deposit-currency" value="dollar" ng-model="deposit.currency">
                    Dollar
                </label>
                <label>
                    <input type="radio" name="deposit-currency" value="ruble" ng-model="deposit.currency">
                    Ruble
                </label>
                <label>
                    <input type="radio" name="deposit-currency" value="som" ng-model="deposit.currency">
                    Som
                </label>
            </div>
        </form>

        <?php
        /*
            Question #02
            Show the cuestion only if:
                currency is not empty

        */?>
        <form class="question" ng-show="deposit.currency">
            <p>Do you want to make replenishment? #2</p>
            <div class="choices">
                <label>
                    <input type="radio" name="deposit-replenishment" value="1" ng-model="deposit.with_replenishment">
                    yes
                </label>
                <label>
                    <input type="radio" name="deposit-replenishment" value="0" ng-model="deposit.with_replenishment">
                    no
                </label>
            </div>
        </form>

        <?php
        /*
            Question #03
            Show te question only if:
            Question 2 is iqual to 0
        */?>
        <form class="question"
            ng-show="deposit.currency && deposit.with_replenishment == 0">
            <p>Consider the following products #3</p>
            <div class="choices-product">
                <p> Product description
                    <br/><input type="radio" name="deposit-product" value="altynBulak" ng-model="deposit.product">
                    Altyn-Bulak
                </p>
                <p> Product description
                    <br/><input type="radio" name="deposit-product" value="kireshe" ng-model="deposit.product">
                    Kireshe
                </p>
            </div>
        </form>

        <?php
        /*
            Question #04
            Show te question only if:
            Question 3 is not empty
        */?>
        <form class="question"
            ng-show="deposit.currency && deposit.with_replenishment == 0 && deposit.product">
            <p>Consider the following products #4</p>
            <div class="choices-product">
                <label>Term
                    <select ng-model="deposit.term">
                        <option value="2">2 month</option>
                        <option value="4">4 month</option>
                        <option value="6">6 month</option>
                    </select>
                </label>
            </div>
        </form>

        <?php
        /*
            Question #05
            Show only if:
                Question 1 is not empty
                Question 2 is iqual to 1

        */?>
        <form class="question"
            ng-show="deposit.currency
                    && deposit.with_replenishment == 1">
            <p>Replenishment period? #05</p>
            <div class="choices">
                <label>
                    <input type="radio" name="deposit-replenishment-period" value="1"
                    ng-model="deposit.replanishment_period">
                    Monthly
                </label>
                <label>
                    <input type="radio" name="deposit-replenishment" value="0"
                    ng-model="deposit.replanishment_period">
                    Schedule
                </label>
            </div>
        </form>

        <?php
        /*
            Question #06
            Show only if:
                Question 1 is not empty
                Question 2 is iqual to 1
                Question 5 is iqual to 0

        */?>
        <form class="question"
            ng-show="deposit.currency
                    && deposit.with_replenishment == 1
                    && deposit.replanishment_period == 0">
            <p>Frecuency #6</p>
            <div class="choices">
                <label>
                    <select ng-model="deposit.replanishment_frecuency">
                        <option value="2">2 month</option>
                        <option value="4">4 month</option>
                        <option value="6">6 month</option>
                    </select>
                </label>
            </div>
        </form>

        <?php
        /*
            Question #07
            Show only if:
                Question 1 is not empty
                Question 2 is iqual to 1
                Question 5 is iqual to 0
                Question 6 is not empty

        */?>
        <form class="question"
            ng-show="deposit.currency
                    && deposit.with_replenishment == 1
                    && deposit.replanishment_period == 0
                    && deposit.replanishment_frecuency">
            <p>Amount #07</p>
            <div class="choices">
                <label>Amount
                    <input type="text" name="amount" ng-model="deposit.replanishment_amount">
                </label>
            </div>
        </form>

        {{deposit}}

    </div>

</section>
<?php
/*
<section id="FINCA-Calculator" class="calculatorapp kg" ng-app="FINCA-App" ng-controller="FINCA-CalculatorController">
    
    <article id="FINCA-Calculator_fields">

        <form>

            <div>
                <label>Amount</label>
                <input type='number' id="loan_amount" placeholder="1,000.00" ng-model="calculatorFields.loan">
            </div>

            <div>
                <label>Term in Months</label>
                <input type='number' id="loan_month" placeholder="12" ng-model="calculatorFields.term">
            </div>
            
            <div>
                <label>Annual percent %</label>
                <input type='number' id="loan_int" placeholder="20" ng-model="calculatorFields.interest">
            </div>

            <div>
                <label>Currency</label>
                <select ng-options="option.name for option in loanCurrencies track by option.value"
                        ng-model="loanCurrency">
                </select>
            </div>

            <div>
                <label>Product</label>
                <select ng-options="option.name for option in loanProducts track by option.value"
                        ng-model="loanProduct">
                </select>
            </div>

            <div ng-hide="loanProduct.value == 1">
                <label>Start date</label>
                <input type='text' id="loan_start">
            </div>

            <div>
                <button type="submit" ng-click="fnBasicLoan()">Calc</button>
            </div>

        </form>

    </article>

    <article class="finca-calculator-kg-desition-tree">

        <div class="choice">
            <p>choice description</p>
            <form class="options">
                <label>Option 1
                    <input name="choice-1" type="radio" value="1" ng-model="choice1">
                </label>
                <label>Option 2
                    <input name="choice-1" type="radio" value="2" ng-model="choice1">
                </label>
                selection {{ choice1 }}
            </form>
        </div>

        <div class="choice" ng-show="choice1 == 1">
            <p>choice description</p>
            <form class="options">
                <label>Option 1
                    <input name="choice-1" type="radio" value="1">
                </label>
                <label>Option 2
                    <input name="choice-1" type="radio" value="2">
                </label>
                
            </form>
        </div>
        
    </article>
    <article id="FINCA-Calculator_result">

        <!-- h3 class="hidden">Payment schedule</h3 -->
        
        <table id="FINCALoanCalculator_table">

            <thead>
                <tr>
                	<th>No.</th>
                	<th>Payment date</th>
                	<th>Payment amount</th>
                	<th>Primary loan</th>
                	<th>Interest amount</th>
                	<th>Balance</th>
                </tr>
            </thead>
            <tbody>
        		<tr ng-repeat="result in calculatorResult">
        			<td>{{ result.no }}</td>
        			<td>{{ result.paymentDate }}</td>
        			<td>{{ result.paymentAmount }}</td>
        			<td>{{ result.primaryLoan }}</td>
        			<td>{{ result.interestAmount }}</td>
        			<td>{{ result.balanceAmount }}</td>
        		</tr>
            </tbody>

        </table>

    </article>
    
    <article id='FINCALoanCalculator_disclaimer'>
        
    </article>

</section>


	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js"></script>
	<script>
    


		var FINCApp = angular.module('FINCA-App', []);
		FINCApp.controller('FINCA-CalculatorController', function ($scope, $filter) {

			// Containers
			$scope.calculatorResult = [];
			$scope.calculatorFields = {
                loan: 10000,
                term: 12,
                interest: 25, // -> lo convierte a %
                dateStart: moment()
            };

            $scope.choice2_product1 = false;
            $scope.choice1;

            $scope.loanProducts = [{name: "Product one", value: 0},{name: "Product two", value: 1}];
            $scope.loanCurrencies = [{name: "Dollar", value: 1}];
            $scope.loanProduct = {};

			// Calculated fields
			$scope.termQuantity = 12;
            $scope.termType = "months";

			// Functions

            $scope.BCalculatorTest = function(){

            }

            // Format date
            $scope.formatDate = function (dateObject){

                // Configurable el formato
                return dateObject.format('DD/MM/YYYY')

            }

            // Remove decimals 1000.00 -> 1000
            $scope.formatRemoveDecimals = function(amount){

                // Configurable los decimales
                return parseFloat(amount).toFixed(2);// -> quita decimales

            }

            // Format money 10,000.00
            $scope.formatMoney = function (amount){

                // Configurable los decimales
                return $scope.formatRemoveDecimals(amount).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                ///return amount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
            }


            // Cuota nivelada
            $scope.formulaCuotaNivelada = function(loan, interest, term){

                // loan - monto total del prestamo
                // term - plazo del prestamo en meses
                // interest - monto de interes anual

                // Convierte el % de interes anual a mensual
                // (interest / 100) -> convierte el interes a %
                var montly_interest = (interest / 100) / 12;

                // FORMULA ESTANDAR DE CALCULO
                // Cuota = monto * inter /( 1 - 1/((1+inter) ^ meses)
                var paymentAmount =  (montly_interest * loan) / (1 - Math.pow(( 1 + montly_interest), - term));

                / *
                console.log('interes: ' + montly_interest);
                console.log('loan: ' + loan);
                console.log('term: ' + term);
                console.log('cuota: ' + paymentAmount);
                * /

                return paymentAmount;
                
            }

            // Obtiene la cuota a pagar segun la formula seleccionada
            $scope.getPaymentAmount = function(loan, interest, term){

                return $scope.formulaCuotaNivelada(loan, interest, term);

            }            

            

			// Calc basic loan
			$scope.fnBasicLoan = function() {

                $scope.calculatorResult = [];

                var
                payment_amount = 0,
                payment_capital = 0,
                payment_interes = 0,
                payment_term = $scope.calculatorFields.term,
                payment_balance = $scope.calculatorFields.loan,
                payment_date = $scope.calculatorFields.dateStart,
                payment_date_last = payment_date,
                payment_amount = $scope.getPaymentAmount(
                    $scope.calculatorFields.loan, 
                    $scope.calculatorFields.interest,
                    $scope.calculatorFields.term
                );


				for(var i = 0; i < payment_term; i++){

                    // Nuevo objeto con el plan de pagos
                    var result = new Object;

                    // Numero de cuota
                    result.no = (i + 1);

                    // Ultima fecha de pago
                    payment_date_last = payment_date;

                    // Se obtiene la fecha de pago del proximo mes
                    payment_date = moment(payment_date).add(1, 'M');

                    // Dias entre cuotas
                    // paymentDateDiff = payment_date.diff(paymentDateLast, 'days');

                    / *
                    console.log('Fecha anterior: ' + paymentDateLast.format('DD/MM/YYYY'));
                    console.log('Fecha actual: ' + paymentDate.format('DD/MM/YYYY'));
                    console.log('Dias diff: ' + paymentDate.diff(paymentDateLast, 'days'));
                    console.log('-   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -');
                    * /

                    payment_interes = (payment_balance * ($scope.calculatorFields.interest/100)) / 12;

                    / *
                    console.log('balance: ' + payment_balance);
                    console.log('interes: ' + $scope.calculatorFields.interest);
                    console.log('pagado: ' + payment_interes);
                    // * /

                    
                    // Total de capital que se va a pagar
                    payment_capital = payment_amount - payment_interes;

                    // Actualiza el balance de saldos
                    payment_balance = payment_balance - payment_capital;
                    


                    // Se asigna la fecha de pago
                    result.paymentDate = payment_date.format('DD/MM/YYYY');

                    result.paymentAmount= $scope.formatMoney(payment_amount);

                    result.primaryLoan= $scope.formatMoney(payment_capital);

                    result.interestAmount= $scope.formatMoney(payment_interes);
                    
                    result.balanceAmount= $scope.formatMoney(payment_balance);

				    $scope.calculatorResult.push( result );

				}


			}


			// Constructores
			$scope.fnBasicLoan();


		});

    jQuery(document).ready(function(){
        
        jQuery( "#loan_start" ).datepicker({
            inline: true,
            dateFormat: "dd/mm/yy",
            monthNames: [ 
            <?php
            // Se agregan los meses a la traduccion de cadenas de wordpress, se hace de esta forma
            // para poder reutilizar la traduccion en otras secciones del sitio web
            echo
            '"' . __('January','Panel') . '",' .
            '"' . __('February','Panel') . '",' .
            '"' . __('March','Panel') . '",' .
            '"' . __('April','Panel') . '",' .
            '"' . __('May','Panel') . '",' .
            '"' . __('June','Panel') . '",' .
            '"' . __('July','Panel') . '",' .
            '"' . __('August','Panel') . '",' .
            '"' . __('September','Panel') . '",' .
            '"' . __('October','Panel') . '",' .
            '"' . __('November','Panel') . '",' .
            '"' . __('December','Panel') . '"' ;
            ?>],
            dayNamesMin: [
            <?php
            // Se agregan los dias a la traduccion de cadenas de wordpress, se hace de esta forma
            // para poder reutilizar la traduccion en otras secciones del sitio web
            echo
            '"' . __('Su','Panel') . '",' .
            '"' . __('Mo','Panel') . '",' .
            '"' . __('Tu','Panel') . '",' .
            '"' . __('We','Panel') . '",' .
            '"' . __('Th','Panel') . '",' .
            '"' . __('Fr','Panel') . '",' .
            '"' . __('Sa','Panel') . '",' ;
            ?>
            ]
        });

    });    


	</script>
*/
?>