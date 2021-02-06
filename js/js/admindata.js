function checkData(){
    var email = document.getElementById('email').value;
    var password = document.getElementById('pass').value;
    var enter_email=localStorage.getItem('e_mail');
    var enter_password=localStorage.getItem('e_password');
    if(email!=null)
    {
        if(password!=null)
        {
            if(email==enter_email)
            {
                if(password==enter_password)
                {
                    alert ("Login successfully");
                    window.location = "Dashboard.html";
                }
                else
                {
                    alert("Wrong Password");
                }
            }
            else
            {
                alert("Invalid username and password")
            }
        }
        else
        {
            alert("please enter password");
        }
    
    }
    else
    {
        if(password==null)
        {
            alert("please enter details ");
        }
        else
        {
            alert("please enter email");
        }
        
    }
}