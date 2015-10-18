var app = angular.module('useCaseManagement', ['ngRoute']);

app.config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/application', {
            templateUrl: 'view/application.html',
            controller: 'ApplicationController'
        }).otherwise({
            templateUrl: 'view/dashboard.html',
            controller: 'DashboardController'
        });
    }]);