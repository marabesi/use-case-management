app.controller('StepsController', ['$scope', function($scope) {
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
        $scope.modal.title = 'Complementary';
        $scope.modal.active = 'complementary';
    }
    
    $scope.createRule = function() {
        $scope.modal.title = 'Rule';
        $scope.modal.active = 'rule';
    }
    
    $scope.createReference = function() {
        $scope.modal.title = 'Reference';
        $scope.modal.active = 'reference';
    }
    
    $scope.createNewElement = function() {
        var step = {};
        
        $scope.elements.push(step);
    }
    
    $scope.createNewStep = function() {
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