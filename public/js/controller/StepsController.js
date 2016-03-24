app.controller('StepsController', ['$scope', 'NgTableParams', 'TableFactory',
    'UseCaseFactory', 'CrudFactory', 'StepFactory', '$translate', 'ApplicationFactory',
    function($scope, 
    NgTableParams, 
    TableFactory,
    UseCaseFactory, 
    CrudFactory, 
    StepFactory,
    $translate,
    ApplicationFactory) {

    $scope.elements = [
        {},
    ];
    
    $scope.steps = [];
    
    $scope.types = [
        {id: 1, description: $translate.instant('TYPE_1')},
        {id: 2, description: $translate.instant('TYPE_2')},
        {id: 3, description: $translate.instant('TYPE_3')},
    ];
    
    $scope.modal = {
        title: '',
        active: false
    }
    
    $scope.complementaries = [];
    $scope.rules = [];
    $scope.references = [];
    $scope.submitted = false;
    $scope.message = 'SAVE_STEP';
    $scope.error = false;
    $scope.allUseCases = [];
    
    var urlService = 'api/step';

    ApplicationFactory.fetch().then(function(data) {
        $scope.application = data;
    });

    function createTable() {
        var initialSettings = {
          count: TableFactory.DEFAULT_COUNT,
          page: TableFactory.DEFAULT_PAGE,
          getData: function($defer, params){
            var request = {
                page: params.page(),
                limit: params.count(),
                filter: params.filter()
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

    $scope.tableHeader = [
        $translate.instant('USE_CASE'),
        $translate.instant('TYPE'),
        $translate.instant('IDENTIFIER'),
        $translate.instant('DESCRIPTION'),
        $translate.instant('ACTION')
    ];

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

    $scope.fetchUseCase = function(id) {
        UseCaseFactory.fetch(id).then(function(data) {
            $scope.useCases = data;
        });

        StepFactory.complementary(id).then(function(data) {
            $scope.complementaries = data;
        });

        StepFactory.business(id).then(function(data) {
            $scope.rules = data;
        });

        StepFactory.reference(id).then(function(data) {
            $scope.references = data;
        });
    }

    UseCaseFactory.fetchAllUseCases().then(function(data) {
        for (obj in data) {
            $scope.allUseCases.push({
                id: data[obj].id_caso_de_uso,
                title: data[obj].descricao
            });
        }
    });

    $scope.create = function() {
        if ($scope.useCase.id_passos !== undefined && $scope.useCase.id_fluxo !== undefined) {
            var id = $scope.useCase.id_passos + ',' + $scope.useCase.id_fluxo;
            
            CrudFactory.edit(urlService, id, $scope.useCase);
        } else {
            CrudFactory.create(urlService, $scope.useCase);
        }
        
        $scope.submitted = true;
        $scope.cancel();

        createTable();
        $scope.customConfigParams.reload();
    }
    
    $scope.edit = function(index) {
        if (index !== undefined) {
            var data = $scope.customConfigParams.data[index];

            $scope.fetchUseCase(data.id_sistema);

            StepFactory.fetchStep(data.id_passos).then(function(response) {
                $scope.useCase = {
                    application: data.id_sistema,
                    useCase: data.id_revisao,
                    type: data.tipo,
                    identifier: data.identificador,
                    description: data.descricao,
                    id_passos: data.id_passos,
                    id_fluxo: data.id_fluxo
                };

                $scope.useCase.complementary = hidrate(response.complementary);
                $scope.useCase.business = hidrate(response.business);
                $scope.useCase.reference = hidrate(response.reference);
                
                $scope.complementaries = response.complementary;
                $scope.rules = response.business;
                $scope.references = response.reference;

                if (response.business.length == 0) {
                    $scope.elements = [
                        {}
                    ];

                } else {
                    $scope.elements = response.business;
                }

            });
            
            $scope.message = 'UPDATE_STEP';
        }
    }

    /**
     * Transform elements in the collection into array to be used in the view
     * @param collection
     * @returns {Array}
     */
    function hidrate(collection) {
        data = [];
        
        for(item in collection) {
            var element = collection[item].identifier + 
                '|' + 
                collection[item].description +
                '|' +
                collection[item].id;

            data.push(element);
        }
        
        return data;
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
        $scope.elements = [{}];
        $scope.complementaries = [];
        $scope.rules = [];
        $scope.references = [];
    }

    $scope.removeElement = function(index) {
        $scope.elements.splice(index, 1);
    }

    $scope.remove = function(step, flow) {
        var message = $translate.instant('CONFIRM_DELETE');
        
        if (confirm(message)) {
            var id = step + ',' + flow;
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
        }
    }

    createTable();
}]);