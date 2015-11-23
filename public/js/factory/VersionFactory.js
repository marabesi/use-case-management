app.factory('VersionFactory', ['$http', '$q', function($http, $q) {
    return {
        fetch: function() {
            var defer = $q.defer();
            
            $http.get('api/version/fetch').success(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        }
    }
}]);