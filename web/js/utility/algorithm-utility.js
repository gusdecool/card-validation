/**
 * @author Budi Arsana <gusdecool@gmail.com>
 */
(function() {

    /**
     * Card type utility
     *
     * @ngdoc service
     * @name AlgorithmUtility
     */
    angular.module('app').factory('AlgorithmUtility', AlgorithmUtility);

    /**
     * @ngInject
     * @constructor
     */
    function AlgorithmUtility() {

        /**
         * @class AlgorithmUtility
         */
        return {

            /**
             * Get card type, return null if type not found
             *
             * @param {string} number
             * @returns {boolean}
             */
            isValidLuhnAlgorithm: function(number) {
                number.toString();

                var sum = 0, flip = 0, sumTable = [
                    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    [0, 2, 4, 6, 8, 1, 3, 5, 7, 9]
                ];

                for (var i = number.length - 1; i >= 0; i--) {
                    sum += sumTable[flip++ % 2][number[i]];
                }

                return sum % 10 === 0;
            }
        }
    }
})();