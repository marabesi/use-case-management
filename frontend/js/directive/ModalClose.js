angular.module('modalClose', [])
    .directive('modalClose', function () {
        return {
            restrict: 'A',
            link: function (scope, element, attr) {
                scope.dismiss = function () {
                    $('#newElementModal').modal('hide');
                };
            }
        }
    });