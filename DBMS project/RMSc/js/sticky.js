var navbar = document.getElementById("navbr") ;
var menu = document.getElementById("menu") ;
var logo = document.getElementById("log") ;

window.onscroll = () => {
    if (window.pageYOffset >= menu.offsetTop) {
        navbar.classList.add("sticky") ;
        logo.classList.add("sticky") ;
    }
    else {
        navbar.classList.remove("sticky") ;
        logo.classList.remove("sticky") ;
    }
}

var btn = document.getElementById("reg") ;
var btn2 = document.getElementById("logi") ;
console.log (btn2) ;
btn.onclick = () => {
    
    location.href = "signup.html" ;
}

btn2.onclick = () => {
    location.href = "login.html" ;
}
