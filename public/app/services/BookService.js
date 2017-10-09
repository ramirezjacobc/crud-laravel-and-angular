app.factory('BookService', [ '$rootScope', '$http', function($rootScope, $http) {
	return {
		addBook: function(data) {
			return $http.post($rootScope.url, data);
		},
		updateBook: function(data) {
			return $http.put($rootScope.url + data.id, data);
		},
		updateStatus: function(id) {
			return $http.get($rootScope.url + ''+ id +'/edit');
		},
		removeBook: function(data) {
			return $http.delete($rootScope.url + data.id);
		}
	}
}]);
