const app = require('express')();
const bodyParser = require('body-parser');
const port = process.env.PORT || 3000;
const customer = require('./api/router/customer');
const transaction = require('./api/router/transaction');

// middleware
// Add CORS headers
app.use(function (req, res, next) {
    // Website you wish to allow to connect
    res.setHeader('Access-Control-Allow-Origin', 'http://localhost');

    // Request methods you wish to allow
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');

    // Request headers you wish to allow
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');

    // Set to true if you need the website to include cookies in the requests sent
    // to the API (e.g. in case you use sessions)
    res.setHeader('Access-Control-Allow-Credentials', true);

    // Pass to next layer of middleware
    next();
});
app.use(bodyParser.json());
app.use('/customer', customer);
app.use('/transaction', transaction);

app.listen(port);
console.log('App started on', port);