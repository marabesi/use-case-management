app.controller('LanguageMenuController', ['$scope', '$translate', function($scope, $translate) {
    $scope.currentLanguage = $translate.use();
    
    $scope.changeLanguage = function(language) {
        $translate.use(language);
        $scope.currentLanguage = language;
    }
}]);