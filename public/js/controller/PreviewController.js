app.controller('PreviewController', ['$scope', 'StepFactory', 'ApplicationFactory',
    function($scope, StepFactory, ApplicationFactory) {

    ApplicationFactory.fetch().then(function(data) {
        $scope.application = data.data;
    });

    $scope.build = function() {
        var id = $scope.preview.application;

        StepFactory.preview(id).then(function(response) {
            $scope.previewData = response.data;
        });
    }
}]);