var app = angular.module('useCaseManagement', ['ngRoute', 'SuccessMessage']);

app.config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/application', {
            templateUrl: 'view/application.html',
            controller: 'ApplicationController'
        }).when('/use-case', {
            templateUrl: 'view/use-case.html',
            controller: 'UseCaseController'
        }).when('/actors', {
            templateUrl: 'view/actors.html',
            controller: 'ActorsController'
        }).when('/steps', {
            templateUrl: 'view/steps.html',
            controller: 'StepsController'
        }).when('/version', {
            templateUrl: 'view/version.html',
            controller: 'VersionController'
        }).otherwise({
            templateUrl: 'view/dashboard.html',
            controller: 'DashboardController'
        });
    }]);