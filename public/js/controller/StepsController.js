app.controller('StepsController', ['$scope', 'NgTableParams', 'TableFactory',
    'UseCaseFactory', 'CrudFactory',
    function($scope, NgTableParams, TableFactory, UseCaseFactory, CrudFactory) {
    
    UseCaseFactory.fetch().then(function(data) {
        $scope.useCases = data;
    });    
    
    $scope.elements = [
        {},
    ];
    
    $scope.steps = [];
    
    $scope.flow = {
        type : 'basic'
    }
    
    $scope.modal = {
        title: '',
        active: false
    }
    
    $scope.complementaries = [];
    $scope.rules = [];
    $scope.references = [];
    $scope.submitted = false;
    
    var urlService = 'api/step';
    
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
    
    $scope.createComplementary = function() {
        $scope.modal.title = 'COMPLEMENTARY';
        $scope.modal.active = 'complementary';
    }
    
    $scope.createRule = function() {
        $scope.modal.title = 'BUSINESS';
        $scope.modal.active = 'rule';
    }
    
    $scope.createReference = function() {
        $scope.modal.title = 'REFERENCE';
        $scope.modal.active = 'reference';
    }
    
    $scope.createNewElement = function() {
        var step = {};
        
        $scope.elements.push(step);
    }
    
    $scope.create = function() {
        CrudFactory.create(urlService, $scope.useCase);
        
        $scope.submitted = true;
    }
    
    $scope.createOption = function(active) {
        switch(active) {
            case 'complementary' :
                $scope.complementaries.unshift($scope.option);
            break;
            case 'rule' :
                $scope.rules.unshift($scope.option);
            break;
            case 'reference' :
                $scope.references.unshift($scope.option);
            break;
        }
        
        $scope.option = null;
        $scope.dismiss();
    }
    
    createTable();
}]);