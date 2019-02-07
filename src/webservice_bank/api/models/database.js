const mysql = require('mysql');
const config = require('../../config/db');

var connection = mysql.createConnection(config);

module.exports = connection;
