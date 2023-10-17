const {createConnection}= require('mysql');
require('dotenv').config()


const pool = createConnection({


    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME,
    connectionLimit: process.env.DB_CONN
})

module.exports = pool

