function validateBankAccount() {
    bankAccount = document.getElementById("bankAccount-input");
    bankAccount = bankAccount.value;

    var xmlhttp = new XMLHttpRequest();
    var url = 'http://localhost:3000/customer/get/' + bankAccount;

  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          if(this.responseText[0] != "E"){
            document.getElementById("bankAccount-check").style.visibility = "visible";
            document.getElementById("submit-btn").disabled = false;
            document.getElementById("submit-btn").style.backgroundColor = "white";
          } else {
            document.getElementById("bankAccount-check").style.visibility = "hidden";
            document.getElementById("submit-btn").disabled = true;
            document.getElementById("submit-btn").style.backgroundColor = "black";
          }
      }
    }

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}