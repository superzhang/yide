'use strict';

/* Controllers */

var yideApp = angular.module('yideApp', []);

yideApp.controller('GrabListCtrl', function($scope, $http) {
  $http.get('http://wx.8531.cn/yide/index.php/dashboard/file_list_json').success(function(data) {
    $scope.items = data;
  });
    $http.get('http://wx.8531.cn/yide/index.php/dashboard/select_list_num_json').success(function(data) {
    $scope.ListNum = data;
  });


 // $scope.orderProp = 'age';


// $scope.itemTypes=[
//       {name:'房产', id:'1'},
//       {name:'汽车', id:'2'},
//       {name:'土地', id:'3'},
//       {name:'其他', id:'4'}
//     ];
//分类
$scope.cancelFile = function(itemid){     
    
    var index = -1;    
    var comArr = eval( $scope.items );
    for( var i = 0; i < comArr.length; i++ ) {
      if( comArr[i].item_id===itemid  ) {
        index = i;
        break;
      }
    }
       
    $http({

    method  : 'POST',

    url     : 'http://wx.8531.cn/yide/index.php/dashboard/updateType',

    data    : $.param({item_type:0,item_id:itemid}),  // pass in data as strings

    headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)

    })

      .success(function(data) {

         // console.log(data);
        $scope.items.splice( index, 1 ); 
        alert(data.message);

      });


   
    
  };
 



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


