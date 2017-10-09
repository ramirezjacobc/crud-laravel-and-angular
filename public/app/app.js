var app = angular.module('app', ['ngRoute', 'ngAnimate', 'toastr', 'ngTable']);

app.config(['$routeProvider', '$httpProvider', function($routeProvider, $httpProvider){
	$httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

	$httpProvider.interceptors.push(function($q){
		return {
			'response': function(response){
				return response;
			},
			'responseError': function(rejection){
				if(rejection.status === 401){
					location.href = '/';
				}
				return $q.reject(rejection);
			}
		};
	});

	$routeProvider
		.when('/',{
			templateUrl: '/app/views/index.html',
      controller: 'BookController'
		});
}]);

app.run(function($rootScope, $window, toastr) {
	//global url
	$rootScope.url = '/books/';

	$rootScope.booksB = back.books;
	$rootScope.categoriesB = back.categories;

	$rootScope.showNotification = function(data) {
		if(data.type == 'error') {
			toastr.error(data.msg, 'Error');
		}

		if(data.type == 'success') {
			toastr.success(data.msg, 'Success');
		}
	}
});
