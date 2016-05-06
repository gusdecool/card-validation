/**
 * @author Budi Arsana <gusdecool@gmail.com>
 */
(function() {

    /**
     * @name CreditCard
     * @type {{
     *      id: number,
     *      name: string,
     *      postcode: string,
     *      credit_card_number: string,
     *      type: string
     * }}
     */

    /**
     * @ngdoc controller
     * @name CreditCardFormController
     */
    angular.module('app').controller('CreditCardFormController', CreditCardFormController);

    /**
     * @constructor
     * @param $scope
     * @param {CardTypeUtility} CardTypeUtility
     * @param $http
     * @param Notification
     */
    function CreditCardFormController($scope, CardTypeUtility, $http, Notification) {

        //---------------------------------------------------------------------------------------------
        // Scope variables
        //---------------------------------------------------------------------------------------------

        $scope.creditCard = {};



        //---------------------------------------------------------------------------------------------
        // Scope functions
        //---------------------------------------------------------------------------------------------

        /**
         * Submit credit card
         *
         * @param {CreditCard} creditCard
         * @param form
         */
        $scope.submit = function(creditCard, form) {
            $http.post('/', creditCard).then(
                function() {
                    Notification.primary('credit card saved!');
                    $scope.creditCard = {};
                    form.$setPristine();
                },
                function(response) {
                    Notification.error(response.data.message);
                }
            )
        };

        /**
         * Apply card type
         *
         * @param {CreditCard} creditCard
         */
        $scope.applyCardType = function(creditCard) {
            creditCard.type = CardTypeUtility.getCardType(creditCard.credit_card_number);
        };
    }
})();