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
});

app.post("/api/getalluser", (req, res) => {
    const { usrid } = req.body;
    // console.log(usrid);
    const sql = `SELECT * FROM usertb `;
    db.query(sql).then(r => {
        res.status(200).json({
            data: r.rows
        })
    })
});

app.post("/api/delete", (req, res) => {
    const { gid } = req.body;
    // console.log(gid);
    const sql = `DELETE FROM usertb WHERE gid=${gid}`;
    // console.log(sql);
    db.query(sql).then(r => {
        res.status(200).json({
            data: "success"
        })
    })
});

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
});

app.post("/api/chkadmin", (req, res) => {
    const { usrid } = req.body;
    const sql = `SELECT * FROM usertb WHERE usrid='${usrid}'`;
    db.query(sql).then(r => {
        res.status(200).json({
            data: r.rows
        })
    })
});

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
});

app.post("/api/getdevice", (req, res) => {
    const { userid } = req.body;
    // console.log(userid);
    const sql = `SELECT * FROM device WHERE userid='${userid}'`;
    db.query(sql).then(r => {
        res.status(200).json({
            data: r.rows
        })
    })
});

app.post("/api/insertdevice", (req, res) => {
    const { userid, device } = req.body;
    // console.log(userid);
    const sql = `INSERT INTO device (userid, device, ts) VALUES ('${userid}', ${device}, now())`;
    db.query(sql).then(r => {
        res.status(200).json({
            data: "success"
        })
    })
});

app.post("/api/deletedevice", (req, res) => {
    const { gid } = req.body;
    // console.log(gid);
    const sql = `DELETE FROM device WHERE gid=${gid}`;
    // console.log(sql);
    db.query(sql).then(r => {
        res.status(200).json({
            data: "success"
        })
    })
});

app.post("/api/getfixed", (req, res) => {
    const { userid } = req.body;
    const sql = `SELECT gid,owner_name,organize,product_type,descr,ts FROM fixed`;
    db.query(sql).then(r => {
        res.status(200).json({
            data: r.rows
        })
    })
});

app.post("/api/getfixedone", (req, res) => {
    const { gid } = req.body;
    const sql = `SELECT * FROM fixed WHERE gid=${gid}`;
    // console.log(sql);
    db.query(sql).then(r => {
        res.status(200).json({
            data: r.rows
        })
    })
});

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
});

app.post("/api/deletefixed", (req, res) => {
    const { gid } = req.body;
    const sql = `DELETE FROM fixed WHERE gid=${gid}`;
    db.query(sql).then(r => {
        res.status(200).json({
            data: "success"
        })
    })
});

app.post("/api/iotdata", async (req, res) => {
    let { device, dstart, dend } = req.body;
    const url = `http://envirservice.net/api/v1/reports/logs?device_id=${device}&begin_date=${dstart}&end_date=${dend}`;
    axios.get(url).then(async (r) => {
        if (r.data.data.length > 0) {
            let dat = [];
            r.data.data.map(i => {
                // let d = new Date(i.event);
                // console.log(i.event);
                dat.push({
                    // dt: `${d.getFullYear()}-${d.getMonth()}-${d.getDate()} ${d.getHours()}:${d.getMinutes()}:${d.getSeconds()}`,
                    dt: i.event,
                    lmax: Number(i.data.split(",")[10])
                })
            });
            await res.status(200).json(dat);
        } else {
            res.status(200).json({
                data: "nodata"
            });
        }
    });
});

app.get('/api/selectpic', (req, res) => {
    let sql = "SELECT * FROM img";
    db.query(sql).then(r => {
        res.status(200).json({
            data: r.rows
        });
    });
});

app.post("/api/updatepic", async (req, res) => {
    const { gid, img } = req.body;

    let sql = `UPDATE img SET img='${img}' WHERE gid='${gid}'`;
    // console.log(sql);
    await db.query(sql).then(
        res.status(200).json({
            data: "success"
        })
    )
});

const d = new Date();
let currentDate = d.toISOString().substring(0, 10);
console.log(d.getHours());
let notify = () => {
    let { device, dstart, dend } = req.body;
    axios.get(`http://envirservice.net/api/v1/reports/logs?device_id=${device}&begin_date=${dstart}&end_date=${dend}`).then(async (r) => {
        // console.log(r);
        if (r.data.data.length > 0) {
            let dat = [];
            r.data.data.map(i => {
                let d = new Date(i.event);
                dat.push({
                    dt: `${d.getFullYear()}-${d.getMonth()}-${d.getDate()} ${d.getHours()}:${d.getMinutes()}:${d.getSeconds()}`,
                    lmax: Number(i.data.split(",")[10])
                })
            });
            await res.status(200).json(dat);
        } else {
            res.status(200).json({
                data: "nodata"
            });
        }
    });
};

module.exports = app;