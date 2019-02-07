const dbConnection = require('../models/database');

function add(req, res) {
  sql =
    'INSERT INTO Purchase(senderAccount, receiverAccount, amount) VALUES("' +
    req.body.senderAccount +
    '", "' +
    req.body.receiverAccount +
    '", ' +
    req.body.amount +
    ')';

  sql2 =
    'SELECT balance FROM Customer WHERE bankAccount="' +
    req.body.senderAccount +
    '"';
  sql3 =
    'SELECT balance FROM Customer WHERE bankAccount="' +
    req.body.receiverAccount +
    '"';

  dbConnection.query(sql2, function(err, senderData) {
    if (err || senderData.length == 0 || senderData[0].balace < req.body.amount)
      res.send('ERROR');
    else
      dbConnection.query(sql3, function(err, receiverData) {
        if (err || receiverData.length == 0) res.send('ERROR');
        else {
          sql4 =
            'UPDATE Customer SET balance=' +
            (senderData[0].balance - req.body.amount) +
            ' WHERE bankAccount="' +
            req.body.senderAccount +
            '"';
          dbConnection.query(sql4, function(err) {
            if (err) res.send('ERROR');
            else {
              sql5 =
                'UPDATE Customer SET balance=' +
                (receiverData[0].balance + req.body.amount) +
                ' WHERE bankAccount="' +
                req.body.receiverAccount +
                '"';
              dbConnection.query(sql5, function(err) {
                if (err) res.send('ERROR');
                else {
                  dbConnection.query(sql, function(err) {
                    if (err) res.send('ERROR');
                    else res.send('OK');
                  });
                }
              });
            }
          });
        }
      });
  });
}
module.exports = {
  add,
};
