var app = angular.module('usersApp', [])
.constant('API_URL', 'http://user.app/api/');

app.controller('usersController', function($scope, $http, API_URL) {
//retrieve user list 
$http.get(API_URL + "users")
.success(function(response) {
	$scope.users = response;
});

$scope.orderBy = function(field) {
	$scope.field = field;
}

$scope.uploadImage = function(user) {
	// validate image extension
	$('#photo-format-error').html("");
	$('#photo-size-error').html("");
	var file = user.files[0];
	console.log(file);
	var fileName = file.name;
	var extension = fileName.split(".").pop();
	if(extension != 'jpg' && extension != 'gif' && extension != 'png' && extension != 'jpeg') {
		$('#photo-format-error').html('Please choose a valid image( jpg, gif, png, jpeg)').css('color', 'red');
		document.getElementById("photo").value = "";
	}
	// validate image size
	var fileSize = file.size;
	var maxSize = 10*1024*1024;
	if(file.size >= maxSize) {
		$('#photo-size-error').html('File too large. 10MB maximum is allowed').css('color', 'red');
		document.getElementById("photo").value = "";
	}
	// send image to handle
	var formData = new FormData();
	formData.append("file", user.files[0]);
	response = $http.post('/api/image', formData, {
		headers: {'Content-Type': undefined},
		transformRequest: angular.identity
	}).success(function (response) {
		console.log(response);
		$scope.user.photo = response;
	}).error(function () {
	});	
};

// save new record / update existing record
$scope.save = function(modalstate, id) {
	var url = API_URL + "users";
    //append user id to the URL if the form is in edit mode
    if (modalstate === 'edit'){
    	url += "/" + id;
    }
    $http({
    	method: 'POST',
    	url: url,
    	data: $.param($scope.user),
    	headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(response) {
    	console.log(response);
    	//reload page
    	$http.get(API_URL + "users")
    	.success(function(response) {
    		$scope.users = response;
    	});
    	$('#saveModal').modal('hide');
    }).error(function(response) {
    	console.log(response);
    	alert('An error has occured. Please check the log for details');
    });
}

// show modal form
$scope.toggle = function(modalstate, id) {
	$scope.modalstate = modalstate;

	switch (modalstate) {
		case 'add':
		$scope.form_title = "Add New User";
		$scope.user = {};
		document.getElementById("photo").value = "";
		$('#photo-format-error').html("");
		$('#photo-size-error').html("");
		console.log($scope.user);
		break;
		case 'edit':
		document.getElementById("photo").value = "";
		$('#photo-format-error').html("");
		$('#photo-size-error').html("");
		$scope.form_title = "User Detail";
		$scope.id = id;
		$http.get(API_URL + 'users/' + id)
		.success(function(response) {
			console.log(response);
			$scope.user = response;
		});
		break;
	}
	console.log(id);
	$('#saveModal').modal('show');
}

//delete record
$scope.confirmDelete = function(id) {
	var isConfirmDelete = confirm('Delete this record?');
	if (isConfirmDelete) {
		$http({
			method: 'GET',
			url: API_URL + 'users/destroy/' + id
		}).
		success(function(data) {
			console.log(data);
			//reload page
			$http.get(API_URL + "users")
			.success(function(response) {
				$scope.users = response;
			});
		}).
		error(function(data) {
			console.log(data);
			alert('Unable to delete');
		});
	} else {
		return false;
	}
}
});