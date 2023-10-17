const model = {}
const db = require('../database')


model.getData = async ({joinedArea, early_date,last_date})=>{
    joinedArea = joinedArea == "" ? "" : `AND sa.area_name in (${joinedArea})`
    early_date = early_date == "" && last_date == ""  ? "" : `AND (rp.tanggal BETWEEN '${early_date}' AND '${last_date}')`

    console.log(joinedArea)

    try {
        const result = await new Promise((resolve, reject) => {
            db.query(`select count(*) as jumlah, sum(rp.compliance) as total, sum(rp.compliance)/count(*)*100 as Nilai, rp.tanggal, sa.area_name from report_product rp 
            left join store s on rp.store_id = s.store_id 
            left join store_area sa on s.area_id = sa.area_id
            left join product p on rp.product_id = p.product_id 
            left join product_brand pb on p.brand_id  = pb.brand_id
            where true ${early_date} ${joinedArea}
            group by sa.area_name;
        `, (error, results) => {
                if (error) {
                    return reject(error)
                }else{
                return resolve(results)
            };
            })
        })
        return result
    } catch (error) {
        console.log(error)
    }
}

model.getBrand = async ({joinedArea, early_date,last_date})=>{
    joinedArea = joinedArea == "" ? "" : `AND sa.area_name in (${joinedArea})`
    early_date = early_date == "" && last_date == ""  ? "" : `AND (rp.tanggal BETWEEN '${early_date}' AND '${last_date}')`

    console.log(joinedArea)

    try {
        const result = await new Promise((resolve, reject) => {
            db.query(`select count(*) as jumlah, sum(rp.compliance) as total, sum(rp.compliance)/count(*)*100 as Nilai, rp.tanggal, sa.area_name, pb.brand_name from report_product rp 
            left join store s on rp.store_id = s.store_id 
            left join store_area sa on s.area_id = sa.area_id
            left join product p on rp.product_id = p.product_id 
            left join product_brand pb on p.brand_id  = pb.brand_id
            where true ${early_date} ${joinedArea}
            group by sa.area_name, pb.brand_name;
        `, (error, results) => {
                if (error) {
                    return reject(error)
                }else{
                return resolve(results)
            };
            })
        })
        return result
    } catch (error) {
        console.log(error)
    }
}

module.exports = model