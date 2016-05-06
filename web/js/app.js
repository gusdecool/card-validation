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
    angular.module('app', ['ui.bootstrap', 'ui-notification', 'ngMessages'])
        .config(configInterpolation)
        .config(configNotification);

    /**
     * Change angular default interpolation since conflict with twig
     * @param $interpolateProvider
     */
    function configInterpolation($interpolateProvider) {
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    }

    function configNotification(NotificationProvider) {
        NotificationProvider.setOptions({
            delay: 10000,
            startTop: 20,
            startRight: 10,
            verticalSpacing: 20,
            horizontalSpacing: 20,
            positionX: 'center',
            positionY: 'top'
        });
    }
})();
