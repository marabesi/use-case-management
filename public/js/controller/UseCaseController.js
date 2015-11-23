app.controller('UseCaseController', ['$scope', 'NgTableParams', 'TableFactory', 'CrudFactory', '$translate', 'ApplicationFactory', 'VersionFactory',
    function($scope, NgTableParams, TableFactory, CrudFactory, $translate, ApplicationFactory, VersionFactory) {

    ApplicationFactory.fetch().then(function(data) {
        $scope.application = data;
    });
    
    VersionFactory.fetch().then(function(data) {
        $scope.version = data;
    });
    
    $scope.submitted = false;
    $scope.message = 'CREATE_USE_CASE';
    
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
                id_dados_revisao: $scope.useCase.version
            }

            CrudFactory.edit(urlService, $scope.useCase.id, app);
        } else {
            var useCase = {
                application : $scope.useCase.application,
                description : $scope.useCase.description,
                status : $scope.useCase.status,
                version : $scope.useCase.version
            };

            CrudFactory.create(urlService, useCase);
        }
        
        $scope.submitted = true;
        $scope.cancel();
        
        createTable();
        $scope.customConfigParams.reload();
    }
    
    $scope.edit = function(index) {
        if (index !== undefined) {
            var useCase = $scope.customConfigParams.data[index];
            
            $scope.useCase = {
//                id: useCase.
//                application : useCase.id_sistema,
//                description : useCase.descricao,
//                status : useCase.status,
//                version : useCase.version
            };
            
            $scope.message = 'UPDATE_USE_CASE';
        }
    }
    
    $scope.cancel = function() {
        $scope.useCase = null;
        $scope.message = 'CREATE_USE_CASE';
    }
    
    createTable();
}]);