from flask import jsonify, request, current_app
from models import User, Post, db

def register_routes(app):
    @app.route('/api/users', methods=['GET'])
    def get_users():
        users = User.query.all()
        return jsonify([
            {
                'id': u.id,
                'name': u.name,
                'email': u.email
            }
            for u in users
        ])

    @app.route('/api/users/<int:id>', methods=['GET'])
    def get_user(id):
        user = User.query.get_or_404(id)
        return jsonify({
            'id': user.id,
            'name': user.name
        })

    @app.route('/api/users', methods=['POST'])
    def create_user():
        data = request.get_json()
        
        if not data or 'name' not in data or 'email' not in data:
            return jsonify({'error': 'Missing fields'}), 400
        
        new_user = User(name=data['name'], email=data['email'])
        db.session.add(new_user)
        db.session.commit()
        
        return jsonify({'id': new_user.id, 'name': new_user.name}), 201

    @app.route('/api/users/<int:id>', methods=['DELETE'])
    def delete_user(id):
        user = User.query.get_or_404(id)
        db.session.delete(user)
        db.session.commit()
        return jsonify({'message': 'User deleted'}), 204
    
    @app.route('/api/users/<int:id>', methods=['PUT'])
    def update_user(id):
        user = User.query.get_or_404(id)
        data = request.get_json()
        user.name = data.get('name', user.name)
        user.email = data.get('email', user.email)
        db.session.commit()
        return jsonify({'message': 'User updated'})
    
    @app.route('/api/posts', methods=['GET'])
    def get_posts():
        posts = Post.query.all()
        return jsonify([p.to_dict() for p in posts])
