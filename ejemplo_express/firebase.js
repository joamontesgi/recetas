const admin = require("firebase-admin");

const serviceAccount = require("./serviceAccountKey.json");

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: "https://test-3d0d9-default-rtdb.firebaseio.com"
});

const db = admin.database();

module.exports = db;
