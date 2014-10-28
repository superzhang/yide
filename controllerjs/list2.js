'use strict';

/* Controllers */

var yideApp = angular.module('yideApp', []);

yideApp.controller('GrabListCtrl', function($scope, $http) {
  $http.get('http://wx.8531.cn/yide/index.php/dashboard/grab_list2_json').success(function(data) {
    $scope.items = data;
  });

 // $scope.orderProp = 'age';







$scope.itemsPerPage = 25;
$scope.currentPage = 0;


$scope.prevPage = function() { 
if ($scope.currentPage > 0) {
$scope.currentPage--; }
};


$scope.prevPageDisabled = function() {
return $scope.currentPage === 0 ? "disabled" : "";
};


$scope.pageCount = function() {
return Math.ceil($scope.items.length/$scope.itemsPerPage)-1;
};


$scope.nextPage = function() {
if ($scope.currentPage < $scope.pageCount()) {
$scope.currentPage++; }
};

$scope.nextPageDisabled = function() {
return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
}  


});
yideApp.filter('offset', function() { 
return function(input, start) {
start = parseInt(start, 25);
return input.slice(start); };
});


