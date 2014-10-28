'use strict';

/* Controllers */

var yideApp = angular.module('yideApp', []);

yideApp.controller('DashboardCtrl', function($scope, $http) {
  $http.get('http://wx.8531.cn/yide/index.php/dashboard/dashboard_json').success(function(data) {
    $scope.items = data;
  });
   $http.get('http://wx.8531.cn/yide/index.php/dashboard/select_list_num_json').success(function(data) {
    $scope.ListNum = data;
  });
 // $scope.orderProp = 'age';





});


