app.factory('CrudFactory', ['$http', function($http) {
    return {
        create: function(url, data) {
            return $http.post(url, data);
        },
        remove: function(url, data) {
            return $http.delete(url + '/' + data);
        },
        edit: function(url, id, data) {
            return $http.put(url + '/' + id, data);
        }
    };
}]);