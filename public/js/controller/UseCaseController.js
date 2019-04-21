app.controller('UseCaseController', ['$scope', 'NgTableParams', 'TableFactory',
    'CrudFactory', '$translate', 'ApplicationFactory', 'VersionFactory', 'ActorFactory',
    'UseCaseFactory',
    function($scope, NgTableParams, TableFactory,
    CrudFactory, $translate, ApplicationFactory, VersionFactory, ActorFactory,
    UseCaseFactory) {

    $scope.applicationFilter = [];

    ApplicationFactory.fetch().then(function(data) {
        $scope.application = data.data;

        for (obj in data.data) {
            $scope.applicationFilter.push({
                id: data.data[obj].id_sistema,
                title: data.data[obj].nome
            });
        }
    });
    
    VersionFactory.fetch().then(function(data) {
        $scope.version = data.data;
    });
    
    ActorFactory.fetch().then(function(data) {
        $scope.actors = data.data;
    });
    
    $scope.submitted = false;
    $scope.message = 'CREATE_USE_CASE';
    $scope.actorsElements = [
        {}
    ];
    $scope.useCase = {
        actor : []
    };
    $scope.selectStatus = [
       { id: 1, description: $translate.instant('1') },
       { id: 2, description: $translate.instant('2') },
       { id: 3, description: $translate.instant('3') },
       { id: 4, description: $translate.instant('4') },
    ];

    $scope.tableHeader = [
        $translate.instant('APPLICATION'),
        $translate.instant('DESCRIPTION'),
        $translate.instant('STATUS'),
        $translate.instant('ACTION')
    ];

    var urlService = 'api/use-case';
    
    function createTable() {

        var initialSettings = {
          count: TableFactory.DEFAULT_COUNT,
          page: TableFactory.DEFAULT_PAGE,
          filter: {},
          getData: function($defer, params){
            var request = {
                page: params.page(),
                limit: params.count(),
                filter: params.filter()
            };

            TableFactory.getAll(urlService, request).then(function(result) {
                $defer.resolve(result.data.data);
                $scope.customConfigParams.total(result.data.total);
            });
          }
        };

        $scope.customConfigParams = new NgTableParams(
            {count: TableFactory.DEFAULT_COUNT},
            initialSettings
        );
    }
    
    $scope.create = function() {
        if ($scope.useCase.id !== undefined) {
            var app = {
                id_sistema: $scope.useCase.application,
                descricao: $scope.useCase.description,
                status: $scope.useCase.status,
                id_dados_revisao: $scope.useCase.version,
                id_revisao: $scope.useCase.id_revision,
                id_ator: $scope.useCase.actor,
                id_relacionamento_dados_revisao: $scope.useCase.id_actor_revision,
                pre_condicao: $scope.useCase.preCondition,
                pos_condicao: $scope.useCase.posCondition
            }

            CrudFactory.edit(urlService, $scope.useCase.id, app);
        } else {
            var useCase = {
                application : $scope.useCase.application,
                description : $scope.useCase.description,
                status : $scope.useCase.status,
                version : $scope.useCase.version,
                actor: $scope.useCase.actor,
                actorRevision: $scope.useCase.id_actor_revision,
                preCondition: $scope.useCase.preCondition,
                posCondition: $scope.useCase.posCondition
            };

            CrudFactory.create(urlService, useCase);
        }
        
        $scope.submitted = true;
        $scope.cancel();
        
        createTable();
        $scope.customConfigParams.reload();
    }
    
    $scope.remove = function(id, actor) {
        var message = $translate.instant('CONFIRM_DELETE');
        
        if (confirm(message)) {
            CrudFactory.remove(urlService, [id, actor]);

            createTable();
            $scope.cancel();
            $scope.customConfigParams.reload();
        }
    }
    
    $scope.edit = function(index) {
        if (index !== undefined) {
            var id_caso_de_uso = $scope.customConfigParams.data[index].id_caso_de_uso;
            var id_revisao = $scope.customConfigParams.data[index].id_revisao;
            
            UseCaseFactory.fetchUseCase(id_caso_de_uso, id_revisao).then(function(result) {
                var data = result.data;
                $scope.useCase = {
                    id: data.id_caso_de_uso,
                    id_revision: data.id_revisao,
                    id_actor_revision: data.id_relacionamento_dados_revisao,
                    application : data.id_sistema,
                    description : data.descricao,
                    status : data.status,
                    preCondition: data.pre_condicao,
                    posCondition: data.pos_condicao,
                    version : data.id_dados_revisao,
                    actor: data.atores
                };
                
                $scope.actorsElements = data.atores;
            });
            
            $scope.message = 'UPDATE_USE_CASE';
        }
    }
    
    $scope.cancel = function() {
        $scope.actorsElements = [
            {}
        ];
        $scope.useCase = null;
        $scope.message = 'CREATE_USE_CASE';
    }
    
    $scope.createActor = function(index) {
        $scope.actorsElements.push({id: index});
    }
    
    $scope.deleteActor = function(index) {
        $scope.actorsElements.splice(index, 1);
    }
    
    createTable();
}]);