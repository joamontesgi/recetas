from rest_framework.permissions import BasePermission

TOKEN_SECRETO = "miclave123"

class ValidarTokenPersonalizado(BasePermission):
    def has_permission(self, request, view):
        token = request.headers.get('Authorization')
        return token == f"Token {TOKEN_SECRETO}"