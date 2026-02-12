from flask import Flask
from flask_migrate import Migrate
from flask_cors import CORS
from config import Config
from models import db

app = Flask(__name__)
app.config.from_object(Config)

db.init_app(app)
migrate = Migrate(app, db)
CORS(app)

import models
import routes
routes.register_routes(app)

if __name__ == '__main__':
    app.run(debug=True)
