var app = angular.module('searchbar', []);

app.controller('searchbar-controller', function($scope, $http) {
    $scope.handleSearchButton = function(){
        document.getElementById("loader-animation").style.visibility = "visible";
        title = document.getElementById("input").value;
        
        $http.get('../webservice_buku/src/service/searchBook.php?title=' + title)
            .then(function(response) {
                $scope.books = response.data;
                document.getElementById("loader-animation").style.visibility = "hidden";
            });


        // xmlhttp = new XMLHttpRequest();
        // xmlhttp.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //         if(this.response[0] == '['){
        //             $scope.books= JSON.parse(this.response);
                    
        //         }
        //         // console.log(this.response);
        //     }
        // }

        // xmlhttp.open("POST", "../webservice_buku/src/service/searchBook.php", true);
        // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xmlhttp.send("title=" + title.value);
    }
});

