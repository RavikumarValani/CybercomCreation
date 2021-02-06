function addData(){
    var name=document.getElementById('name').Value;
    var email=document.getElementById('email').Value;
    var password=document.getElementById('password').Value;
    var date=document.getElementById('date').Value;
    var row=1;
    var todayDate=new Date();
    var table=document.getElementById('user_table');
    var newrow=table.insertRow(row);
    var cell1=newrow.insertCell(0);
    var cell2=newrow.insertCell(1);
    var cell3=newrow.insertCell(2);
    var cell4=newrow.insertCell(3);
    var cell4=newrow.insertCell(4);
    var cell6=newrow.insertCell(5);
    cell1.innerHTML=name;
    cell2.innerHTML=email;
    cell3.innerHTML=password;
    cell4.innerHTML=date;
    cell5.innerHTML=todayDate-date;
    cell6.innerHTML="<a>edit </a> <a>edit </a>";
    row++;

}