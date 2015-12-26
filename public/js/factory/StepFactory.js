app.factory('StepFactory', ['$http', '$q', function($http, $q) {
    return {
        fetchStep : function(id) {
            var defer = $q.defer();
            
            $http.get('api/step/fetch/' + id).success(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        },
        preview : function(id) {
            var defer = $q.defer();
            
            $http.get('api/step/preview/' + id).success(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        }
    }
}]);