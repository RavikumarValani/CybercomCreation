var array = [];

function newUser() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('pass').value;
    var date = document.getElementById('date').value;

    var userData = {
        Name: name,
        Email: email,
        Password: password,
        Birthday: date
    }

    if (localStorage.getItem('array')) {
        userarr = JSON.parse(localStorage.getItem('array'));
    }

    array.push(userData);
    localStorage.setItem("User", JSON.stringify(array));
}


function getAge(dateofbirth) {
    var diff = Date.now() - dateofbirth.getTime();
    var age = new Date(diff);

    return Math.abs(age.getUTCFullYear() - 2021);

}
document.getElementById('age').innerHTML = getAge(new Date(date));


//Update User
function updateUser() {
    var updateUser = JSON.parse(localStorage.getItem('User'));
    updateUser.forEach(function(obj) {
        document.getElementById('name').value = obj.Name;
        document.getElementById('email').value = obj.Email;
        document.getElementById('pass').value = obj.Password;
        document.getElementById('date').value = obj.Birthday;
        document.getElementById('btnAddUser').innerHTML = "Update User";
    });
}

//Fech User
function fechUser() {
    var array = localStorage.getItem('User');
    var dataitems = JSON.parse(array);

    array = dataitems;
    document.write(`<table class="table">`);
    document.write(`<thead class="thead-dark">`);
    document.write(`<tr>`);
    document.write(`<th scope="col">Name</th>
    <th scope="col">Email</th>
    <th scope="col">Password</th>
    <th scope="col">date</th>
    <th scope="col">Age</th>
    <th scope="col">Action</th>
    </tr>
    <tbody>
    <tr>`);

    for (var i = 0; i < array.length; i++) {
        document.write('<td>' + array[i].name + '</td>');
        document.write('<td>' + array[i].email + '</td>');
        document.write('<td>' + array[i].pswd + '</td>');
        document.write('<td>' + array[i].date + '</td>');
        document.write('<td>' + getAge(array[i].date) + '</td>');
        document.write('<td><button type="button" class="btn btn-primary" onclick="updateUser()"> Update </button></td>');
        document.write('<td><button type="button" class="btn btn-danger" onclick="deleteUser()"> Delete </button></td>');
        document.write('</tr>');
        document.write('</tbody>');
        document.write('</thead>');
        document.write('</table>');

    }
}


//Delete User
function deleteUser() {
    var userData = JSON.parse(localStorage.getItem('User'));
    userData.forEach(function(obj) {
        localStorage.removeItem(obj.Name);
    });
}

function logout(){
    window.location = "login.html";
}