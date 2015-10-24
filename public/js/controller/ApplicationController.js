app.controller('ApplicationController', ['$scope', function($scope) {
    $scope.submitted = false;
    $scope.applications = [
        {name: 'system1'},
        {name: 'system2'},
        {name: 'system3'},
    ];
    $scope.create = function() {
        var app = {
            name: $scope.application.name
        }
        
        $scope.applications.push(app);
        $scope.submitted = true;
        $scope.application = null;
    }
}]);