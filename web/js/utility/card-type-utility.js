/**
 * @author Budi Arsana <gusdecool@gmail.com>
 */
(function() {

    /**
     * Card type utility
     *
     * @ngdoc service
     * @name CardTypeUtility
     */
    angular.module('app').factory('CardTypeUtility', CardTypeUtility);

    /**
     * @ngInject
     * @constructor
     */
    function CardTypeUtility() {

        /**
         * @class CardTypeUtility
         */
        return {

            /**
             * Get card type, return null if type not found
             *
             * @param {string} number
             * @returns {string|null}
             */
            getCardType: function(number) {
                if (this.isAmex(number) === true) return 'amex';
                if (this.isDiscover(number) === true) return 'discover';
                if (this.isMasterCard(number) === true) return 'master_card';
                if (this.isVisa(number) === true) return 'visa';

                return null;
            },

            /**
             * Check if card is amex
             * 
             * @param {string} number
             * @return {boolean}
             */
            isAmex: function(number) {
              return /(^34|^37)[0-9]{13}$/.test(number);
            },

            /**
             * Check if card is discover
             *
             * @param {string} number
             * @return {boolean}
             */
            isDiscover: function(number) {
                return /6011[0-9]{12}$/.test(number);
            },

            /**
             * Check if card is master card
             *
             * @param {string} number
             * @return {boolean}
             */
            isMasterCard: function(number) {
                return /(^51|^55)[0-9]{14}$/.test(number);
            },

            /**
             * Check if card is visa
             *
             * @param {string} number
             * @return {boolean}
             */
            isVisa: function(number) {
                return /^4([0-9]{12}|[0-9]{15})$/.test(number);
            }
        }
    }
})();