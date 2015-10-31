app.controller('StepsController', ['$scope', function($scope) {
    $scope.steps = [
        {}
    ];
    
    $scope.flow = {
        type : 'basic'
    }
    
    $scope.complementaries = [];
    $scope.rules = [];
    $scope.references = [];
    
    $scope.createComplementary = function() {
        var complementary = {
            description: $scope.complementary.description
        }
        $scope.complementaries.push(complementary);
        
        $scope.complementary = null;
    }
    
    $scope.createRule = function() {
        var rule = {
            description: $scope.rule.description
        }
        $scope.rules.push(rule);
        
        $scope.rule = null;
    }
    
    $scope.createReference = function() {
        var reference = {
            description: $scope.reference.description
        }
        $scope.references.push(reference);
        
        $scope.reference = null;
    }
    
    $scope.createNewStep = function() {
        var step = {};
        
        $scope.steps.unshift(step);
    }
}]);