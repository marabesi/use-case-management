app.controller('UseCaseController', ['$scope', '$timeout', function($scope, $timeout) {
    $scope.application = [
        {name: 'system 1'}
    ]
    
    $scope.useCases = [
        {application: 'System1', description: 'test', status: 'active'},
        {application: 'System2', description: 'test2', status: 'active'}
    ]
    
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