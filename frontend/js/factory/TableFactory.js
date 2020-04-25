app.factory('TableFactory', ['$http', function($http) {
    return {
        DEFAULT_PAGE: 1,
        DEFAULT_COUNT: 10,
        getAll :  function(url, params) {    
            return $http.get(url, {
                params: params
            }).then(function(response) {
                return response;
            });
        }
    };
}]);