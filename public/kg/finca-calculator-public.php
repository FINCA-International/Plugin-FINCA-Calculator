<?php
global $wpdb;
$deposit_product = $wpdb->get_results("SELECT id, name, capitalization, replenishment FROM deposit_calculator_product;");

$deposit_product_rate = $wpdb->get_results("SELECT product_id,currency_id,period,interest,amount_min,amount_max,interest_bonus FROM deposit_calculator_product_rate;");


?>

<script type="text/javascript" src="http://45.55.159.225/wp-includes/js/jquery/ui/datepicker.min.js"></script>
<section id="finca-calculator" class="finca-calculator-kg"
    ng-app="finca-calculator-app-kg" ng-controller="finca-calculator-app-kg-controller">

    <script>

    var savings_data_currency = <?php echo json_encode(data()) ?>;
    var savings_data_product = <?php echo json_encode($deposit_product); ?>;
    var savings_data_product_rates = <?php echo json_encode($deposit_product_rate); ?>;

    </script>

    <div class="calculator">

        <table class="calculator_form">
            <tbody>
                <tr>
                    <td><label><?php echo __('Product', 'finca-calculator') ?></label></td>
                    <td><select ng-options="option.name for option in depositProducts"
                        ng-model="depositProduct"></select></td>
                </tr>

                <tr class="amount">
                    <td><label><?php echo __('Deposit Amount', 'finca-calculator') ?></label></td>
                    <td>
                        <input type="text" name="principal_amount"
                            ng-model="depositFields.amount_principal.value">
                        <select ng-options="option.text for option in depositCurrencies"
                            ng-model="depositCurrency"></select>
                    </td>
                </tr>

                <tr ng-show="showReplenishment(depositProduct.replenishment)">
                    <td><label><?php echo __('Replenishment amount', 'finca-calculator') ?></label></td>
                    <td><input type="text" name="amount_replenishment"
                        ng-model="depositFields.amount_replenishment.value"></td>
                </tr>

                <tr>
                    <td><label><?php echo __('Term (months)', 'finca-calculator') ?></label></td>
                    <td><input type="text" name="term"
                        ng-model="depositFields.term.value"></td>
                </tr>

                <tr>
                    <td><label><?php echo __('Start date', 'finca-calculator') ?></label></td>
                    <td><input type='text' id="startdate" placeholder="{{ depositOptions.startdate }}"></td>
                </tr>

                <tr>
                    <td></td>
                    <td><button class="Button orange" ng-click="depositCalculatorMain()"><?php echo __('CALCULATE', 'finca-calculator') ?></button></td>
                </tr>

            </tbody>
        </table>

        <table class="calculator_resume" ng-show="depositResult['global'].amount_principal != 0">
            <thead>
                <tr>
                    <th colspan="2"><?php echo __('Your results', 'finca-calculator') ?>:</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <th><?php echo __('Deposit', 'finca-calculator') ?></th>
                    <td>{{ depositResult['global'].amount_principal }} {{ depositCurrency.text }}</td>
                </tr>
                <tr>
                    <th><?php echo __('Interest', 'finca-calculator') ?></th>
                    <td>{{ depositResult['global'].amount_interest }} {{ depositCurrency.text }}</td>
                </tr>
                <tr>
                    <th><?php echo __('Balance', 'finca-calculator') ?></th>
                    <td>{{ depositResult['global'].amount_balance }} {{ depositCurrency.text }}</td>
                </tr>
                <tr ng-show="depositResult['global'].amount_bonus != 0">
                    <th><?php echo __('Bonus', 'finca-calculator') ?></th>
                    <td>{{ depositResult['global'].amount_bonus }} {{ depositCurrency.text }}</td>
                </tr>
            </tbody>

        </table>
    </div>
    <div class="result"
         ng-show="depositResult['global'].amount_principal != 0">
        
        <br>
        <p class="center"><?php echo __('Calculator details', 'finca-calculator') ?></p>
        <table class="">
            <thead>
                <tr>
                    <th><?php echo __('Date', 'finca-calculator') ?></th>
                    <th><?php echo __('Main amount', 'finca-calculator') ?></th>
                    <th ng-show="showReplenishment(depositProduct.replenishment)"><?php echo __('Replenishment amount', 'finca-calculator') ?></th>
                    <th><?php echo __('Interest', 'finca-calculator') ?> ({{ depositProduct.interest_percent_annual }}%)</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="result in depositResult">
                    <td>{{ result.date }}</td>
                    <td>{{ result.amount_principal }}</td>
                    <td ng-show="showReplenishment(depositProduct.replenishment)">{{ result.amount_replenishment }}</td>
                    <td>{{ result.amount_interest }}</td>
                </tr>
            </tbody>
            <tfoot ng-show="depositResult['global'].amount_principal != 0">
                <tr>
                    <td></td>
                    <td ng-show="showReplenishment(depositProduct.replenishment)"></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <div class="table_footer">
            <p>{{ depositOptions.footnote }}</p>
        </div>
    </div>

</section>

