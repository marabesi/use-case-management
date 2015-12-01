app.factory('UseCaseFactory', ['$http', '$q', function($http, $q) {
    return {
        fetch: function() {
            var defer = $q.defer();
            
            $http.get('api/use-case/fetch').success(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        },
        fetchUseCase: function(id) {
            var defer = $q.defer();
            
            $http.get('api/use-case/fetch-use-case/' + id).success(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        }
    }
}]);