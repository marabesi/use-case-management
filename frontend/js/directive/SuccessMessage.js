angular.module('SuccessMessage', [])
    .directive('successMessage', ['$timeout', function($timeout) {
        return {
            restrict: 'E',
            templateUrl: 'view/partial/successMessage.html',
            scope: {
                submitted: '=submitted'
            },
            transclude: true,
            link: function(scope) {
                scope.$watch(function() {
                    if (scope.submitted === true) {
                        $timeout(function() {
                            scope.submitted = false;
                        }, 2000);
                    }
                });
            }
        }
}]);