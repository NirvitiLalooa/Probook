<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro-Book Online Bookstore</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Carme" rel="stylesheet">
    <link href="../css/style.css" type="text/css" rel="stylesheet">
    <script src="../js/book.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="../js/searchbar.js"></script>
    <link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>

<!-- authentication -->
<?php include 'auth.php'?>

<body id="search" ng-app="searchbar" ng-controller="searchbar-controller">
    <div class="header">
        <div class="logo">
            <img src="../img/logo.jpg" alt="Pro-Book">
        </div>
        <div class="username">
            <h2 class="current-user"><?php echo"Hi, $username" ?></h2>
        </div>
        <div class="log-button">
            <a href="?logout"><img src="../img/log-button.jpg" alt="Logout" id="logout"></a>
        </div>
    </div>
    <nav class="menu-bar">
        <a href="search.php" class="browse">Browse</a>
        <a href="history.php" class="history">History</a>
        <a href="profile.php" class="profile">Profile</a>
    </nav>
    
    <!-- Searchbar -->
    <div id="searchbar" class="container">
        <div class="title">
            <h1 id="search-book">Search Book</h1>
        </div>
        <div class="row"> 
            <div class="col-sm-12">
                <input id="input" type="text" name="title" placeholder="Input search terms"><br><br>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10"></div>
            <div class="col-sm-2">
                <button id="submit" ng-click="handleSearchButton()">Search</button>
            </div>
        </div>
    </div>

    <!-- Search result -->
    <div id="loader-animation" style="visibility: hidden" class="loader"></div>
    <div class="result-container" ng-repeat="book in books">
        <div class="book-block">
            <div id="pic">
                <img src="{{book.imageUrl}}" alt="Book thumbnail">
            </div>
            <div id="content">
                <h2>{{book.title}}</h2>
                <h3>{{book.authors[0]}}</h3>
                <p>{{book.description}}</p>
            </div>
        </div>

        <form action="detail.php" method="GET">
            <input type="hidden" id="{{book.id}}" name="bookid" value="{{book.id}}">
            <input id="detail-btn" type="submit" value="Detail">
        </form>
    </div>
</body>
</html>