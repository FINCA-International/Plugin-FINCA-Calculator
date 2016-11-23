<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://finca.org
 * @since      1.0.0
 *
 * @package    Finca_Calculator
 * @subpackage Finca_Calculator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Finca_Calculator
 * @subpackage Finca_Calculator/public
 * @author     Luis Gomez Donis <luis.gomez@finca.org>
 */
class FINCA_Calculator_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode( 'finca-calculator', array($this, 'finca_calculator') );

	}

	public function finca_calculator(){
		?>

<section id="FINCA-Calculator" class="calculatorapp kg" ng-app="FINCA-App" ng-controller="FINCA-CalculatorController">

    <article id="FINCA-Calculator_fields">

        <form>

            <div>
                <label>Amount</label>
                <input type='number' id="loan_amount" placeholder="1,000.00" ng-model="calculatorFields.loan" ng-change="fnBasicLoan()">
            </div>

            <div>
                <label>Term in Months</label>
                <input type='number' id="loan_month" placeholder="12" ng-model="calculatorFields.term" ng-change="fnBasicLoan()">
            </div>
            
            <div>
                <label>Annual percent %</label>
                <input type='number' id="loan_int" placeholder="20" ng-model="calculatorFields.interest" ng-change="fnBasicLoan()">
            </div>

            <div>
                <label>Start date</label>
                <input type='text' id="loan_start" ng-model="calculatorFields.dateStart">
            </div>

            <div>
                <input type="button" ng-click="BCalculatorTest()">                
            </div>

        </form>

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

                /*
                console.log('interes: ' + montly_interest);
                console.log('loan: ' + loan);
                console.log('term: ' + term);
                console.log('cuota: ' + paymentAmount);
                */

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

                    /*
                    console.log('Fecha anterior: ' + paymentDateLast.format('DD/MM/YYYY'));
                    console.log('Fecha actual: ' + paymentDate.format('DD/MM/YYYY'));
                    console.log('Dias diff: ' + paymentDate.diff(paymentDateLast, 'days'));
                    console.log('-   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -');
                    */

                    payment_interes = (payment_balance * ($scope.calculatorFields.interest/100)) / 12;

                    //*
                    console.log('balance: ' + payment_balance);
                    console.log('interes: ' + $scope.calculatorFields.interest);
                    console.log('pagado: ' + payment_interes);
                    // */

                    
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
	</script>

		<?php




	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/finca-calculator-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
        
        wp_enqueue_script( $this->plugin_name . '-moment', plugin_dir_url( __FILE__ ) . 'js/moment.min.js');
        wp_enqueue_script( $this->plugin_name . '-calculator', plugin_dir_url( __FILE__ ) . 'js/finca-calculator-public.js', array('moment'), $this->version, false );

        wp_enqueue_script( $this->plugin_name . '-angular', plugin_dir_url( __FILE__ ) . 'js/angular.min.js');
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/finca-calculator-public.js', array( 'jquery' ), $this->version, false );

	}

}
