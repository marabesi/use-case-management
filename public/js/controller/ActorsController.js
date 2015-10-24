app.controller('ActorsController', ['$scope', '$timeout', function($scope, $timeout) {
    $scope.submitted = false;
    $scope.actors = [
        {name: 'Actor1', description: 'asusauh'}
    ]
        
    $scope.create = function() {
        $scope.submitted = true;
        
        var actor = {
            name: $scope.actor.name,
            description: $scope.actor.description
            
        }
        
        $scope.actors.push(actor);
        
        $scope.actor = null;
    }
}]);