<?php
session_start();
include('config.php');
include('connect.php');

$customerID = $_SESSION['CustomerID'];
$select = "SELECT * FROM Customers WHERE CustomerID = $customerID";
$query = mysqli_query($connect, $select);
$row = mysqli_fetch_array($query);
$customerProfile = $row['ProfileImage'];

$moviesArray = array();
$select = "SELECT m.*, g.GenreName, f.FormatName FROM Movies m, Genres g, Formats f WHERE 
                            g.GenreID = m.GenreID AND 
                            f.FormatID = m.FormatID ORDER BY m.MovieID";
$query = mysqli_query($connect, $select);
$count = mysqli_num_rows($query);
if ($count > 0) {
    for ($i = 0; $i < $count; $i++) {
        $row = mysqli_fetch_array($query);
        array_push($moviesArray, $row);
        $movieID = $row['MovieID'];
        $movieName = $row['MovieName'];
        $moviePoster1 = $row['Poster1'];
        $genreID = $row['GenreID'];
        $formatID = $row['FormatID'];
        $genreName = $row['GenreName'];
        $formatName = $row['FormatName'];
        $duration = $row['Duration'];
        $hour = substr($duration, 1, 1) . 'hr';
        $minute = substr($duration, 3, 2) . 'min';
        $durationText = $hour . " " . $minute;
        $starring = $row['Starring'];
        $rating = $row['RatingPoint'];
        $overView = $row['OverView'];
        $movieTrailer = $row['Trailer'];
    }
}

$jsonMoviesArray = json_encode($moviesArray);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Video Streaming</title>
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo $version ?>" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?v=<?php echo $version ?>" />
    <!-- i will provide this in description  -->
    <link rel="stylesheet" href="css/slick.css?v=<?php echo $version ?>" />
    <link rel="stylesheet" href="css/slick-theme.css?v=<?php echo $version ?>" />
    <link rel="stylesheet" href="css/owl.carousel.min.css?v=<?php echo $version ?>" />
    <link rel="stylesheet" href="css/animate.min.css?v=<?php echo $version ?>" />
    <link rel="stylesheet" href="css/magnific-popup.css?v=<?php echo $version ?>" />
    <link rel="stylesheet" href="css/select2.min.css?v=<?php echo $version ?>" />
    <link rel="stylesheet" href="css/select2-bootstrap4.min.css?v=<?php echo $version ?>" />

    <link rel="stylesheet" href="css/slick-animation.css?v=<?php echo $version ?>" />
    <link rel="stylesheet" href="style.css?v=<?php echo $version ?>" />
    <script src="https://kit.fontawesome.com/b59b4a7b62.js?v=<?php echo $version ?>" crossorigin="anonymous"></script>
</head>

