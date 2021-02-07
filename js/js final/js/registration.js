function storeData(){
    var pass=document.getElementById('enter_pass').value;
    var c_pass =document.getElementById('con_pass').value;
    if(pass===c_pass)
    {
        localStorage.e_mail=document.getElementById('enter_email').value;
        localStorage.e_password=pass;
        alert("Register successfully");
    }
    else
    {
        alert('wrong password');
        return false;
    }
    

}

