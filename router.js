const expres = require('express')
const route = expres.Router()
const routeData = require('./routes/index')

route.use('/data', routeData)
module.exports = route