function checkData(){
    var email=document.getElementById('email').value;
    var pass=document.getElementById('pass').value;
    var ad_email=localStorage.getItem('e_mail');
    var ad_pass=localStorage.getItem('e_password');
    
    if(email==ad_email)
    {
        if(pass==ad_pass)
        {
            alert ("Login successfully");
             window.location = "Dashboard.html";
        }
        else{
            alert("Wrong Password")
        }
    }
    else
    {
        alert("Invalid Details")
    }
}