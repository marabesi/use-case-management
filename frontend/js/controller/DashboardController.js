app.controller('DashboardController',['$scope', 'UseCaseFactory', function($scope, UseCaseFactory) {
    $scope.total = 0;
    $scope.totalDeleted = 0;

    $scope.count = function() {
        UseCaseFactory.fetchTotalNotDeleted().then(function(response) {
            $scope.total = response.data.data;
        });

        UseCaseFactory.fetchTotalDeleted().then(function(response) {
            $scope.totalDeleted = response.data.data;
        });
    }

    $scope.count();
}]);