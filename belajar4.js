let user;

function login(nama){
    user = { nama : nama };
    console.log("Login Sebagai : " , user.nama);
}

function logout() {
    user = { nama : "Tamu" };
    console.log("User Logout : ", user.nama);
}

login("Arga");
logout();