app.controller('VersionController', ['$scope', function($scope) {
    $scope.versions = [
        {versionName: '1.0.1', description: 'test'}
    ]
    
    $scope.versions = []
    
    $scope.create = function() {
        var version = {
            versionName : $scope.version.name,
            description : $scope.version.description
        };
        
        $scope.versions.push(version);
        $scope.version = null;
        $scope.submitted = true;
    }
}]);