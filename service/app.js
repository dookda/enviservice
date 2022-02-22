const express = require('express');
const app = express.Router();

const con = require("./db");
const db = con.dat;


app.post("/api/insert", async (req, res) => {
    const { data } = req.body;
    let pid = Date.now();
    await db.query(`INSERT INTO faq(pid)VALUES('${pid}')`)
    let d;
    for (d in data) {
        if (data[d] !== '') {
            console.log(`${d}='${data[d]}'`);
            let sql = `UPDATE faq SET ${d}='${data[d]}' WHERE pid='${pid}'`;
            await db.query(sql)
        }
    }
    res.status(200).json({
        data: "success"
    })
});

app.get("/api/getlast5", (req, res) => {
    let sql = `SELECT * FROM faq ORDER BY gid DESC LIMIT 5`
    db.query(sql).then(r => {
        res.status(200).json({
            data: r.rows
        })
    })
});

app.post("/api/answer", (req, res) => {
    const { pid, ans } = req.body;
    let sql = `INSERT INTO answer(pid, ans)VALUES('${pid}','${ans}')`;
    db.query(sql).then(r => {
        res.status(200).json({
            data: "success"
        })
    })
});

app.post("/api/getdetail", (req, res) => {
    const { pid } = req.body;
    let sql = `SELECT * FROM answer WHERE answer='${pid}'`
    db.query(sql).then(r => {
        res.status(200).json({
            data: r.rows
        })
    })
});


module.exports = app;