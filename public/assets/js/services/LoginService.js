'use strict';
app.factory('SessionService', function () {
    return {
        get: function (key) {
            return sessionStorage.getItem(angular.fromJson(key));
        },
        set: function (key, val) {
            return sessionStorage.setItem(key, JSON.stringify(val));
        },
        unset: function (key) {
            return sessionStorage.removeItem(key);
        }
    }
});
app.factory('Login', function ($http, $rootScope, $cookieStore, SessionService, $state) {
    return {
        auth: function (credentials) {
            var request = $http.post('api/v1/user/auth', credentials);
            // Store the data-dump of the FORM scope.
            request.success(
                function (response, status, headers, config) {
                    $rootScope.user = response.user;

                    SessionService.set('auth', $rootScope.user);
                    $cookieStore.put('auth', $rootScope.user);
                    $state.go(response.user.role + '.dashboard', {'name': response.user.extra.business_name});

                }
            );
            return request;
        },
        register: function (credentials) {
            var newUser = $http.post('api/v1/vendor/create', credentials);
            return newUser;
        },
        forgetPassword: function (credentials) {
            return $http.post('api/v1/user/password/email', credentials);
        },
        getResetPassword: function (credentials) {
            return $http.get('api/v1/user/password/reset/' + credentials);
        },
        resetPassword: function (credentials) {
            return $http.post('api/v1/user/password/reset', credentials);
        },
        logout: function () {
            var request = $http.get('api/v1/user/logout');
            request.success(
                function (response, status, headers, config) {
                    SessionService.unset('auth');
                    $rootScope.user = {};
                    $cookieStore.remove('auth');
                    return {success: true};
                }
            );
            // fire errors
            request.error(function (data, status, headers, config) {
                callback({success: false});
            });
            return request;
        }
    };
});


