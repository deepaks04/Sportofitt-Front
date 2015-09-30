'use strict';
/** 
  * controller for User Profile Example
*/
app.controller('ProfileCtrl', ["$scope", "flowFactory","userService","SweetAlert",
 function ($scope, flowFactory,userService,SweetAlert) {
    $scope.removeImage = function () {
        $scope.noImage = true;
    };
    $scope.obj = new Flow();

    $scope.bankDetail = {};
 userService.getBillingInfo().then(function(billingInfo){
 $scope.billingInfo=billingInfo.billing;	
});
 userService.getVendorProfile().then(function(userInfo){
$scope.userInfo=userInfo.profile;	
$scope.userInfo.profile_picture = {};
    if ($scope.userInfo.profile_picture == '') {
        $scope.noImage = true;
     }


});

 userService.getBankDetails().then(function(bankDetail){
$scope.bankDetail=bankDetail.bank;	
});

 

         

  $scope.form = {

            submit: function (form) {
                var firstError = null;
                if (form.$invalid) {

                    var field = null, firstError = null;
                    for (field in form) {
                        if (field[0] != '$') {
                            if (firstError === null && !form[field].$valid) {
                                firstError = form[field].$name;
                            }

                            if (form[field].$pristine) {
                                form[field].$dirty = true;
                            }
                        }
                    }

                    angular.element('.ng-invalid[name=' + firstError + ']').focus();
                    SweetAlert.swal("The form cannot be submitted because it contains validation errors!", "Errors are marked with a red, dashed border!", "error");
                    return;

                } else {

                  var updateProfile =userService.updateUserInfo($scope.userInfo);
      updateProfile.then(function(response){
      SweetAlert.swal(response.data.message, "success");
     
      console.log(response);
      });
      updateProfile.catch(function(data,status){
      console.log(data);

      SweetAlert.swal("somethings going wrong",data.data.statusText, "error");
      return;
      })

                }

            },
            reset: function (form) {

                $scope.userInfo = angular.copy($scope.master);
                form.$setPristine(true);

            }
        };



        $scope.billingForm = {

            submit: function (form) {
            	
                var firstError = null;
                if (form.$invalid) {

                    var field = null, firstError = null;
                    for (field in form) {
                        if (field[0] != '$') {
                            if (firstError === null && !form[field].$valid) {
                                firstError = form[field].$name;
                            }

                            if (form[field].$pristine) {
                                form[field].$dirty = true;
                            }
                        }
                    }

                    angular.element('.ng-invalid[name=' + firstError + ']').focus();
                    SweetAlert.swal("The form cannot be submitted because it contains validation errors!", "Errors are marked with a red, dashed border!", "error");
                    return;

                } else {

                  var updateBillingInfo =userService.updateBillingInfo(form);
      updateBillingInfo.then(function(response){
      SweetAlert.swal(response.data.message, "success");
     
      console.log(response);
      });
      updateBillingInfo.catch(function(data,status){
      console.log(data);

      SweetAlert.swal("somethings going wrong",data.data.statusText, "error");
      return;
      })

                }

            }        };

               $scope.bankForm = {

            submit: function (form) {
            	
                var firstError = null;
                if (form.$invalid) {

                    var field = null, firstError = null;
                    for (field in form) {
                        if (field[0] != '$') {
                            if (firstError === null && !form[field].$valid) {
                                firstError = form[field].$name;
                            }

                            if (form[field].$pristine) {
                                form[field].$dirty = true;
                            }
                        }
                    }

                    angular.element('.ng-invalid[name=' + firstError + ']').focus();
                    SweetAlert.swal("The form cannot be submitted because it contains validation errors!", "Errors are marked with a red, dashed border!", "error");
                    return;

                } else {

                  var updateBankDetails =userService.updateBankDetails(form);
      updateBankDetails.then(function(response){
      SweetAlert.swal(response.data.message, "success");
     
      console.log(response);
      });
      updateBankDetails.catch(function(data,status){
      console.log(data);

      SweetAlert.swal("somethings going wrong",data.data.statusText, "error");
      return;
      })

                }

            }        };
}]);