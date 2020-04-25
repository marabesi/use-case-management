app.factory('ApplicationFactory', ['$http', '$q', function($http, $q) {
    return {
        fetch : function() {
            var defer = $q.defer();
            
            $http.get('api/application/fetch').then(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        }
    }
}]);