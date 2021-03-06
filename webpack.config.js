// webpack.config.js
var path = require("path");
var webpack = require('webpack');

module.exports = {
	entry: {
		'smart-photo-gallery.back-end': './src/js/smart-photo-gallery/back-end/BackEndModule.js',
		'smart-photo-gallery.front-end': './src/js/smart-photo-gallery/front-end/FrontEndModule.js'
	},
	output: {
		path: 'dist/',
		filename: '[name].min.js'
	},
	module: {
		loaders: [
			{ test: /\.css$/, loader: "style-loader!css-loader" },
			{ test: /\.html$/, loader: 'html' },
			{ test: /\.png$/, loader: "url-loader?minetype=image/png" }
		]
	},
};