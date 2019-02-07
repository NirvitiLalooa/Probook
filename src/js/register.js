function checkBankAccountField() {
  bankAccount = document.getElementById("bankAccount-input");
  bankAccount = bankAccount.value;
  
  var xmlhttp = new XMLHttpRequest();
  var url = 'http://localhost:3000/customer/get/' + bankAccount;

  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          if(this.responseText[0] != 'E'){
            document.getElementById("bankAccount-check").style.visibility = "visible";
            document.getElementById("submit-register-btn").disabled = false;
            document.getElementById("submit-register-btn").style.backgroundColor = "white";
          } else {
            document.getElementById("bankAccount-check").style.visibility = "hidden";
            document.getElementById("submit-register-btn").disabled = true;
            document.getElementById("submit-register-btn").style.backgroundColor = "black";
          }
      }
  };

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function checkUsernameField() {
    xmlhttp = new XMLHttpRequest();

    username = document.getElementById("uname-input");

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response == 1) {
                document.getElementById("uname-check").style.visibility = "visible";
                document.getElementById("submit-register-btn").disabled = false;
                document.getElementById("submit-register-btn").style.backgroundColor = "white";
            } else {
                document.getElementById("uname-check").style.visibility = "hidden";
                document.getElementById("submit-register-btn").disabled = true;
                document.getElementById("submit-register-btn").style.backgroundColor = "black";
            }
        }
    }

    xmlhttp.open("POST", "../pages/register/checkUsername.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("username=" + username.value);
}

function checkEmailField() {
    xmlhttp = new XMLHttpRequest();

    email = document.getElementById("email-input");

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response == 1) {
                document.getElementById("email-check").style.visibility = "visible";
                document.getElementById("submit-register-btn").disabled = false;
                document.getElementById("submit-register-btn").style.backgroundColor = "white";
            } else {
                document.getElementById("email-check").style.visibility = "hidden";
                document.getElementById("submit-register-btn").disabled = true;
                document.getElementById("submit-register-btn").style.backgroundColor = "black";
            }
        }
    }

    xmlhttp.open("POST", "../pages/register/checkEmail.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("email=" + email.value);

    var re = /\S+@\S+\.\S+/;

    if (re.test(String(email.value).toLowerCase()) || email.value == ''){
        document.getElementById("email-err").style.visibility = "hidden";
        document.getElementById("submit-register-btn").style.backgroundColor = "white";
    } else {
        document.getElementById("email-err").style.visibility = "visible";
        document.getElementById("submit-register-btn").style.backgroundColor = "black";
    }
}

function validateName(){
    inputtedName = document.getElementById("name-input");
    
    if (inputtedName.value.length > 20){
        document.getElementById("name-err").style.visibility = "visible";
        document.getElementById("submit-register-btn").disabled = true;
        document.getElementById("submit-register-btn").style.backgroundColor = "black";
    } else {
        document.getElementById("name-err").style.visibility = "hidden";
        document.getElementById("submit-register-btn").disabled = false;
        document.getElementById("submit-register-btn").style.backgroundColor = "white";
    }
}

function validatePhoneNum(){
    phoneNum = document.getElementById("phone-input");
    
    if ((phoneNum.value.length < 9 || phoneNum.value.length > 12) && (phoneNum.value.length != 0)){
        document.getElementById("phone-err").style.visibility = "visible";
        document.getElementById("submit-register-btn").disabled = true;
        document.getElementById("submit-register-btn").style.backgroundColor = "black";
    } else {
        document.getElementById("phone-err").style.visibility = "hidden";
        document.getElementById("submit-register-btn").disabled = false;
        document.getElementById("submit-register-btn").style.backgroundColor = "white";
    }
}

function validatePassword(){
    psw = document.getElementById("password-input");
    confPsw = document.getElementById("confirmPassword-input");

    if (confPsw.value == psw.value){
        document.getElementById("password-err").style.visibility = "hidden";
        document.getElementById("submit-register-btn").disabled = false;
        document.getElementById("submit-register-btn").style.backgroundColor = "white";
    } else {
        document.getElementById("password-err").style.visibility = "visible";
        document.getElementById("submit-register-btn").disabled = true;
        document.getElementById("submit-register-btn").style.backgroundColor = "black";
    }
}