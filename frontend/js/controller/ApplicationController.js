app.controller('ApplicationController', ['$scope', 'NgTableParams', 'TableFactory', 'CrudFactory', '$translate',
    function($scope, NgTableParams, TableFactory, CrudFactory, $translate) {
    
    $scope.submitted = false;
    $scope.message = 'CREATE_APPLICATION';
    
    var urlService = 'api/application';
    
    function createTable() {
        var initialSettings = {
          count: TableFactory.DEFAULT_COUNT,
          page: TableFactory.DEFAULT_PAGE,
          getData: function($defer, params){
            var request = {
                page: params.page(),
                limit: params.count(),
                sorting: params.sorting(),
            };

            TableFactory.getAll(urlService, request).then(function(result) {
              $defer.resolve(result.data.data);
              $scope.customConfigParams.total(result.data.data.total);
            });
          }
        };

        $scope.customConfigParams = new NgTableParams(
            {count: TableFactory.DEFAULT_COUNT, sorting: {
                nome: 'ASC'
            }},
            initialSettings
        );
    }
    
    $scope.create = function() {
        if ($scope.application.id !== undefined) {
            var app = {
                nome: $scope.application.name
            }

            CrudFactory.edit(urlService, $scope.application.id, app);
        } else {
            var app = {
                name: $scope.application.name
            }

            CrudFactory.create(urlService, app);
        }
        
        $scope.submitted = true;
        $scope.cancel();
        
        createTable();
        $scope.customConfigParams.reload();
    }
    
    $scope.remove = function(id) {
        var message = $translate.instant('CONFIRM_DELETE');
        
        if (confirm(message)) {
            CrudFactory.remove(urlService, id);

            createTable();
            $scope.cancel();
            $scope.customConfigParams.reload();
        }
    }
    
    $scope.edit = function(index) {
        if (index !== undefined) {
            var app = $scope.customConfigParams.data[index];
            
            $scope.application = {
                id: app.id_sistema,
                name: app.nome
            };
            $scope.message = 'UPDATE_APPLICATION';
        }
    }
    
    $scope.cancel = function() {
        $scope.application = null;
        $scope.message = 'CREATE_APPLICATION';
    }
    
    createTable();
}]);