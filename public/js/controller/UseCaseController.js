app.controller('UseCaseController', ['$scope', '$timeout', function($scope) {
    $scope.application = [
        {name: 'system 1'}
    ]
    
    $scope.options = [
        {name: '1.0.1'}
    ]
    
    $scope.useCases = []
    
    $scope.create = function() {
        var useCase = {
            application : $scope.useCase.application,
            description : $scope.useCase.description,
            status : $scope.useCase.status
        };
        
        $scope.useCases.push(useCase);
        $scope.useCase = null;
        $scope.submitted = true;
    }
}]);