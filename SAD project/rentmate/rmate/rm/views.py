from django.shortcuts import render, redirect
from urllib.parse import urlencode
from django.urls import *
# Create your views here.
from django.http import*
from django.core import signing
from .models import Residant, Pro_owner, Complain, ResRent, Notifications
from datetime import date, datetime
from django.db.models import *
import json
from django.contrib.auth import authenticate, login, logout 
from .backends import ResidantAuth
import uuid
import calendar
import gmplot
from django.contrib.auth.decorators import login_required

key = "011201171"
def landingpage(req):
    return render(req, "landing.html")

def aboutus(req):
    return render(req, "aboutus.html")

def loginPage(req):
    if req.method == "POST":
        typee = req.POST['typp']
        phnn = req.POST['__phn']
        passs = req.POST['__pass']
        res = ''
        #req.POST['csrfmiddlewaretoken'] = req.COOKIES.get('csrftoken')
        if typee == "Residant":
            # res = Residant.objects.get(phn = phnn)
            # #a = authenticate(req, phn=phnn, pasword=passs)
            # if res.psword == passs:
            #     #login(req, a)
            #     obj = res
            #     ecnr = signing.dumps(obj.phn, key=key)
            #     print(ecnr)
            #     return redirect('dashP', phn=ecnr)
            
            user_auth = ResidantAuth().authenticate(req, phone=phnn, password=passs)
            print(user_auth)
            if user_auth is not None:
                print("Hello " + phnn)
                res = Residant.objects.get(phn = phnn) 
                ecnr = signing.dumps(res.phn, key=key)
                req.session['residant'] = phnn
                return redirect('dashP', phn=ecnr)
        elif typee == "Property owner":
            res = Pro_owner.objects.get(phn = phnn)
            if passs == res.psword:
                pass   
    return render(req, "loginn.html") 

def logoutPage(req):
    req.session.flush()
    return redirect('login')

def dashboardR(req, phn):
    if 'residant' in req.session:
        real_val = signing.loads(phn, key=key)
        objt = Residant.objects.get(phn = real_val)
        noti= Notifications.objects.filter(user = real_val)
        noti_dump = noti.filter(status='unread').count()
        data = {
            'obj' : objt,
            'enp' : phn,
            'noti': noti,
            'cont':noti_dump,
        }
        return render (req, "dashboardmain.html", data)
    return redirect('login')

def payrent(req, phn):
    if 'residant' in req.session:
        val = phn
        real_v = signing.loads(val, key=key)
        objtt = Residant.objects.get(phn=real_v)
        pay = ResRent.objects.filter(user_id = real_v)
        obj = json.dumps(list(pay.values()))
        noti = Notifications.objects.filter(user = real_v) 
        noti_dump = noti.filter(status="unread").count()
        
        print(pay)
        data = {
            'owner' : objtt,
            'key' : val,
            'pay': obj, 
            'noti': noti,
            'cont': noti_dump,
        }
        
        return render(req, "payrent.html", data)
    return redirect('login')

def makecomplain(req, phn):
    if 'residant' in req.session:
        val = phn
        real_v = signing.loads(val, key=key)
        objtt = Residant.objects.get(phn=real_v)
        comp = Complain.objects.filter(user_id = real_v) #filtering the complains of particular users. returns <queryset>
        yearr = comp.values("year").annotate(count=Count("year")) #grouping the year along with counting them
        ye = json.dumps(list(yearr.values('year', 'count'))) #converting to json
        
        f_solve = comp.filter(slv_status = "solved")
        g_solve = f_solve.values("year").annotate(cntt = Count('year'))
        
        s_solve = json.dumps(list(g_solve.values('year', "cntt")))
        noti = Notifications.objects.filter(user = real_v)
        cnt = noti.filter(status='unread').count()
        print(cnt) 
        data = {
            'owner' : objtt,
            'key' : val,
            'comp': comp,
            'year': ye,
            'solve':s_solve,
            'noti': noti,
            'cont':cnt,
        }
        return render(req, "makecomplain.html", data)
    return redirect('login')

