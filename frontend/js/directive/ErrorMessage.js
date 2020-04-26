angular.module('errorMessage', [])
    .directive('errorMessage', ['$timeout', function($timeout) {
        return {
            restrict: 'E',
            templateUrl: 'view/partial/errorMessage.html',
            scope: {
                error: '=error'
            },
            transclude: true,
            link: function(scope) {
                scope.$watch(function() {
                    if (scope.error === true) {
                        $timeout(function() {
                            scope.error = false;
                        }, 15000);
                    }
                });
            }
        }
}]);