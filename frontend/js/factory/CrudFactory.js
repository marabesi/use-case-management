app.factory('CrudFactory', ['$http', function($http) {
    return {
        create: function(url, data) {
            return $http.post(url, data);
        },
        remove: function(url, data) {
            var params = data;
            if (data.constructor === Array) {
                params = data.toString();
            }
            return $http.delete(url + '/' + params);
        },
        edit: function(url, id, data) {
            return $http.put(url + '/' + id, data);
        }
    };
}]);