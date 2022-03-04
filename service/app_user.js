const { default: axios } = require('axios');
const express = require('express');
const app = express.Router();

const con = require("./db");
const db = con.db;


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

app.post("/api/getuser", (req, res) => {
    const { usrid } = req.body;
    const sql = `SELECT * FROM usertb WHERE usrid='${usrid}'`;
    db.query(sql).then(r => {
        res.status(200).json({
            data: r.rows
        })
    })
})

app.post("/api/insertuser", async (req, res) => {
    const { usrid, data } = req.body;
    // const sql = `INSERT INTO usertb(usrid, username, agency, linename, email, tel)VALUES('${usrid}', '${username}', '${agency}', '${linename}', '${email}', '${tel}') `;
    await db.query(`INSERT INTO usertb(usrid, ts)VALUES('${usrid}', now())`)

    let d;
    for (d in data) {
        if (data[d] !== '') {
            let sql = `UPDATE usertb SET ${d}='${data[d]}', ts=now() WHERE usrid='${usrid}'`;
            await db.query(sql)
        }
    }
    res.status(200).json({
        data: "success"
    })
})

app.post("/api/chkadmin", (req, res) => {
    const { usrid } = req.body;
    const sql = `SELECT * FROM usertb WHERE usrid='${usrid}'`;
    db.query(sql).then(r => {
        res.status(200).json({
            data: r.rows
        })
    })
})

app.post("/api/updateuser", (req, res) => {
    const { usrid, data } = req.body;
    const sql = `SELECT * FROM usertb WHERE usrid='${usrid}'`;
    let d;
    db.query(sql).then(r => {
        if (r.rows.length > 0) {
            for (d in data) {
                if (data[d] !== '') {
                    let sql = `UPDATE usertb SET ${d}='${data[d]}', ts=now() WHERE usrid='${usrid}'`;
                    console.log(sql);
                    db.query(sql)
                }
            }
        } else {
            db.query(`INSERT INTO usertb(usrid, ts)VALUES('${usrid}', now())`).then(() => {
                for (d in data) {
                    if (data[d] !== '') {
                        let sql = `UPDATE usertb SET ${d}='${data[d]}', ts=now() WHERE usrid='${usrid}'`;
                        db.query(sql)
                    }
                }
            })
        }
        res.status(200).json({ data: "success" })
    })
})

app.post("/api/insertfixed", async (req, res) => {
    const { data } = req.body;
    let pid = Date.now()
    await db.query(`INSERT INTO fixed(pid, ts)VALUES('${pid}', now())`)
    let d;
    for (d in data) {
        if (data[d] !== '') {
            let sql = `UPDATE fixed SET ${d}='${data[d]}' WHERE pid='${pid}'`;
            // console.log(sql);
            await db.query(sql)
        }
    }

    res.status(200).json({
        data: "success"
    })
})

app.get("/api/iotdata", async (req, res) => {
    let startDate = 'Wed,+04+Mar+2022+00:00:00+GMT';
    let endDate = 'Thu,+04+Mar+2022+17:00:00+GMT'
    axios.get(`http://envirservice.net/api/v1/reports/logs?device_id=25&begin_date=${startDate}&end_date=${endDate}`).then(async (r) => {
        // console.log(r.data.data);
        let dat = [];
        r.data.data.map(i => {
            // console.log(new Date(i.event));
            let d = new Date(i.event);
            // console.log(d, i.event);
            dat.push({
                dt: `${d.getFullYear()}-${d.getMonth()}-${d.getDate()} ${d.getHours()}:${d.getMinutes()}:${d.getSeconds()}`,
                // dat: d,
                lmax: Number(i.data.split(",")[10])
            })
        });
        await res.status(200).json(dat);
    });
});
console.log(new Date().toUTCString());

module.exports = app;