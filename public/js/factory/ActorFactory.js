app.factory('ActorFactory', ['$http', '$q', function ($http, $q) {
    return {
        fetch: function() {
            var defer = $q.defer();
            
            $http.get('api/actor/fetch').then(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        }
    }
}]);