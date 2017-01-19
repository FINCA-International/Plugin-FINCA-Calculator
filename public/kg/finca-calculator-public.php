<script type="text/javascript" src="http://45.55.159.225/wp-includes/js/jquery/ui/datepicker.min.js"></script>
<section id="finca-calculator" class="finca-calculator-kg"
    ng-app="finca-calculator-app-kg" ng-controller="finca-calculator-app-kg-controller">

    <script>
    var data_calculator = <?php echo json_encode(data()) ?>;
    </script>

    <div class="calculator">

        <table class="calculator_form">
            <tbody>
                <tr>
                    <td><label>Product</label></td>
                    <td><select ng-options="option.name for option in depositProducts"
                        ng-model="depositProduct"></select></td>
                </tr>

                <tr class="amount">
                    <td><label>Deposit Amount</label></td>
                    <td>
                        <input type="text" name="principal_amount"
                            ng-model="depositFields.amount_principal.value">
                        <select ng-options="option.text for option in depositCurrencies"
                            ng-model="depositCurrency"></select>
                    </td>
                </tr>

                <tr ng-show="showReplenishment(depositProduct.replenishment)">
                    <td><label>Replenishment amount</label></td>
                    <td><input type="text" name="amount_replenishment"
                        ng-model="depositFields.amount_replenishment.value"></td>
                </tr>

                <tr>
                    <td><label>Term (months)</label></td>
                    <td><input type="text" name="term"
                        ng-model="depositFields.term.value"></td>
                </tr>

                <tr>
                    <td><label>Start date</label></td>
                    <td><input type='text' id="startdate" placeholder="{{ depositOptions.startdate }}"></td>
                </tr>

                <tr>
                    <td></td>
                    <td><button class="Button orange" ng-click="depositCalculatorMain()">CALCULATE</button></td>
                </tr>

            </tbody>
        </table>

        <table class="calculator_resume" ng-show="depositResult['global'].amount_principal != 0">
            <thead>
                <tr>
                    <th colspan="2">Your results:</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <th>Deposit</th>
                    <td>{{ depositResult['global'].amount_principal }} {{ depositCurrency.text }}</td>
                </tr>
                <tr>
                    <th>Interest</th>
                    <td>{{ depositResult['global'].amount_interest }} {{ depositCurrency.text }}</td>
                </tr>
                <tr>
                    <th>Balance</th>
                    <td>{{ depositResult['global'].amount_balance }} {{ depositCurrency.text }}</td>
                </tr>
            </tbody>

        </table>
    </div>
    <div class="result"
         ng-show="depositResult['global'].amount_principal != 0">
        
        <br>
        <p class="center">Calculator details</p>
        <table class="">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Main amount</th>
                    <th ng-show="showReplenishment(depositProduct.replenishment)">Replenishment amount</th>
                    <th>Interest ({{ depositProduct.interest_percent_annual }}%)</th>
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

