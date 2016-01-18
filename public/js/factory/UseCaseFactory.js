app.factory('UseCaseFactory', ['$http', '$q', function($http, $q) {
    return {
        fetch: function(id) {
            var defer = $q.defer();
            
            $http.get('api/use-case/fetch/' + id).success(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        },
        fetchUseCase: function(id, revision) {
            var defer = $q.defer();
            var url = 'api/use-case/fetch-use-case/' + id + '/revision/' + revision;
            
            $http.get(url).success(function(data) {
                defer.resolve(data);
            });
            
            return defer.promise;
        },
        fetchTotalNotDeleted: function() {
            var defer = $q.defer();
            var url = 'api/use-case/total-not-deleted';

            $http.get(url).success(function(data) {
                defer.resolve(data);
            });

            return defer.promise;
        },
        fetchTotalDeleted: function() {
            var defer = $q.defer();
            var url = 'api/use-case/total-deleted';

            $http.get(url).success(function(data) {
                defer.resolve(data);
            });

            return defer.promise;
        }
    }
}]);