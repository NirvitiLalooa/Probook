const router = require('express').Router();
const customer = require('../controllers/customer');

router.get('/get/:bankAccount', customer.get);
router.post('/add', customer.add);

module.exports = router;


