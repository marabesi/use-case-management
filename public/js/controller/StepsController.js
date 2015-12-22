app.controller('StepsController', ['$scope', 'NgTableParams', 'TableFactory',
    'UseCaseFactory', 'CrudFactory', 'StepFactory',
    function($scope, NgTableParams, TableFactory, UseCaseFactory, CrudFactory, StepFactory) {
    
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
    $scope.message = 'SAVE_STEP';
    
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
    
    $scope.edit = function(index) {
        if (index !== undefined) {
            var data = $scope.customConfigParams.data[index];
            
            StepFactory.fetchStep(data.id_passos).then(function(response) {
                $scope.useCase = {
                    useCase: data.id_revisao,
                    type: data.tipo,
                    identifier: data.identificador,
                    description: data.descricao,
                };
                
                $scope.complementaries = response.complementary;
                $scope.rules = response.business;
                $scope.references = response.reference;
            });
            
            $scope.message = 'UPDATE_STEP';
        }
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
    
    $scope.cancel = function() {
        $scope.message = 'SAVE_STEP';
        $scope.useCase = null;
    }
    
    createTable();
}]);