const router = require('express').Router();
const transaction = require('../controllers/transaction');

router.post('/add', transaction.add);

module.exports = router;
