app.controller('ActorsController', ['$scope',  'NgTableParams', 'TableFactory', 'CrudFactory', '$translate',
    function($scope, NgTableParams, TableFactory, CrudFactory, $translate) {
    
    $scope.submitted = false;
    $scope.error = false;
    $scope.message = 'CREATE_ACTOR';
    $scope.messageError = '';
    
    var urlService = 'api/actor';
    
    function createTable() {

        var initialSettings = {
          count: TableFactory.DEFAULT_COUNT,
          page: TableFactory.DEFAULT_PAGE,
          getData: function($defer, params){
            var request = {
                page: params.page(),
                limit: params.count()
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
         if ($scope.actor.id !== undefined) {
            var actor = {
                nome: $scope.actor.name,
                descricao: $scope.actor.description
            }

            CrudFactory.edit(urlService, $scope.actor.id, actor);
        } else {
            var actor = {
                name: $scope.actor.name,
                description: $scope.actor.description
            };

            CrudFactory.create(urlService, actor);
        }
        
        $scope.submitted = true;
        $scope.cancel();
        
        createTable();
        $scope.customConfigParams.reload();
    }
    
    $scope.remove = function(id) {
        var message = $translate.instant('CONFIRM_DELETE');
        
        if (confirm(message)) {
            var http = CrudFactory.remove(urlService, id);
            
            http.then(function(data) {
                if (data.error) {
                    $scope.messageError = $translate.instant(data.data);
                    $scope.error = true;
                } else {
                    createTable();
                    $scope.cancel();
                    $scope.customConfigParams.reload();
                }
            });
        }
    }
    
    $scope.edit = function(index) {
        if (index !== undefined) {
            var actor = $scope.customConfigParams.data[index];
            
            $scope.actor = {
                id: actor.id_ator,
                name: actor.nome,
                description: actor.descricao,
            };
            
            $scope.message = 'UPDATE_ACTOR';
        }
    }
    
    $scope.cancel = function() {
        $scope.actor = null;
        $scope.message = 'CREATE_ACTOR';
    }
    
    createTable();
}]);