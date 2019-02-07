const dbConnection = require('../models/database');

function add(req, res) {
  sql =
    'INSERT INTO customer VALUES("' +
    req.body.name +
    '", "' +
    req.body.bankAccount +
    '", ' +
    req.body.balance +
    ')';

  dbConnection.query(sql, function(error) {
    if (error) {
      res.send('ERROR');
    } else {
      res.send('OK');
    }
  });
}

function get(req, res) {
  sql =
    'SELECT * FROM customer WHERE bankAccount="' + req.params.bankAccount + '"';
  dbConnection.query(sql, function(error, result) {
    if (error || result.length == 0) {
      res.send('ERROR');
    } else {
      res.send(result[0]);
    }
  });
}

module.exports = {
  add,
  get,
};
