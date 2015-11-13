app.controller('ApplicationController', ['$scope', function($scope) {
    $scope.submitted = false;
    $scope.applications = [];
    
    $scope.create = function() {
        var app = {
            name: $scope.application.name
        }
        
        $scope.applications.push(app);
        $scope.submitted = true;
        $scope.application = null;
    }
}]);