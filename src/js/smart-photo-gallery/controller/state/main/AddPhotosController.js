function AddPhotosController($scope, $state, Restangular, $http) {
	var Dropzone = require('../../../../bower_components/dropzone/dist/min/dropzone.min');
	Dropzone.autoDiscover = false;
};
	
AddPhotosController.$inject = ['$scope', '$state', 'Restangular', '$http'];

module.exports = AddPhotosController;