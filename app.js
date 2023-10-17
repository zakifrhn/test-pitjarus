const express = require('express')
const app = express()
const cors = require('cors')
const db = require('./database')
require('dotenv').config()
const router = require('./router')

app.use(cors())
app.use(express.json())
app.use(express.urlencoded({extended: true}))
app.use(router)
// db.connect()
//.then(()=>{
//     app.listen(process.env.PORT, ()=>{
//         console.log(`your app runing in port` + process.env.PORT)
//     })
// }).catch(e=>{
//     console.log(`your port ${e} is not recognize`)
// })

db.connect(function(err){
    if(err){
        console.error(`error connecting` + err.message)
        return;
    }

    app.listen(process.env.PORT, ()=>{
        console.log(`your app runing in port ` + process.env.PORT)
    })
})



