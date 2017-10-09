app.controller('BookController',
  ['$scope', '$rootScope', 'BookService', 'NgTableParams', '$filter',
  function ($scope, $rootScope, BookService, NgTableParams, $filter) {

	var vm;
	vm = $scope;
	vm.books = $rootScope.booksB;
  vm.categories = $rootScope.categoriesB;
	vm.view = 'list';
	vm.newBook = {};

	vm.changeView = function(type, id = null) {
    var index = $filter('getIndexById')(vm.books, id);
    vm.view = type;
		vm.newBook = id === null ? {} : vm.books[index];
	}

	vm.addBook = function() {
		if(vm.newBook.id) {
			vm.updateBook();
		}else{
			BookService.addBook(vm.newBook)
			.then(function successCallback(response) {
				if(response.data.type == 'success') {
					vm.newBook.active = 1;
					vm.books.push(response.data.data);
					vm.view = 'list';
					$rootScope.showNotification(response.data);
          vm.updateTableValues();
				}
			}, function errorCallback(response) {
				console.log(response);
			});
		}
	}

	vm.updateBook = function() {
		BookService.updateBook(vm.newBook)
		.then(function successCallback(response) {
			if(response.data.type == 'success') {
				vm.view = 'list';
        var index = $filter('getIndexById')(vm.books, response.data.data.id);
        vm.books[index] = response.data.data;
				$rootScope.showNotification(response.data);
        vm.updateTableValues();
			}
		}, function errorCallback(response) {
			console.log(response);
		});
	}

	vm.changeStatus = function(id) {
    var index = $filter('getIndexById')(vm.books, id);
    if(confirm("Change status?")) {
      BookService.updateStatus(vm.books[index].id)
  		.then(function successCallback(response) {
  			if(response.data.type == 'success') {
  				vm.books[index] = response.data.data;
          vm.updateTableValues();
  				$rootScope.showNotification(response.data);
  			}
  		}, function errorCallback(response) {
  			console.log(response);
  		});
    }
	}

  vm.updateCategory = function(category) {
    console.log(category);
  }

  vm.deleteBook = function(id) {
    var index = $filter('getIndexById')(vm.books, id);

    if (confirm("are sure to change status of"+  vm.books[index].name +"?")) {
      BookService.removeBook(vm.books[index])
      .then(function successCallback(response) {
        if(response.data.type == 'success') {
          vm.books.splice(index, 1);
          vm.updateTableValues();
          $rootScope.showNotification(response.data);
        }
      }, function errorCallback(response) {
        console.log(response);
      });
    }
  }

  vm.updateTableValues = function() {
    vm.tableParams = new NgTableParams({}, { dataset: vm.books})
  }

  vm.updateTableValues();
}]);
