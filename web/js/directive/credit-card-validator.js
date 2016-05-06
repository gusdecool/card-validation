/**
 * @author Budi Arsana <gusdecool@gmail.com>
 */
(function() {

    /**
     * @ngdoc directive
     * @name creditCardValidator
     */
    angular.module('app').directive('creditCardValidator', creditCardValidator);

    /**
     * @param {AlgorithmUtility} AlgorithmUtility
     * @param {CardTypeUtility} CardTypeUtility
     * @returns {{restrict: string, require: string, link: link}}
     */
    function creditCardValidator(AlgorithmUtility, CardTypeUtility) {

        return {
            restrict: 'A',
            require: 'ngModel',
            link: function(scope, element, attr, ctrl) {

                /**
                 * Validate credit card
                 *
                 * @param {string} ngModelValue
                 * @returns {string}
                 */
                function validateCreditCard(ngModelValue) {
                    if (CardTypeUtility.getCardType(ngModelValue) === null ||
                        AlgorithmUtility.isValidLuhnAlgorithm(ngModelValue) === false
                    ) {
                        ctrl.$setValidity('creditCard', false);
                    } else {
                        ctrl.$setValidity('creditCard', true);
                    }

                    return ngModelValue;
                }

                ctrl.$parsers.push(validateCreditCard);
            }
        };
    }
})();