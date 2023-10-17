const express = require('express')
const route = express.Router()
const ctrl = require('../controllers/index')

route.get('/', ctrl.getData)
route.get('/brand', ctrl.getDataBrand)

module.exports = route