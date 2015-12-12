app.controller('StepsController', ['$scope', 'UseCaseFactory', function($scope, UseCaseFactory) {
    
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
        console.log($scope.useCase);
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
}]);