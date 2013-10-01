//var mongo = require('mongodb');
//var mysql = require('mysql');
//var redis = require('redis').createClient();
var fs = require('fs');

module.exports = function handler(req, res) {
	if(req.url == '/') {
		fs.readFile('index.html', function(err, content) {
			if(err) throw err;
			res.end(content);
		});
		/*redis.get('data', function(err, data) {
			throw new Error('redis callback');
		});*/
	} else {
		res.statusCode = 404;
		res.end('Not Found');
	}
};
