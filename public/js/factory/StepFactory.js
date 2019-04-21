app.factory('StepFactory', ['$http', '$q', function($http, $q) {
    return {
        fetchStep : function(id) {
            var defer = $q.defer();
            
            $http.get('api/step/fetch/' + id).then(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        },
        preview : function(id) {
            var defer = $q.defer();
            
            $http.get('api/step/preview/' + id).then(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        },
        complementary : function(id) {
            var defer = $q.defer();

            $http.get('api/step/complementary/' + id).then(function(data) {
                defer.resolve(data);
            });

            return defer.promise;
        },
        business : function(id) {
            var defer = $q.defer();

            $http.get('api/step/business/' + id).then(function(data) {
                defer.resolve(data);
            });

            return defer.promise;
        },
        reference : function(id) {
            var defer = $q.defer();

            $http.get('api/step/reference/' + id).then(function(data) {
                defer.resolve(data);
            });

            return defer.promise;
        }
    }
}]);