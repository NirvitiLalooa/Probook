function getBookDetail() {
    var xmlhttp = new XMLHttpRequest();
    var modal = document.getElementById('myModal');

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
        }
    };

    var id_book = document.getElementById("book-id").value;
    var id_user = document.getElementById("user-id").value;
    var amount = document.getElementById("amount").value;

    xmlhttp.open("POST", "../webservice_buku/src/service/getBookDetail.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("bookID=" + id_book + "&userID=" + id_user + "&amount=" + amount);
}

function order() {
    var xmlhttp = new XMLHttpRequest();
    var modal = document.getElementById('myModal');
    var modalFail = document.getElementById('myModal-fail');

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText[0] != "I"){
                modal.style.display = "block";
                beforeEdit = document.getElementById("modal-message").innerHTML;
                document.getElementById("modal-message").innerHTML = beforeEdit + " " + this.responseText;
            } else {
                modalFail.style.display = "block";
                beforeEdit = document.getElementById("modal-message-fail").innerHTML;
                document.getElementById("modal-message-fail").innerHTML = beforeEdit + " " + this.responseText;
            }
        }
    };
    var id_book = document.getElementById("book-id").value;
    var id_user = document.getElementById("user-id").value;
    var id_beneran = document.getElementById("beneran-id").value;
    var amount = document.getElementById("amount").value;

    xmlhttp.open("POST", "../pages/order/order.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("bookID=" + id_book + "&userID=" + id_user + "&amount=" + amount + "&beneranID=" + id_beneran);
}

function closeModal() {
    var modal = document.getElementById('myModal');
    modal.style.display = "none";
}

function closeModalFail() {
    var modalFail = document.getElementById('myModal-fail');
    modalFail.style.display = "none";
}