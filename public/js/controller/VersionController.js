app.controller('VersionController', ['$scope', 'NgTableParams', 'TableFactory', 'CrudFactory', '$translate', 
    function($scope, NgTableParams, TableFactory, CrudFactory, $translate) {
        
    var urlService = 'api/version';
    
    $scope.message = 'CREATE_VERSION';
    $scope.error = false;
    $scope.messageError = '';
        
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
        if ($scope.version.id !== undefined) {
            var version = {
                versao: $scope.version.name,
                descricao : $scope.version.description
            }
            
            CrudFactory.edit(urlService, $scope.version.id, version);
        } else {
            var version = {
                version: $scope.version.name,
                description : $scope.version.description
            }
            
            CrudFactory.create(urlService, version);
        }
        
        $scope.submitted = true;
        $scope.cancel();
        
        createTable();
        $scope.customConfigParams.reload();
    }
    
    $scope.edit = function(index) {
        if (index !== undefined) {
            var version = $scope.customConfigParams.data[index];
            
            $scope.version = {
                id: version.id_dados_revisao,
                name: version.versao,
                description : version.descricao
            };
            $scope.message = 'UPDATE_VERSION';
        }
    }
    
    $scope.remove = function(id) {
        var message = $translate.instant('CONFIRM_DELETE');
        
        if (confirm(message)) {
            var http = CrudFactory.remove(urlService, id);
            
            http.success(function(data) {
                if (data.error) {
                    $scope.messageError = $translate.instant(data.data);
                    $scope.error = true;
                } else {
                    createTable();
                    $scope.cancel();
                    $scope.customConfigParams.reload();
                }
            });
            
            createTable();
            $scope.customConfigParams.reload();
        }
    }
    
    $scope.cancel = function() {
        $scope.version = null;
        $scope.message = 'CREATE_VERSION';
    }
    
    createTable();
}]);