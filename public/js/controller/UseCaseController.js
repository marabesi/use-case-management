app.controller('UseCaseController', ['$scope', 'NgTableParams', 'TableFactory', 'CrudFactory', '$translate', 'ApplicationFactory', 'VersionFactory', 'ActorFactory',
    function($scope, NgTableParams, TableFactory, CrudFactory, $translate, ApplicationFactory, VersionFactory, ActorFactory) {

    ApplicationFactory.fetch().then(function(data) {
        $scope.application = data;
    });
    
    VersionFactory.fetch().then(function(data) {
        $scope.version = data;
    });
    
    ActorFactory.fetch().then(function(data) {
        $scope.actors = data;
    });
    
    $scope.submitted = false;
    $scope.message = 'CREATE_USE_CASE';
    $scope.actorsElements = [
        {}
    ];
    $scope.useCase = {
        actor : []
    };
    
    var urlService = 'api/use-case';
    
    function createTable() {

        var initialSettings = {
          count: TableFactory.DEFAULT_COUNT,
          page: TableFactory.DEFAULT_PAGE,
          getData: function($defer, params){
            var request = {
                page: params.page(),
                limit: params.count()
            };

            TableFactory.getAll(urlService, request).success(function(result) {
              $defer.resolve(result.data);
              $scope.customConfigParams.total(result.total);
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
                id_relacionamento_dados_revisao: $scope.useCase.id_actor_revision
            }

            CrudFactory.edit(urlService, $scope.useCase.id, app);
        } else {
            var useCase = {
                application : $scope.useCase.application,
                description : $scope.useCase.description,
                status : $scope.useCase.status,
                version : $scope.useCase.version,
                actor: $scope.useCase.actor,
                actorRevision: $scope.useCase.id_actor_revision
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
            $scope.customConfigParams.reload();
        }
    }
    
    $scope.edit = function(index) {
        if (index !== undefined) {
            var useCase = $scope.customConfigParams.data[index];
            
            $scope.useCase = {
                id: useCase.id_caso_de_uso,
                id_revision: useCase.id_revisao,
                id_actor_revision: useCase.id_relacionamento_dados_revisao,
                application : useCase.id_sistema,
                description : useCase.descricao,
                status : useCase.status,
                version : useCase.id_dados_revisao,
                actor: useCase.id_ator
            };
            
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