def register(req):
    if req.method == "POST":
        typ = req.POST["typ"]
        f_name = req.POST["fname"]
        lname = req.POST["lname"]
        gen = req.POST["gender"]
        phn = req.POST["phn"]
        mail = req.POST["mail"]
        passs = req.POST["pass"]
        p_add = req.POST["paddrs"]
        div = req.POST["test"]
        area = req.POST["test_"]
        nid = req.POST["NID"]
        hid = req.POST.get("houseid", None)
        
        if typ == "Residant":
            res = Residant(fname = f_name, lname = lname, gender = gen, phn = phn, mail = mail, psword = passs, p_addrs = p_add, div = div, area = "madaripur", nid = nid )
            res.save()
        
        if typ == "Property owner":
            p_owner = Pro_owner(fname = f_name, lname = lname, gender = gen, phn = phn, mail = mail, psword = passs, p_addrs = p_add, div = div, area = "madaripur", nid = nid, hid = hid )
            p_owner.save()
        return redirect("login")
           
    return render(req, "register.html") 

def savedata(req, phn):
    if req.method == "POST":
        val = signing.loads(phn, key=key)
        res = Residant.objects.get(phn=val)
        
        if req.POST['uname'] != "":
            res.uname = req.POST['uname']
        if req.POST['fname'] != "":
            res.fname = req.POST['fname']
        if req.POST['mail']!= "":
            res.mail = req.POST['mail']
        if req.POST['lname']!= "":
            res.lname = req.POST['lname']
        if req.POST['per_add']!= "":
            res.per_addrs = req.POST['per_add']
        if req.POST['abt_me']!= "":
            res.about_me = req.POST['abt_me']
        if req.POST['phn']!= "":
            res.phn = req.POST['phn']
        if req.POST['gender']!= "":
            res.gender = req.POST['gender']
        if req.POST['add']!= "":
            res.p_addrs = req.POST['add']
            
        res.save()   
           
    return redirect("dashP", phn=phn)

def complain(req, phn):
    id = phn
     
    real = signing.loads(id, key=key)
    if req.method == "POST":
        
        datee = date.today().strftime("%Y-%m-%d")
        typee = req.POST['typeS']
        des = req.POST['texta']
        year = datee.split("-")[0]
        if req.POST['nb'] != "":
            ne_id = req.POST['nb']
        else:
            ne_id = "null"
        print(ne_id)
        com = Complain(date = datee, prob_type = typee, prob_desc = des, user=Residant.objects.get(phn=real), year=year, nei_ID = ne_id)
        com.save() 

    return redirect ("complain", phn=id)


def payment(req, phn):
    real = signing.loads(phn, key=key)
    if req.method == "POST":
        datee = str(req.POST['date']) 
        strr = datee.split("-")[1]
        uniqID = real + "-" + datee.split("-")[0] + "-" + datee.split("-")[1]
        res = ResRent.objects.get(uniqID=uniqID)
        res.month = calendar.month_name[int(strr)]
        res.date = datee
        res.status = "PAID"
        res.paymentID = uuid.uuid1().hex
        res.save() 
        noti = "You have paid your payment of " + calendar.month_name[int(strr)] + " on " + datee
    else:
        noti = "Your payment has not been completed."
    
    noty = Notifications(notification = noti, user =Residant.objects.get(phn=real) , date = datee)
    noty.save()     
    return redirect('rent', phn=phn)  

def noti(req, phn):
    print("Updated") 
    nots = Notifications.objects.filter(user = signing.loads(phn, key=key))
    nots.update(status="read") 
    cnt = Notifications.objects.filter(user=signing.loads(phn, key=key), status="unread").count()
    return JsonResponse({'count':cnt})

def maps(req, phn):
    #gm = gmplot.GoogleMapPlotter.from_geocode("Dhaka, Bangladesh", apikey=api)
    
    return render(req, 'maps.html', ) 
 
    