<body>
    <header id="main-header">
        <div class="main-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="navbar navbar-expand-lg navbar-light p-0">
                            <a href="#" class="navbar-toggler c-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <div class="navbar-toggler-icon" data-toggle="collapse">
                                    <span class="navbar-menu-icon navbar-menu-icon--top"></span>
                                    <span class="navbar-menu-icon navbar-menu-icon--middle"></span>
                                    <span class="navbar-menu-icon navbar-menu-icon--bottom"></span>
                                </div>
                            </a>
                            <a href="index.php" class="navbar-brand" style="color: red;font-size: 30px; font-weight:600; position:relative">
                                INFINITY <span style="position:absolute; font-size: 20px; top:0px">&#8734;</span>
                            </a>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="menu-main-menu-container">
                                    <ul id="top-menu" class="navbar-nav ml-auto">
                                        <li class="menu-item"><a href="index.php">Home</a></li>
                                        <li class="menu-item"><a href="#">Movies</a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="nowshowing.php">Now Showing</a></li>
                                                <li class="menu-item"><a href="">Coming Soon</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item">
                                            <a href="#">Theaters</a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="customerSidePages/theaterTypesPages/imax-theater.php?theaterType=Imax">Imax</a>
                                                </li>
                                                <li class="menu-item"><a href="customerSidePages/theaterTypesPages/luxe-theater.php?theaterType=Luxe">Luxe</a>
                                                </li>
                                                <li class="menu-item"><a href="customerSidePages/theaterTypesPages/ice-theater.php?theaterType=ICE">ICE</a>
                                                </li>
                                                <li class="menu-item"><a href="customerSidePages/theaterTypesPages/premium-theater.php?theaterType=Premium">Premium</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item"><a href="">About Us</a></li>
                                        <li class="menu-item">
                                            <a href="#">Contact Us</a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="#">Contact</a></li>
                                                <li class="menu-item"><a href="#">FAQ</a></li>
                                                <li class="menu-item">
                                                    <a href="#">Privacy-Policy</a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="#">Pricing</a>
                                                    <ul class="sub-menu">
                                                        <li class="menu-item">
                                                            <a href="#">Gold Membership</a>
                                                        </li>
                                                        <li class="menu-item">
                                                            <a href="#">Silver Membership</a>
                                                        </li>
                                                        <li class="menu-item">
                                                            <a href="#">Bronze Membership</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mobile-more-menu">
                                <a href="javascript:void(0);" class="more-toggle" id="dropdownMenuButton" data-toggle="more-toggle" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h"></i>
                                </a>
                                <div class="more-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="navbar-right position-relative">
                                        <ul class="d-flex align-items-center justify-content-end list-inline m-0">
                                            <li>
                                                <a href="#" class="search-toggle">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                                <div class="search-box iq-search-bar">
                                                    <form action="index.php" class="searchbox">
                                                        <div class="form-group position-relative">
                                                            <input type="text" class="text search-input autocompleteInput" placeholder="Search Movies or Theatres" />
                                                            <i class="search-link fa fa-search"></i>
                                                        </div>
                                                    </form>
                                                </div>

                                            </li>
                                            <li class="nav-item nav-icon">
                                                <a href="#" class="search-toggle position-relative">
                                                    <i class="fa fa-bell"></i>
                                                    <span class="bg-danger dots"></span>
                                                </a>
                                                <div class="iq-sub-dropdown">
                                                    <div class="iq-card shadow-none m-0">
                                                        <div class="iq-card-body">
                                                            <a href="#" class="iq-sub-card">
                                                                <div class="media align-items-center">
                                                                    <img src="images/notify/thumb-1.jpg" alt="" class="img-fluid mr-3" />
                                                                    <div class="media-body">
                                                                        <h6 class="mb-0">Captain Marvel</h6>
                                                                        <small class="font-size-12">just now</small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="#" class="iq-sub-card">
                                                                <div class="media align-items-center">
                                                                    <img src="images/notify/thumb-2.jpg" alt="" class="img-fluid mr-3" />
                                                                    <div class="media-body">
                                                                        <h6 class="mb-0">
                                                                            Dora and The Lost City of Gold
                                                                        </h6>
                                                                        <small class="font-size-12">25 mins ago</small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="#" class="iq-sub-card">
                                                                <div class="media align-items-center">
                                                                    <img src="images/notify/thumb-3.jpg" alt="" class="img-fluid mr-3" />
                                                                    <div class="media-body">
                                                                        <h6 class="mb-0">Mulan</h6>
                                                                        <small class="font-size-12">1h 30 mins
                                                                            ago</small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#" class="iq-user-dropdown search-toggle d-flex align-items-center">
                                                    <img src="customerProfileImg/<?php echo $customerProfile ?>" class="img-fluid user-m rounded-circle" alt="" />
                                                </a>
                                                <div class="iq-sub-dropdown iq-user-dropdown">
                                                    <div class="iq-card shadow-none m-0">
                                                        <div class="iq-card-body p-0 pl-3 pr-3">
                                                            <a href="customerUpdate.php" class="iq-sub-card setting-dropdown">
                                                                <div class="media align-items-center">
                                                                    <div class="right-icon">
                                                                        <i class="fa fa-user text-primary"></i>
                                                                    </div>
                                                                    <div class="media-body ml-3">
                                                                        <h6 class="mb-0">Manage Profile</h6>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="#" class="iq-sub-card setting-dropdown">
                                                                <div class="media align-items-center">
                                                                    <div class="right-icon">
                                                                        <i class="fa fa-cog text-primary"></i>
                                                                    </div>
                                                                    <div class="media-body ml-3">
                                                                        <h6 class="mb-0">Settings</h6>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="#" class="iq-sub-card setting-dropdown">
                                                                <div class="media align-items-center">
                                                                    <div class="right-icon">
                                                                        <i class="fa fa-inr text-primary"></i>
                                                                    </div>
                                                                    <div class="media-body ml-3">
                                                                        <h6 class="mb-0">Pricing Plan</h6>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <a href="customerLogout.php" class="iq-sub-card setting-dropdown">
                                                                <div class="media align-items-center">
                                                                    <div class="right-icon">
                                                                        <i class="fa fa-sign-out text-primary"></i>
                                                                    </div>
                                                                    <div class="media-body ml-3">
                                                                        <h6 class="mb-0">Logout</h6>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="navbar-right menu-right">
                                <ul class="d-flex align-items-center list-inline m-0">
                                    <li class="nav-item nav-icon">
                                        <a href="#" class="search-toggle device-search">
                                            <i class="fa fa-search"></i>
                                        </a>
                                        <div class="search-box iq-search-bar d-search">
                                            <form action="index.php" class="searchbox">
                                                <div class="form-group position-relative">
                                                    <input type="text" class="text search-input autocompleteInput font-size-12" placeholder="Search Movies or Theatres" />
                                                    <i class="search-link fa fa-search"></i>
                                                </div>
                                            </form>
                                            <div class="filteredMoviesContainer">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item nav-icon">
                                        <a href="#" class="search-toggle" data-toggle="search-toggle">
                                            <i class="fa fa-bell"></i>
                                            <span class="bg-danger dots"></span>
                                        </a>
                                        <div class="iq-sub-dropdown">
                                            <div class="iq-card shadow-none m-0">
                                                <div class="iq-card-body">
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center">
                                                            <img src="images/notify/thumb-1.jpg" alt="" class="img-fluid mr-3" />
                                                            <div class="media-body">
                                                                <h6 class="mb-0">Captain Marvel</h6>
                                                                <small class="font-size-12">just now</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center">
                                                            <img src="images/notify/thumb-2.jpg" alt="" class="img-fluid mr-3" />
                                                            <div class="media-body">
                                                                <h6 class="mb-0">
                                                                    Dora and The Lost City of Gold
                                                                </h6>
                                                                <small class="font-size-12">25 mins ago</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center">
                                                            <img src="images/notify/thumb-3.jpg" alt="" class="img-fluid mr-3" />
                                                            <div class="media-body">
                                                                <h6 class="mb-0">Mulan</h6>
                                                                <small class="font-size-12">1h 30 mins ago</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item nav-icon">
                                        <a href="#" class="iq-user-dropdown search-toggle d-flex align-items-center p-0">
                                            <img src="customerProfileImg/<?php echo $customerProfile ?>" class="img-fluid user-m rounded-circle" alt="" />
                                        </a>
                                        <div class="iq-sub-dropdown iq-user-dropdown">
                                            <div class="iq-card shadow-none m-0">
                                                <div class="iq-card-body p-0 pl-3 pr-3">
                                                    <a href="customerUpdate.php" class="iq-sub-card setting-dropdown">
                                                        <div class="media align-items-center">
                                                            <div class="right-icon">
                                                                <i class="fa fa-user text-primary"></i>
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0">Manage Profile</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="iq-sub-card setting-dropdown">
                                                        <div class="media align-items-center">
                                                            <div class="right-icon">
                                                                <i class="fa fa-cog text-primary"></i>
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0">Settings</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="iq-sub-card setting-dropdown">
                                                        <div class="media align-items-center">
                                                            <div class="right-icon">
                                                                <i class="fa fa-inr text-primary"></i>
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0">Pricing Plan</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="customerLogout.php" class="iq-sub-card setting-dropdown">
                                                        <div class="media align-items-center">
                                                            <div class="right-icon">
                                                                <i class="fa fa-sign-out text-primary"></i>
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <h6 class="mb-0">Logout</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="nav-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- slider starts  -->
    <section id="home" class="iq-main-slider p-0">
        <div id="home-slider" class="slider m-0 p-0">
            <div class="slide slide-bg" style="background-image: url(https://originserver-static1-uat.pvrcinemas.com/pvrcms/banner/Macmerisepilot_1587.jpg);">
            </div>
            <div class="slide slide-bg" style="background-image: url(https://originserver-static1-uat.pvrcinemas.com/pvrcms/banner/ICE_1714.jpg);">
            </div>
            <div class="slide slide-bg" style="background-image: url(https://originserver-static1-uat.pvrcinemas.com/pvrcms/banner/Weekday_Offers__2530.jpg);">
            </div>
            <?php
            $select = "SELECT m.*, g.GenreName, f.FormatName FROM Movies m, Genres g, Formats f WHERE 
                            g.GenreID = m.GenreID AND 
                            f.FormatID = m.FormatID ORDER BY m.MovieID";
            $query = mysqli_query($connect, $select);
            $count = mysqli_num_rows($query);
            if ($count > 0) {
                for ($i = 0; $i < 3; $i++) {
                    $row = mysqli_fetch_array($query);
                    $movieID = $row['MovieID'];
                    $movieName = $row['MovieName'];
                    $moviePoster2 = $row['Poster2'];
                    $genreID = $row['GenreID'];
                    $formatID = $row['FormatID'];
                    $genreName = $row['GenreName'];
                    $formatName = $row['FormatName'];
                    $duration = $row['Duration'];
                    $starring = $row['Starring'];
                    $rating = $row['RatingPoint'];
                    $overView = $row['OverView'];
                    $movieTrailer = $row['Trailer'];
            ?>
                    <div class="slide slick-bg" style="background-image: url(moviePosters/<?php echo $moviePoster2 ?>);">
                        <div class="container-fluid position-relative h-100">
                            <div class="slider-inner h-100">
                                <div class="row align-items-center h--100">
                                    <div class="col-xl-6 col-lg-12 col-md-12">
                                        <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft" data-delay-in="0.6">
                                            <?php echo $movieName ?>
                                        </h1>
                                        <div class="d-flex flex-wrap align-items-center fadeInLeft animated" data-animation-in="fadeInLeft" style="opacity: 1">
                                            <div class="slider-ratting d-flex align-items-center mr-4 mt-2 mt-md-3">
                                                <ul class="ratting-start p-0 m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <span class="text-white ml-2"><?php echo $rating ?>(imbd)</span>
                                            </div>
                                            <div class="d-flex align-items-center mt-2 mt-md-3">
                                                <span class="badge badge-secondary p-2">16+</span>
                                                <span class="ml-3"><?php echo $duration ?></span>
                                            </div>
                                        </div>
                                        <p data-animation-in="fadeInUp">
                                            <?php echo $overView ?>
                                        </p>
                                        <div class="trending-list" data-animation-in="fadeInUp" data-delay-in="1.2">
                                            <div class="text-primary title starring">
                                                Starring :
                                                <span class="text-body"><?php echo $starring ?></span>
                                            </div>
                                            <div class="text-primary title genres">
                                                Genre : <span class="text-body"><?php echo $genreName ?></span>
                                            </div>
                                            <div class="text-primary title tag">
                                                Format :
                                                <span class="text-body"><?php echo $formatName ?></span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center r-mb-23 mt-4" data-animation-in="fadeInUp" data-delay-in="1.2">
                                            <a href="movieDetail.php?deMovieID=<?php echo $movieID ?>" class="btn btn-hover iq-button" style="margin-right: 40px;">Book Tickets</a>
                                            <a href="movieTrailers/<?php echo $movieTrailer ?>" class="video-open playbtn">
                                                <span class="w-trailor">Watch Trailer</span>
                                                <img src="images/play.png" class="play" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </section>
    <!-- slider ends -->

    <!-- main content starts  -->
    <div class="main-content">
        <!-- Now Showing Section Starts -->
        <section id="iq-favorites">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Now Showing</h4>
                            <a href="nowshowing.php" class="iq-view-all">View All</a>
                        </div>
                        <div class="favorite-contens">
                            <ul class="favorites-slider list-inline row p-0 mb-0">
                                <?php
                                $select = "SELECT m.*, g.GenreName, f.FormatName FROM Movies m, Genres g, Formats f WHERE 
                                m.Status = 'Now Showing' AND
                            g.GenreID = m.GenreID AND 
                            f.FormatID = m.FormatID ORDER BY m.MovieID";
                                $query = mysqli_query($connect, $select);
                                $count = mysqli_num_rows($query);
                                if ($count > 0) {
                                    for ($i = 0; $i < $count; $i++) {
                                        $row = mysqli_fetch_array($query);
                                        $movieID = $row['MovieID'];
                                        $movieName = $row['MovieName'];
                                        $moviePoster1 = $row['Poster1'];
                                        $genreID = $row['GenreID'];
                                        $formatID = $row['FormatID'];
                                        $genreName = $row['GenreName'];
                                        $formatName = $row['FormatName'];
                                        $duration = $row['Duration'];
                                        $hour = substr($duration, 1, 1) . 'hr';
                                        $minute = substr($duration, 3, 2) . 'min';
                                        $durationText = $hour . " " . $minute;
                                        $starring = $row['Starring'];
                                        $rating = $row['RatingPoint'];
                                        $overView = $row['OverView'];
                                        $movieTrailer = $row['Trailer'];
                                ?>
                                        <li class="slide-item">
                                            <div class="block-images position-relative">
                                                <div class="img-box">
                                                    <img src="moviePosters/<?php echo $moviePoster1 ?>" class="img-fluid" alt="" />
                                                </div>
                                                <div class="block-description">
                                                    <h6 class="iq-title">
                                                        <?php echo $movieName ?>
                                                    </h6>
                                                    <div class="movie-time d-flex align-items-center my-2">
                                                        <div class="badge badge-secondary p-1 mr-2"><?php echo $genreName ?>
                                                        </div>
                                                        <span class="text-white"><?php echo $durationText ?></span>
                                                    </div>
                                                    <div class="hover-buttons">
                                                        <a href="movieDetail.php?deMovieID=<?php echo $movieID ?>" class="btn btn-hover">Book Tickets</a>
                                                    </div>
                                                </div>
                                                <div class="block-social-info">
                                                    <ul class="list-inline p-0 m-0 music-play-lists">
                                                        <li class="share">
                                                            <span><i class="fa fa-share-alt"></i></span>
                                                            <div class="share-box">
                                                                <div class="d-flex align-items-center">
                                                                    <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                                    <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                                    <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-heart"></i></span>
                                                            <span class="count-box">19+</span>
                                                        </li>
                                                        <li>
                                                            <span><i class="fa fa-plus"></i></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Now Showing section ends -->

        <!-- Upcoming movies section starts  -->
        <section id="iq-upcoming-movie">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Comming Soon</h4>
                            <a href="#" class="iq-view-all">View All</a>
                        </div>
                        <div class="favorite-contens">
                            <ul class="favorites-slider list-inline row p-0 mb-0">
                                <!-- slide item 1 -->
                                <li class="slide-item">
                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="images/popular/u1.jpg" class="img-fluid" alt="" />
                                        </div>
                                        <div class="block-description">
                                            <h6 class="iq-title">
                                                <a href="#"> Mulan </a>
                                            </h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">10+</div>
                                                <span class="text-white">2h</span>
                                            </div>
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover iq-button">
                                                    <i class="fa fa-play mr-1"></i>
                                                    Play Now
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block-social-info">
                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                <li class="share">
                                                    <span><i class="fa fa-share-alt"></i></span>
                                                    <div class="share-box">
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-heart"></i></span>
                                                    <span class="count-box">89+</span>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-plus"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- slide item 2 -->
                                <li class="slide-item">
                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="images/popular/u2.jpg" class="img-fluid" alt="" />
                                        </div>
                                        <div class="block-description">
                                            <h6 class="iq-title">
                                                <a href="#"> Laxmii </a>
                                            </h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">18+</div>
                                                <span class="text-white">2h 21min</span>
                                            </div>
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover iq-button">
                                                    <i class="fa fa-play mr-1"></i>
                                                    Play Now
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block-social-info">
                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                <li class="share">
                                                    <span><i class="fa fa-share-alt"></i></span>
                                                    <div class="share-box">
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-heart"></i></span>
                                                    <span class="count-box">35+</span>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-plus"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- slide item 3 -->
                                <li class="slide-item">
                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="images/popular/u3.jpg" class="img-fluid" alt="" />
                                        </div>
                                        <div class="block-description">
                                            <h6 class="iq-title">
                                                <a href="#"> Captain America </a>
                                            </h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">12+</div>
                                                <span class="text-white">2h 4min</span>
                                            </div>
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover iq-button">
                                                    <i class="fa fa-play mr-1"></i>
                                                    Play Now
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block-social-info">
                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                <li class="share">
                                                    <span><i class="fa fa-share-alt"></i></span>
                                                    <div class="share-box">
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-heart"></i></span>
                                                    <span class="count-box">99+</span>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-plus"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- slide item 4 -->
                                <li class="slide-item">
                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="images/popular/u4.jpg" class="img-fluid" alt="" />
                                        </div>
                                        <div class="block-description">
                                            <h6 class="iq-title">
                                                <a href="#"> Life of Pie </a>
                                            </h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">11+</div>
                                                <span class="text-white">2h 7min</span>
                                            </div>
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover iq-button">
                                                    <i class="fa fa-play mr-1"></i>
                                                    Play Now
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block-social-info">
                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                <li class="share">
                                                    <span><i class="fa fa-share-alt"></i></span>
                                                    <div class="share-box">
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-heart"></i></span>
                                                    <span class="count-box">19+</span>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-plus"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- slide item 5 -->
                                <li class="slide-item">
                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="images/popular/u5.jpg" class="img-fluid" alt="" />
                                        </div>
                                        <div class="block-description">
                                            <h6 class="iq-title">
                                                <a href="#"> Mission Mangal </a>
                                            </h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">12+</div>
                                                <span class="text-white">2h 10min</span>
                                            </div>
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover iq-button">
                                                    <i class="fa fa-play mr-1"></i>
                                                    Play Now
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block-social-info">
                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                <li class="share">
                                                    <span><i class="fa fa-share-alt"></i></span>
                                                    <div class="share-box">
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-heart"></i></span>
                                                    <span class="count-box">19+</span>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-plus"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- upcoming contents section ends -->

        <!-- top ten trending  -->

        <section id="iq-topten">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="topten-contents">
                            <h4 class="main-title iq-title topten-title">
                                Our Theaters
                            </h4>
                            <ul id="top-ten-slider" class="list-inline p-0 m-0 d-flex align-items-center">
                                <?php
                                $select = "SELECT * FROM Theaters Order By TheaterID";
                                $query = mysqli_query($connect, $select);
                                $count = mysqli_num_rows($query);
                                if ($count > 0) {
                                    for ($i = 0; $i < $count; $i++) {
                                        $row = mysqli_fetch_array($query);
                                        $theaterName = $row['TheaterName'];
                                        $theaterImage = $row['Image'];
                                        $location = $row['Location'];
                                ?>
                                        <li class="slick-bg">
                                            <a href="#">
                                                <img src="theaterImages/<?php echo $theaterImage ?>" class="img-fluid w-100" style='height:1000px' alt="" />
                                                <h6 class="iq-title"><a href="#"><?php echo $theaterName ?></a></h6>
                                            </a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                            <div class="vertical_s">
                                <ul id="top-ten-slider-nav" class="list-inline p-0 m-0 d-flex align-items-center">
                                    <?php
                                    $select = "SELECT * FROM Theaters Order By TheaterID";
                                    $query = mysqli_query($connect, $select);
                                    $count = mysqli_num_rows($query);
                                    if ($count > 0) {
                                        for ($i = 0; $i < $count; $i++) {
                                            $row = mysqli_fetch_array($query);
                                            $theaterID = $row['TheaterID'];
                                            $theaterName = $row['TheaterName'];
                                            $theaterImage = $row['Image'];
                                            $location = $row['Location'];
                                    ?>
                                            <li>
                                                <div class="block-images position-relative">
                                                    <a href="#">
                                                        <img src="theaterImages/<?php echo $theaterImage ?>" class="img-fluid w-100" style='height:200px' alt="" />
                                                    </a>
                                                    <div class="block-description">
                                                        <h5><?php echo $theaterName ?></h5>
                                                        <div class="movie-time d-flex align-items-center my-2">
                                                            <!-- <div class="badge badge-secondary p-1 mr-2">
                                                        10+
                                                    </div> -->
                                                            <span class="text-white">
                                                                <i class="fa-solid fa-location-dot"></i>
                                                                &nbsp<?php echo $location ?></span>
                                                        </div>
                                                        <div class="hover-buttons">
                                                            <a href="theaterDetail.php?deTheaterID=<?php echo $theaterID ?>" class="btn btn-hover" tabindex="0">
                                                                Book Tickets
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="iq-suggested" class="s-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Coming Soon</h4>
                            <a href="#" class="iq-view-all">View All</a>
                        </div>
                        <div class="favorite-contens">
                            <ul class="favorites-slider list-inline row p-0 mb-0">
                                <!-- slide item 1 -->
                                <li class="slide-item">
                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="images/suggested/01.jpg" class="img-fluid" alt="" />
                                        </div>
                                        <div class="block-description">
                                            <h6 class="iq-title">
                                                <a href="#"> Basketball </a>
                                            </h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">NBA</div>
                                                <span class="text-white">SPorts</span>
                                            </div>
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover iq-button">
                                                    <i class="fa fa-play mr-1"></i>
                                                    Play Now
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block-social-info">
                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                <li class="share">
                                                    <span><i class="fa fa-share-alt"></i></span>
                                                    <div class="share-box">
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-heart"></i></span>
                                                    <span class="count-box">89+</span>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-plus"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- slide item 2 -->
                                <li class="slide-item">
                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="images/suggested/02.jpg" class="img-fluid" alt="" />
                                        </div>
                                        <div class="block-description">
                                            <h6 class="iq-title">
                                                <a href="#"> VolleyBall </a>
                                            </h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">PRO</div>
                                                <span class="text-white">Sports</span>
                                            </div>
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover iq-button">
                                                    <i class="fa fa-play mr-1"></i>
                                                    Play Now
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block-social-info">
                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                <li class="share">
                                                    <span><i class="fa fa-share-alt"></i></span>
                                                    <div class="share-box">
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-heart"></i></span>
                                                    <span class="count-box">35+</span>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-plus"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- slide item 3 -->
                                <li class="slide-item">
                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="images/suggested/03.jpg" class="img-fluid" alt="" />
                                        </div>
                                        <div class="block-description">
                                            <h6 class="iq-title">
                                                <a href="#"> Basketball </a>
                                            </h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">LSU</div>
                                                <span class="text-white">Sports</span>
                                            </div>
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover iq-button">
                                                    <i class="fa fa-play mr-1"></i>
                                                    Play Now
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block-social-info">
                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                <li class="share">
                                                    <span><i class="fa fa-share-alt"></i></span>
                                                    <div class="share-box">
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-heart"></i></span>
                                                    <span class="count-box">99+</span>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-plus"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- slide item 4 -->
                                <li class="slide-item">
                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="images/suggested/04.jpg" class="img-fluid" alt="" />
                                        </div>
                                        <div class="block-description">
                                            <h6 class="iq-title">
                                                <a href="#"> Cricket </a>
                                            </h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">T-20</div>
                                                <span class="text-white">Sports</span>
                                            </div>
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover iq-button">
                                                    <i class="fa fa-play mr-1"></i>
                                                    Play Now
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block-social-info">
                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                <li class="share">
                                                    <span><i class="fa fa-share-alt"></i></span>
                                                    <div class="share-box">
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-heart"></i></span>
                                                    <span class="count-box">19+</span>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-plus"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- slide item 5 -->
                                <li class="slide-item">
                                    <div class="block-images position-relative">
                                        <div class="img-box">
                                            <img src="images/suggested/05.jpg" class="img-fluid" alt="" />
                                        </div>
                                        <div class="block-description">
                                            <h6 class="iq-title">
                                                <a href="#"> Golf </a>
                                            </h6>
                                            <div class="movie-time d-flex align-items-center my-2">
                                                <div class="badge badge-secondary p-1 mr-2">PGA</div>
                                                <span class="text-white">Sports</span>
                                            </div>
                                            <div class="hover-buttons">
                                                <span class="btn btn-hover iq-button">
                                                    <i class="fa fa-play mr-1"></i>
                                                    Play Now
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block-social-info">
                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                <li class="share">
                                                    <span><i class="fa fa-share-alt"></i></span>
                                                    <div class="share-box">
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="share-ico"><i class="fa fa-share-alt"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-youtube"></i></a>
                                                            <a href="#" class="share-ico"><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-heart"></i></span>
                                                    <span class="count-box">19+</span>
                                                </li>
                                                <li>
                                                    <span><i class="fa fa-plus"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- parallax section  -->
        <!-- About Us  -->
        <section id="parallex" class="parallax-window">
            <div class="container-fluid h-100">
                <div class="row align-items-center justify-content-center h-100 parallaxt-details">
                    <div class="col-lg-4 r-mb-23">
                        <div class="text-left">
                            <a href="javascript:void(0)">
                                <h1 class="parallax-heading">Avatar</h1>
                            </a>
                            <div class="parallax-ratting d-flex align-items-center mt-3 mb-3">
                                <ul class="ratting-start p-o m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                                    <li>
                                        <a href="#" class="text-primary"><i class="fa fa-star"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-primary"><i class="pl-2 fa fa-star"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-primary"><i class="pl-2 fa fa-star"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-primary"><i class="pl-2 fa fa-star"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-primary"><i class="pl-2 fa fa-star-half-o"></i></a>
                                    </li>
                                </ul>
                                <span class="text-white ml-3">7.8(Imbd)</span>
                            </div>
                            <div class="movie-time d-flex align-items-center mb-3">
                                <div class="badge badge-secondary p-1 mr-2">9+</div>
                                <span class="text-white">2h 42min</span>
                            </div>
                            <p>
                                A paraplegic Marine dispatched to the moon Pandora on a unique
                                mission becomes torn between following his orders and
                                protecting the world he feels is his home.
                            </p>
                            <div class="parallax-buttons">
                                <a href="#" class="btn btn-hover">Play Now</a>
                                <a href="#" class="btn btn-link">More Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="parallax-img">
                            <a href="#"><img src="images/parallax/avatar.jpg" alt="" class="img-fluid w-100" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- trending section  -->
        <section id="iq-trending" class="s-margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Trending</h4>
                        </div>
                        <div class="trending-contens">
                            <ul id="trending-slider-nav" class="list-inline p-0 mb-0 row align-items-center">
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="movie-slick position-relative">
                                            <img src="images/trending/01.jpg" class="img-fluid" alt="">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="movie-slick position-relative">
                                            <img src="images/trending/02.jpg" class="img-fluid" alt="">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="movie-slick position-relative">
                                            <img src="images/trending/03.jpg" class="img-fluid" alt="">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="movie-slick position-relative">
                                            <img src="images/trending/04.jpg" class="img-fluid" alt="">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="movie-slick position-relative">
                                            <img src="images/trending/05.jpg" class="img-fluid" alt="">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="movie-slick position-relative">
                                            <img src="images/trending/06.jpg" class="img-fluid" alt="">
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <ul id="trending-slider" class="list-inline p-0 m-0 d-flex align-items-center">
                                <li>
                                    <div class="tranding-block position-relative" style="background-image: url(images/trending/01.jpg);">
                                        <div class="trending-custom-tab">
                                            <div class="tab-title-info position-relative">
                                                <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center" role="tablist">
                                                    <li class="nav-item">
                                                        <a href="#trending-data1" class="nav-link active show" data-toggle="pill" role="tab" aria-selected="true">
                                                            Overview
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data2" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Episodes
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data3" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Trailers
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data4" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Similiar Like This
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="trending-content">
                                                <div id="trending-data1" class="overview-tab tab-pane fade active show">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="javascript:void(0);" tabindex="0">
                                                            <div class="res-logo">
                                                                <div class="channel-logo">
                                                                    <img src="images/logo.png" class="c-logo" alt="">
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">The Crown
                                                        </h1>
                                                        <div class="d-flex align-items-center text-white text-detail">
                                                            <span class="badge badge-secondary p-3">18+</span>
                                                            <span class="ml-3">3 Seasons</span>
                                                            <span class="trending-year">2020</span>
                                                        </div>
                                                        <div class="d-flex align-items-center series mb-4">
                                                            <a href="javascript:void(0);">
                                                                <img src="images/trending/trending-label.png" class="img-fluid" alt="">
                                                            </a>
                                                            <span class="text-gold ml-3">#2 in Series Today</span>
                                                        </div>
                                                        <p class="trending-dec">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex
                                                            facere sapiente optio dolor aperiam impedit sint molestiae
                                                            delectus, qui magni 1500 thid had that.
                                                        </p>
                                                        <div class="p-btns">
                                                            <div class="d-flex align-items-center p-0">
                                                                <a href="#" class="btn btn-hover mr-2" tabindex="0">
                                                                    <i class="fa fa-play mr-2"></i>
                                                                    Play Now
                                                                </a>
                                                                <a href="#" class="btn btn-link" tabindex="0">
                                                                    <i class="fa fa-plus pr-2"></i>
                                                                    My List
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="trending-list mt-4">
                                                            <div class="text-primary title">
                                                                Starring :
                                                                <span class="text-body">
                                                                    Clarie Foy, Olivia Colman, Imelda Staunton
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Genres :
                                                                <span class="text-body">
                                                                    Biography
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Creators :
                                                                <span class="text-body">
                                                                    Peter Morgan
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data2" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">the Crown
                                                        </h1>
                                                        <div class="d-flex align-items-center text-white text-detail mb-4">
                                                            <span class="season_date">
                                                                2 Seasons
                                                            </span>
                                                            <span class="trending-year">Feb 2019</span>
                                                        </div>
                                                        <div class="iq-custom-select d-inline-block sea-epi">
                                                            <select name="Seasons" class="form-control season-select">
                                                                <option value="Season1">Season 1</option>
                                                                <option value="Season2">Season 2</option>
                                                                <option value="Season3">Season 3</option>
                                                                <option value="Season4">Season 4</option>
                                                                <option value="Season4">Season 4</option>
                                                                <option value="Season6">Season 6</option>
                                                            </select>
                                                        </div>

                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div id="trending-data3" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">the crown
                                                        </h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data4" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">the Crown
                                                        </h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="tranding-block position-relative" style="background-image: url(images/trending/02.jpg);">
                                        <div class="trending-custom-tab">
                                            <div class="tab-title-info position-relative">
                                                <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center" role="tablist">
                                                    <li class="nav-item">
                                                        <a href="#trending-data5" class="nav-link active show" data-toggle="pill" role="tab" aria-selected="true">
                                                            Overview
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data6" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Episodes
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data7" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Trailers
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data8" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Similiar Like This
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="trending-content">
                                                <div id="trending-data5" class="overview-tab tab-pane fade active show">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="javascript:void(0);" tabindex="0">
                                                            <div class="res-logo">
                                                                <div class="channel-logo">
                                                                    <img src="images/logo.png" class="c-logo" alt="">
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Big Bang
                                                            Theory</h1>
                                                        <div class="d-flex align-items-center text-white text-detail">
                                                            <span class="badge badge-secondary p-3">15+</span>
                                                            <span class="ml-3">2 Seasons</span>
                                                            <span class="trending-year">2020</span>
                                                        </div>
                                                        <div class="d-flex align-items-center series mb-4">
                                                            <a href="javascript:void(0);">
                                                                <img src="images/trending/trending-label.png" class="img-fluid" alt="">
                                                            </a>
                                                            <span class="text-gold ml-3">#3 in Series Today</span>
                                                        </div>
                                                        <p class="trending-dec">
                                                            A woman who moves into an appartment across the hall from
                                                            two brilliant but social awkward physicists shows then how
                                                            little they know about life outside of the laboratory.
                                                        </p>
                                                        <div class="p-btns">
                                                            <div class="d-flex align-items-center p-0">
                                                                <a href="#" class="btn btn-hover mr-2" tabindex="0">
                                                                    <i class="fa fa-play mr-2"></i>
                                                                    Play Now
                                                                </a>
                                                                <a href="#" class="btn btn-link" tabindex="0">
                                                                    <i class="fa fa-plus pr-2"></i>
                                                                    My List
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="trending-list mt-4">
                                                            <div class="text-primary title">
                                                                Starring :
                                                                <span class="text-body">
                                                                    Jhonny Galecki, Jim Parsons , Kaley Cuoco
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Genres :
                                                                <span class="text-body">
                                                                    Comedy Romance
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Creators :
                                                                <span class="text-body">
                                                                    Chuck Lorre, Bill Prady
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data6" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Big Bang
                                                            Theory</h1>
                                                        <div class="d-flex align-items-center text-white text-detail mb-4">
                                                            <span class="season_date">
                                                                12 Seasons
                                                            </span>
                                                            <span class="trending-year">Feb 2019</span>
                                                        </div>
                                                        <div class="iq-custom-select d-inline-block sea-epi">
                                                            <select name="Seasons" class="form-control season-select">
                                                                <option value="Season1">Season 1</option>
                                                                <option value="Season2">Season 2</option>
                                                                <option value="Season3">Season 3</option>
                                                                <option value="Season4">Season 4</option>
                                                                <option value="Season5">Season 5</option>
                                                                <option value="Season6">Season 6</option>
                                                                <option value="Season7">Season 7</option>
                                                                <option value="Season8">Season 8</option>
                                                                <option value="Season9">Season 9</option>
                                                                <option value="Season10">Season 10</option>
                                                                <option value="Season11">Season 11</option>
                                                                <option value="Season12">Season 12</option>
                                                            </select>
                                                        </div>

                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div id="trending-data7" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Big Bang
                                                            Theory</h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data8" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Big Bang
                                                            Theory</h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/ce3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="tranding-block position-relative" style="background-image: url(images/trending/03.jpg);">
                                        <div class="trending-custom-tab">
                                            <div class="tab-title-info position-relative">
                                                <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center" role="tablist">
                                                    <li class="nav-item">
                                                        <a href="#trending-data9" class="nav-link active show" data-toggle="pill" role="tab" aria-selected="true">
                                                            Overview
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data10" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Episodes
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data11" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Trailers
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data12" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Similiar Like This
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="trending-content">
                                                <div id="trending-data9" class="overview-tab tab-pane fade active show">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="javascript:void(0);" tabindex="0">
                                                            <div class="res-logo">
                                                                <div class="channel-logo">
                                                                    <img src="images/logo.png" class="c-logo" alt="">
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Peaky
                                                            Blinders</h1>
                                                        <div class="d-flex align-items-center text-white text-detail">
                                                            <span class="badge badge-secondary p-3">11+</span>
                                                            <span class="ml-3">3 Seasons</span>
                                                            <span class="trending-year">2020</span>
                                                        </div>
                                                        <div class="d-flex align-items-center series mb-4">
                                                            <a href="javascript:void(0);">
                                                                <img src="images/trending/trending-label.png" class="img-fluid" alt="">
                                                            </a>
                                                            <span class="text-gold ml-3">#5 in Series Today</span>
                                                        </div>
                                                        <p class="trending-dec">
                                                            A gangster family epic set in 1990s England, centering on a
                                                            gang who sew razor blades in the peaks of their caps, and
                                                            their fierce boss Tommy Shelby.
                                                        </p>
                                                        <div class="p-btns">
                                                            <div class="d-flex align-items-center p-0">
                                                                <a href="#" class="btn btn-hover mr-2" tabindex="0">
                                                                    <i class="fa fa-play mr-2"></i>
                                                                    Play Now
                                                                </a>
                                                                <a href="#" class="btn btn-link" tabindex="0">
                                                                    <i class="fa fa-plus pr-2"></i>
                                                                    My List
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="trending-list mt-4">
                                                            <div class="text-primary title">
                                                                Starring :
                                                                <span class="text-body">
                                                                    Cillian Murphy, Paul Anderson, Helen McCrory
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Genres :
                                                                <span class="text-body">
                                                                    Crime, Drama
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Creators :
                                                                <span class="text-body">
                                                                    Steven Knight
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data10" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Peaky
                                                            Blinders</h1>
                                                        <div class="d-flex align-items-center text-white text-detail mb-4">
                                                            <span class="season_date">
                                                                2 Seasons
                                                            </span>
                                                            <span class="trending-year">Feb 2019</span>
                                                        </div>
                                                        <div class="iq-custom-select d-inline-block sea-epi">
                                                            <select name="Seasons" class="form-control season-select">
                                                                <option value="Season1">Season 1</option>
                                                                <option value="Season2">Season 2</option>
                                                                <option value="Season3">Season 3</option>
                                                                <option value="Season4">Season 4</option>
                                                                <option value="Season4">Season 4</option>
                                                                <option value="Season6">Season 6</option>
                                                            </select>
                                                        </div>

                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div id="trending-data11" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Peaky
                                                            Blinders</h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data12" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Peaky
                                                            Blinders</h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="tranding-block position-relative" style="background-image: url(images/trending/04.jpg);">
                                        <div class="trending-custom-tab">
                                            <div class="tab-title-info position-relative">
                                                <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center" role="tablist">
                                                    <li class="nav-item">
                                                        <a href="#trending-data13" class="nav-link active show" data-toggle="pill" role="tab" aria-selected="true">
                                                            Overview
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data14" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Episodes
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data15" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Trailers
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data16" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Similiar Like This
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="trending-content">
                                                <div id="trending-data13" class="overview-tab tab-pane fade active show">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="javascript:void(0);" tabindex="0">
                                                            <div class="res-logo">
                                                                <div class="channel-logo">
                                                                    <img src="images/logo.png" class="c-logo" alt="">
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Narcos</h1>
                                                        <div class="d-flex align-items-center text-white text-detail">
                                                            <span class="badge badge-secondary p-3">18+</span>
                                                            <span class="ml-3">3 Seasons</span>
                                                            <span class="trending-year">2015</span>
                                                        </div>
                                                        <div class="d-flex align-items-center series mb-4">
                                                            <a href="javascript:void(0);">
                                                                <img src="images/trending/trending-label.png" class="img-fluid" alt="">
                                                            </a>
                                                            <span class="text-gold ml-3">#21 in Series Today</span>
                                                        </div>
                                                        <p class="trending-dec">
                                                            A chronicled look at the criminal exploits of Colombian drug
                                                            lord Pablo Escobar, as well as the many other drug kingpins
                                                            who plagued the country through the years.
                                                        </p>
                                                        <div class="p-btns">
                                                            <div class="d-flex align-items-center p-0">
                                                                <a href="#" class="btn btn-hover mr-2" tabindex="0">
                                                                    <i class="fa fa-play mr-2"></i>
                                                                    Play Now
                                                                </a>
                                                                <a href="#" class="btn btn-link" tabindex="0">
                                                                    <i class="fa fa-plus pr-2"></i>
                                                                    My List
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="trending-list mt-4">
                                                            <div class="text-primary title">
                                                                Starring :
                                                                <span class="text-body">
                                                                    Pedro Pascal, Wagner Moura, Boyd Holbrook
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Genres :
                                                                <span class="text-body">
                                                                    Biography, Crime, Drama
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Creators :
                                                                <span class="text-body">
                                                                    Carlo Bernard, Chris Brancato, Doug Miro
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data14" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Narcos</h1>
                                                        <div class="d-flex align-items-center text-white text-detail mb-4">
                                                            <span class="season_date">
                                                                2 Seasons
                                                            </span>
                                                            <span class="trending-year">Feb 2019</span>
                                                        </div>
                                                        <div class="iq-custom-select d-inline-block sea-epi">
                                                            <select name="Seasons" class="form-control season-select">
                                                                <option value="Season1">Season 1</option>
                                                                <option value="Season2">Season 2</option>
                                                                <option value="Season3">Season 3</option>
                                                                <option value="Season4">Season 4</option>
                                                                <option value="Season4">Season 4</option>
                                                                <option value="Season6">Season 6</option>
                                                            </select>
                                                        </div>

                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n2.png" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div id="trending-data15" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Narcos</h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n2.png" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data16" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Narcos</h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="tranding-block position-relative" style="background-image: url(images/trending/05.jpg);">
                                        <div class="trending-custom-tab">
                                            <div class="tab-title-info position-relative">
                                                <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center" role="tablist">
                                                    <li class="nav-item">
                                                        <a href="#trending-data17" class="nav-link active show" data-toggle="pill" role="tab" aria-selected="true">
                                                            Overview
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data18" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Episodes
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data19" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Trailers
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data20" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Similiar Like This
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="trending-content">
                                                <div id="trending-data17" class="overview-tab tab-pane fade active show">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="javascript:void(0);" tabindex="0">
                                                            <div class="res-logo">
                                                                <div class="channel-logo">
                                                                    <img src="images/logo.png" class="c-logo" alt="">
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">FRIENDS</h1>
                                                        <div class="d-flex align-items-center text-white text-detail">
                                                            <span class="badge badge-secondary p-3">7+</span>
                                                            <span class="ml-3">10 Seasons</span>
                                                            <span class="trending-year">1994 - 2004</span>
                                                        </div>
                                                        <div class="d-flex align-items-center series mb-4">
                                                            <a href="javascript:void(0);">
                                                                <img src="images/trending/trending-label.png" class="img-fluid" alt="">
                                                            </a>
                                                            <span class="text-gold ml-3">#6 in Series Today</span>
                                                        </div>
                                                        <p class="trending-dec">
                                                            Follows the personal and professional lives of six twenty to
                                                            thirty-something-year-old friends living in Manhattan.
                                                        </p>
                                                        <div class="p-btns">
                                                            <div class="d-flex align-items-center p-0">
                                                                <a href="#" class="btn btn-hover mr-2" tabindex="0">
                                                                    <i class="fa fa-play mr-2"></i>
                                                                    Play Now
                                                                </a>
                                                                <a href="#" class="btn btn-link" tabindex="0">
                                                                    <i class="fa fa-plus pr-2"></i>
                                                                    My List
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="trending-list mt-4">
                                                            <div class="text-primary title">
                                                                Starring :
                                                                <span class="text-body">
                                                                    Jennifer Aniston, Courteney Cox, Lisa Kudrow
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Genres :
                                                                <span class="text-body">
                                                                    Comedy , Romance
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Creators :
                                                                <span class="text-body">
                                                                    David Crane, Marta Kauffman
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data18" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">FRIENDS</h1>
                                                        <div class="d-flex align-items-center text-white text-detail mb-4">
                                                            <span class="season_date">
                                                                10 Seasons
                                                            </span>
                                                            <span class="trending-year">Feb 2019</span>
                                                        </div>
                                                        <div class="iq-custom-select d-inline-block sea-epi">
                                                            <select name="Seasons" class="form-control season-select">
                                                                <option value="Season1">Season 1</option>
                                                                <option value="Season2">Season 2</option>
                                                                <option value="Season3">Season 3</option>
                                                                <option value="Season4">Season 4</option>
                                                                <option value="Season4">Season 4</option>
                                                                <option value="Season6">Season 6</option>
                                                            </select>
                                                        </div>

                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div id="trending-data19" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">FRIENDS</h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data20" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">FRIENDS</h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="tranding-block position-relative" style="background-image: url(images/trending/06.jpg);">
                                        <div class="trending-custom-tab">
                                            <div class="tab-title-info position-relative">
                                                <ul class="trending-pills d-flex nav nav-pills justify-content-center align-items-center text-center" role="tablist">
                                                    <li class="nav-item">
                                                        <a href="#trending-data21" class="nav-link active show" data-toggle="pill" role="tab" aria-selected="true">
                                                            Overview
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data22" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Episodes
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data23" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Trailers
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#trending-data24" class="nav-link" data-toggle="pill" role="tab" aria-selected="false">
                                                            Similiar Like This
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="trending-content">
                                                <div id="trending-data21" class="overview-tab tab-pane fade active show">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="javascript:void(0);" tabindex="0">
                                                            <div class="res-logo">
                                                                <div class="channel-logo">
                                                                    <img src="images/logo.png" class="c-logo" alt="">
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Mirzapur</h1>
                                                        <div class="d-flex align-items-center text-white text-detail">
                                                            <span class="badge badge-secondary p-3">18+</span>
                                                            <span class="ml-3">2 Seasons</span>
                                                            <span class="trending-year">2018</span>
                                                        </div>
                                                        <div class="d-flex align-items-center series mb-4">
                                                            <a href="javascript:void(0);">
                                                                <img src="images/trending/trending-label.png" class="img-fluid" alt="">
                                                            </a>
                                                            <span class="text-gold ml-3">#11 in Series Today</span>
                                                        </div>
                                                        <p class="trending-dec">
                                                            A shocking incident at a wedding procession ignites a series
                                                            of events entangling the lives of two families in the
                                                            lawless city of Mirzapur.
                                                        </p>
                                                        <div class="p-btns">
                                                            <div class="d-flex align-items-center p-0">
                                                                <a href="#" class="btn btn-hover mr-2" tabindex="0">
                                                                    <i class="fa fa-play mr-2"></i>
                                                                    Play Now
                                                                </a>
                                                                <a href="#" class="btn btn-link" tabindex="0">
                                                                    <i class="fa fa-plus pr-2"></i>
                                                                    My List
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="trending-list mt-4">
                                                            <div class="text-primary title">
                                                                Starring :
                                                                <span class="text-body">
                                                                    Pankaj Tripathi, Ali Fazal, Divyendu Sharma
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Genres :
                                                                <span class="text-body">
                                                                    Action, Crime, Drama
                                                                </span>
                                                            </div>
                                                            <div class="text-primary title">
                                                                Creators :
                                                                <span class="text-body">
                                                                    Puneet Krishna, Karan Anshuman
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data22" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Mirzapur</h1>
                                                        <div class="d-flex align-items-center text-white text-detail mb-4">
                                                            <span class="season_date">
                                                                2 Seasons
                                                            </span>
                                                            <span class="trending-year">Feb 2019</span>
                                                        </div>
                                                        <div class="iq-custom-select d-inline-block sea-epi">
                                                            <select name="Seasons" class="form-control season-select">
                                                                <option value="Season1">Season 1</option>
                                                                <option value="Season2">Season 2</option>
                                                            </select>
                                                        </div>

                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Episode 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div id="trending-data23" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Mirzapur</h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m1.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="trending-data24" class="overlay-tab tab-pane fade">
                                                    <div class="trending-info align-items-center w-100 animated fadeInUp">
                                                        <a href="#" tabindex="0">
                                                            <div class="channel-logo">
                                                                <img src="images/logo.png" class="c-logo" alt="">
                                                            </div>
                                                        </a>
                                                        <h1 class="trending-text big-title text-uppercase">Mirzapur</h1>
                                                        <div class="episodes-contens mt-4">
                                                            <div class="owl-carousel owl-theme episodes-slider1 list-inline p-0 m-0">
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/bbt3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 1</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/fe2.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 2</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/m4.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 3</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/pb3.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 4</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="e-item">
                                                                    <div class="block-image position-relative">
                                                                        <a href="#">
                                                                            <img src="images/episodes/n5.jpg" class="img-fluid" alt="">
                                                                        </a>
                                                                        <div class="episode-play-info">
                                                                            <div class="episode-play">
                                                                                <a href="#" tabindex="0">
                                                                                    <i class="fa fa-play"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="episodes-description text-body">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <a href="#">Trailer 5</a>
                                                                            <span class="text-primary">2.25m</span>
                                                                        </div>
                                                                        <p class="mb-0">Lorem ipsum dolor, sit amet
                                                                            consectetur adipisicing elit. Cumque aliquam
                                                                            quisquam iure tempore earum sequi.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- main content ends  -->
    <footer class="iq-bg-dark">
        <div class="footer-top">
            <div class="container-fluid">
                <div class="row footer-standard">
                    <div class="col-lg-5">
                        <div class="widget text-left">
                            <div>
                                <ul class="menu p-0">
                                    <li><a href="#">Terms of Use</a></li>
                                    <li><a href="#">Privacy-Policy</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Watch List</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget text-left">
                            <div class="textwidget">
                                <p><small>This is Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati,
                                        quo tempore. Quasi rem rerum est in nulla atque quibusdam illo. this is footer
                                        and simple tsesxij is writen jkd. fsek hello how are you. please like and
                                        subscribe. footer ends .</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                        <h6 class="footer-link-title">
                            Follow Us:
                        </h6>
                        <ul class="info-share">
                            <li>
                                <a href="#">
                                    <i>
                                        <fa class="fa fa-facebook"></fa>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i>
                                        <fa class="fa fa-youtube"></fa>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i>
                                        <fa class="fa fa-instagram"></fa>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                        <div class="widget text-left">
                            <div class="textwidget">
                                <h6 class="footer-link-title">
                                    Infinity App
                                </h6>
                                <div class="d-flex align-items-center">
                                    <a href="#"><img src="images/footer/01.jpg" alt=""></a>
                                    <br>
                                    <a href="#" class="ml-3"><img src="images/footer/02.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>COPYRIGHT © 2023 INFINITY LTD. ALL RIGHTS RESERVED.</div>
            </div>
        </div>
    </footer>

    <!-- js files  -->
    <script src="js/jquery-3.4.1.min.js?v=<?php echo $version ?>"></script>
    <script src="js/popper.min.js?v=<?php echo $version ?>"></script>
    <script src="js/bootstrap.min.js?v=<?php echo $version ?>"></script>
    <script src="js/slick.min.js?v=<?php echo $version ?>"></script>
    <script src="js/owl.carousel.min.js?v=<?php echo $version ?>"></script>
    <script src="js/select2.min.js?v=<?php echo $version ?>"></script>
    <script src="js/jquery.magnific-popup.min.js?v=<?php echo $version ?>"></script>
    <script src="js/slick-animation.min.js?v=<?php echo $version ?>"></script>
    <script src="main.js?v=<?php echo $version ?>"></script>
    <script>
        const moviesArray = <?php echo $jsonMoviesArray ?>;
        const autocompleteInput = document.querySelectorAll('.autocompleteInput');
        const filteredMoviesContainerTag = document.querySelector('.filteredMoviesContainer');
        autocompleteInput.forEach((inputTag) => {
            inputTag.addEventListener('keyup', (event) => {
                filteredMoviesContainerTag.innerHTML = '';
                const searchText = event.target.value.toLowerCase();
                if (searchText.length === 0) {
                    return;
                }
                const filteredMoviesArray = moviesArray.filter(movie => {
                    return movie['MovieName'].toLowerCase().includes(searchText);
                });
                const hasMoviesToShow = filteredMoviesArray.length > 0;
                if (hasMoviesToShow) {
                    filteredMoviesContainerTag.style.display = 'block';
                    filteredMoviesArray.forEach(element => {
                        // Creating searchedMovieContainerTag
                        const searchedMovieContainerTag = document.createElement('div');
                        searchedMovieContainerTag.classList.add('searchedMovieContainer');
                        searchedMovieContainerTag.id = element['MovieID'];
                        searchedMovieContainerTag.addEventListener('click', () => {
                            window.location.href = 'movieDetail.php?deMovieID=' + element[
                                'MovieID'];
                        })
                        // Creating searchedMovieImgContainerTag & imgTag
                        searchedMovieImgContainerTag = document.createElement('div');
                        searchedMovieImgContainerTag.classList.add('searchedMovieImg');
                        searchedMovieImgTag = document.createElement('img');
                        searchedMovieImgTag.src = "moviePosters/" + element['Poster1'];
                        searchedMovieImgContainerTag.append(searchedMovieImgTag)
                        // Creating searchedMovieDetailContainerTag 
                        searchedMovieDetailContainerTag = document.createElement('div');
                        searchedMovieDetailContainerTag.classList.add('searchedMovieDetail');

                        movieNameTag = document.createElement('div');
                        movieNameTag.classList.add('searchedMovieName');
                        movieNameTag.innerText = element['MovieName'];

                        movieDuration_GenreTag = document.createElement('div');
                        movieDuration_GenreTag.classList.add('searchedMovieDuration_Genre');
                        const duration = element['Duration'];
                        const hourText = duration.substr(1, 1) + 'hr';
                        const minuteText = duration.substr(3, 2) + 'min';
                        const durationText = hourText + " " + minuteText;
                        movieDuration_GenreTag.innerHTML =
                            `<small>${durationText}</small> | <small>${element['GenreName']}</small>`
                        searchedMovieDetailContainerTag.append(movieNameTag, movieDuration_GenreTag)
                        searchedMovieContainerTag.append(searchedMovieImgContainerTag,
                            searchedMovieDetailContainerTag)
                        filteredMoviesContainerTag.append(searchedMovieContainerTag);
                    })
                } else {
                    filteredMoviesContainerTag.style.display = 'none';
                }
            })
        })
    </script>
</body>

</html>