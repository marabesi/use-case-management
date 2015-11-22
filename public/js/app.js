var app = angular.module('useCaseManagement', ['ngRoute', 'SuccessMessage', 'pascalprecht.translate', 'ngTable', 'ngResource']);

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
            DASHBOARD: 'Dashboard',
            APPLICATION: 'Application',
            USE_CASE: 'Use Case',
            VERSION: 'Version',
            ACTORS: 'Actors',
            STEPS: 'Steps',
            ENGLISH: 'English',
            PORTUGUESE_PT_BR: 'Portuguese (PT-BR)',
            USE_CASE_MANAGEMENT: 'UseCaseManagement',
            LANGUAGE: 'Language',
            CURRENT_LANGUAGE: 'Current language',
            COMPLEMENTARY_INFORMATION: 'Complementary information',
            REQUIRED_FIELD: 'Field required',
            CREATE: 'Create',
            DESCRIPTION: 'Description',
            ELEMENTS: 'Elements',
            NAME: 'Name',
            NAME_IS_REQUIRED: 'Name is required',
            DESCRIPTION_IS_REQUIRED: 'Description is required',
            CREATE_ACTOR: 'Create actor',
            CREATE_USE_CASE: 'Create use case',
            WELL_DONE: 'Well done!',
            YOU_SUCCESSFULLY_CREATED_A_ACTOR: 'You successfully created a actor',
            YOU_SUCCESSFULLY_CREATED_A_USE_CASE: 'You successfully created a use case',
            ACTOR_LIST: 'Actor list',
            ACTOR_NOT_FOUND: 'Actor not found',
            APPLICATION_IS_REQUIRED: 'Application is required',
            VERSION_IS_REQUIRED: 'Version is required',
            STATUS: 'Status',
            CREATE_APPLICATION: 'Create application',
            UPDATE_APPLICATION: 'Update application',
            LIST_APPLICATION: 'Application list',
            APPLICATION_NOT_FOUND: 'Application not found',
            YOU_SUCCESSFULLY_CREATED_AN_APPLICATION: 'You successfully created an application',
            YOU_SUCCESSFULLY_CREATED_A_VERSION: 'You successfully created a version',
            VERSION_NAME_IS_REQUIRED: 'Version name is required',
            CREATE_VERSION: 'Create version',
            LIST_VERSION: 'List version',
            VERSION_NOT_FOUND: 'Version not found',
            ACTION: 'Action',
            DELETE: 'Delete',
            EDIT: 'Edit',
            CANCEL: 'Cancel',
        })
        .translations('ptBR', {
            DASHBOARD: 'Painel',
            APPLICATION: 'Sistema',
            USE_CASE: 'Caso de uso',
            VERSION: 'Versão',
            ACTORS: 'Atores',
            STEPS: 'Passos',
            ENGLISH: 'Inglês',
            PORTUGUESE_PT_BR: 'Português',
            USE_CASE_MANAGEMENT: 'Gerenciador de Caso de Uso',
            LANGUAGE: 'Idioma',
            CURRENT_LANGUAGE: 'Idioma atual',
            COMPLEMENTARY_INFORMATION: 'Informação complementar',
            REQUIRED_FIELD: 'Campo obrigatório',
            CREATE: 'Criar',
            DESCRIPTION: 'Descrição',
            ELEMENTS: 'Elementos',
            NAME: 'Nome',
            NAME_IS_REQUIRED: 'Nome é obrigatório',
            DESCRIPTION_IS_REQUIRED: 'Descrição é obrigatória',
            CREATE_ACTOR: 'Criar ator',
            CREATE_USE_CASE: 'Criar caso de uso',
            WELL_DONE: 'Muito bem!',
            YOU_SUCCESSFULLY_CREATED_A_ACTOR: 'Você criou um ator com sucesso',
            YOU_SUCCESSFULLY_CREATED_A_USE_CASE: 'Você criou um caso de uso com sucesso',
            ACTOR_LIST: 'Lista de atores',
            ACTOR_NOT_FOUND: 'Nenhum ator encontrado',
            APPLICATION_IS_REQUIRED: 'Nome do sistema é obrigatório',
            VERSION_IS_REQUIRED: 'Versão é obrigatória',
            STATUS: 'Status',
            CREATE_APPLICATION: 'Criar sistema',
            UPDATE_APPLICATION: 'Atualizar sistema',
            LIST_APPLICATION: 'Lista de sistemas',
            APPLICATION_NOT_FOUND: 'Nenhum sistema encontrado',
            YOU_SUCCESSFULLY_CREATED_AN_APPLICATION: 'Você criou um sistema com sucesso',
            YOU_SUCCESSFULLY_CREATED_A_VERSION: 'Você criou uma versão com sucesso',
            VERSION_NAME_IS_REQUIRED: 'Versão é obrigatória',
            CREATE_VERSION: 'Criar versão',
            LIST_VERSION: 'Lista de versões',
            VERSION_NOT_FOUND: 'Nenhuma versão encontrada',
            ACTION: 'Ação',
            DELETE: 'Deletar',
            EDIT: 'Editar',
            CANCEL: 'Cancelar',
        });
        
        $translateProvider.preferredLanguage('ptBR');
    });