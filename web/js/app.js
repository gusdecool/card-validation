/**
 * Angular App module
 *
 * @author Budi Arsana <gusdecool@gmail.com>
 */
(function() {

    /**
     * @ngdoc module
     * @name app
     */
    angular.module('app', ['ui.bootstrap', 'ngMessages'])
        .config(configInterpolation);

    /**
     * Change angular default interpolation since conflict with twig
     * @param $interpolateProvider
     */
    function configInterpolation($interpolateProvider) {
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    }
})();
