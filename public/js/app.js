var app = angular.module('useCaseManagement', ['ngRoute', 'SuccessMessage', 'pascalprecht.translate']);

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
    }])
    .config(function($translateProvider) {
        $translateProvider.translations('en', {
            USE_CASE_MANAGEMENT: 'Use Case Management',
            LANGUAGE: 'Language',
            CURRENT_LANGUAGE: 'Current language',
            COMPLEMENTARY_INFORMATION: 'Complementary information',
            REQUIRED_FIELD: 'Field required',
            CREATE: 'Create',
            DESCRIPTION: 'Description',
            ELEMENTS: 'Elements',
        })
        .translations('ptBR', {
            USE_CASE_MANAGEMENT: 'Gerenciador de Caso de Uso',
            LANGUAGE: 'Idioma',
            CURRENT_LANGUAGE: 'Idioma atual',
            COMPLEMENTARY_INFORMATION: 'Informação complementar',
            REQUIRED_FIELD: 'Campo obrigatório',
            CREATE: 'Criar',
            DESCRIPTION: 'Descrição',
            ELEMENTS: 'Elementos',
        });
        
        $translateProvider.preferredLanguage('ptBR');
    });