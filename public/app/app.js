var app = angular.module('userApp', ['ngRoute']);
app.config(function($routeProvider) {
	$routeProvider
	.when('/', {
		templateUrl : "/template/list.html",
		controller : "ListCtrl"
	})
	.when('/add-user', {
		templateUrl : "/template/add-new.html",
		controller : "AddCtrl"
	})
	.when('/update-user/:id', {
		templateUrl : "template/update-user.html",
		controller : "UpdateCtrl"
	})
	.otherwise({
		redirectTo: '/'
	});
})

app.controller("ListCtrl", function($scope, $http) {
	$http.get('api/users').success(function(data) {
		$scope.users = data;
	});
})
app.controller("AddCtrl", function($scope, $location, $http) {
	$scope.submitForm = function() {
	// 	$scope.user = {};
		$http({
			method: 'POST',
			url: '/api/users',
			data: $scope.user,
		})
		.success(function(response) {
		    $location.path('/');
    	})
    	.error(function(response) {
    		console.log("error, please check the log");
    	})
	}
})
app.controller("UpdateCtrl", function($scope, $http, id) {

})

// function EditCtrl($scope, $http, $location, $routeParams) {
//   var id = $routeParams.id;
//   $scope.activePath = null;

//   $http.get('api/users/'+id).success(function(data) {
//     $scope.users = data;
//   });

//   $scope.update = function(user){
//     $http.put('api/users/'+id, user).success(function(data) {
//       $scope.users = data;
//       $scope.activePath = $location.path('/');
//     });
//   };

//   $scope.delete = function(user) {
//     console.log(user);

//     var deleteUser = confirm('Are you absolutely sure you want to delete?');
//     if (deleteUser) {
//       $http.delete('api/users/'+user.id);
//       $scope.activePath = $location.path('/');
//     }
//   };
// }