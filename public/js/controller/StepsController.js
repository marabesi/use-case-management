app.controller('StepsController', ['$scope', function($scope) {
    $scope.steps = [
        {}
    ];
    
    $scope.createNewStep = function() {
        var step = {};
        
        $scope.steps.unshift(step);
    }
}]);