from django.contrib.auth.backends import BaseBackend
from .models import Residant, Pro_owner
from django.conf import settings

class ResidantAuth(BaseBackend):
    def authenticate(self, request, phone=None, password=None, **kwargs):
        try:
            res = Residant.objects.get(phn=phone)
            if res.psword == password: 
                return res
        
        except Residant.DoesNotExist:
            return None
    
    def get_user(self, user_id):
        try:
            return Residant.objects.get(phn=user_id)
        except Residant.DoesNotExist:
            return None
        