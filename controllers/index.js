const model = require("../models")
const respone = require('../utils/respone')
const ctrl ={}

ctrl.getData = async (req, res)=>{
    try {
        //let city = 
        let { area, early_date, last_date } = req.query
        area = area ? area.split(',') : []
        early_date = early_date ? early_date : ""
        last_date = last_date ? last_date : ""
        const joinedArea = area.map(e=>`"${e}"`).join(', ')
        const result = await model.getData({joinedArea,early_date,last_date})
        return respone(res, 200, result)
    } catch (error) {
        console.log(error)
        return (res, 400, error)
    }
}

ctrl.getDataBrand = async (req, res)=>{
    try {
        let { area, early_date, last_date } = req.query
        area = area ? area.split(',') : []
        early_date = early_date ? early_date : ""
        last_date = last_date ? last_date : ""
        const joinedArea = area.map(e=>`"${e}"`).join(', ')
        const result = await model.getBrand({joinedArea,early_date,last_date})
        return respone(res,200,result)
    } catch (error) {
        return (res, 400, error)
    }
}
module.exports = ctrl