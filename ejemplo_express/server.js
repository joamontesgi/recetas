const express = require("express");
const db = require("./firebase");

const app = express();

app.use(express.json());

app.post("/users", function (req, res) {
    const ref = db.ref("users").push();
    ref.set({
        name: req.body.name,
        email: req.body.email,
        createdAt: Date.now()
    }).then(function () {
        res.json("Guardado");
    });
});

app.get("/users", function (_, res) {
    db.ref("users").once("value").then(function (snap) {
        const data = snap.val();
        const users = [];
        for (let id in data) {
            users.push({
                id: id,
                name: data[id].name,
                email: data[id].email,
            });
        }
        res.json(users);
    });
});

app.get("/users/:id", function (req, res) {
    db.ref("users/" + req.params.id).once("value").then(function (snapshot) {
        res.json({
            id: req.params.id,
            name: snapshot.val().name,
            email: snapshot.val().email
        });
    });
});

app.put("/users/:id", function (req, res) {
    db.ref("users/" + req.params.id)
        .update(req.body)
        .then(function () {
            res.json({ message: "Actualizado" });
        });
});

app.delete("/users/:id", function (req, res) {
    db.ref("users/" + req.params.id)
        .remove()
        .then(function () {
            res.json({ message: "Eliminado" });
        });
});

app.listen(3000, function () {
    console.log("Servidor en puerto 3000");
});
