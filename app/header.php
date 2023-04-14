<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(E_ERROR | E_PARSE);
$usrData = $_SESSION['userData'];
 if($_SESSION['themeMode']==null){
        $_SESSION['themeMode']="Light";
    } ?>
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolt-Stream</title>
    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/app/assets/header/header.css">
    <link rel="stylesheet" href="/app/assets/index/index.css">

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="/app/assets/index/getMovies.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7440541691766969"
     crossorigin="anonymous"></script>
</head>

<body className="snippet-body">
    <div class="loader_bg">
        <div class="loader"></div>
    </div>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <!--<img src="logo.png" alt="">-->
<svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
  <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h8V1H4zm8 8H4v6h8V9zM1 1v2h2V1H1zm2 3H1v2h2V4zM1 7v2h2V7H1zm2 3H1v2h2v-2zm-2 3v2h2v-2H1zM15 1h-2v2h2V1zm-2 3v2h2V4h-2zm2 3h-2v2h2V7zm-2 3v2h2v-2h-2zm2 3h-2v2h2v-2z"/>
</svg>
                </span>
                <div class="text logo-text">
                    <span class="name"> Bolt-Stream</span>
                    <span class="profession">Movie Streaming</span>
                </div>
            </div>

            <i class="bx bx-chevron-right toggle"></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="/search">
                            <i class="bx bx-search icon"></i>
                            <span class="text nav-text">Search</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>
                    <?php if ($usrData != null) { ?>
                        <li class="nav-link">
                            <a href="/bookmark">
                                <i class="bx bx-book-bookmark icon"></i>
                                <span class="text nav-text">bookmark</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-link">
                        <a href="/about">
                            <i class="bx bx-code-alt icon"></i>
                            <span class="text nav-text">About</span>
                        </a>
                    </li>
                    <!-- <li class="nav-link">
                        <a href="/premium">
                            <i class="bx bx-star icon"></i>
                            <span class="text nav-text">Premiun</span>
                        </a>
                    </li> -->
                </ul>
            </div>

            <div class="bottom-content">
                <?php if ($usrData != null) { ?>
                    <li class="">
                        <a href="/logout">
                            <i class="bx bx-log-out icon"></i>
                            <span class="text nav-text">Logout</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/profile">
                            <i class="bx bx-user icon"></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="">
                        <a href="/register">
                            <i class="bx bx-user icon"></i>
                            <span class="text nav-text">Login</span>
                        </a>
                    </li>
                <?php } ?>
                    <div class="modeChange">
                        <li class="theme">
                             <a href="#">
                            <i class="bi bi-moon-fill icon"></i>
                            <span class="text nav-text">Dark Mode</span>
                             <a href="/register">
                        </li>
                    </div>
            </div>
        </div>
    </nav>
    <script src="/app/assets/header/header.js"></script>
</body>
      <script>
        setTimeout(function(){
            $('.loader_bg').fadeToggle();
        }, 1500);
     </script>
<script>
$(document).ready(()=>{
      const themeMode = document.cookie.split("; ").find(row => row.startsWith("themeMode="))?.split("=")[1];
          $(".theme").remove()
      if(themeMode=="Dark"){
        document.body.classList.toggle("dark-theme");
        $(".theme").remove()
        $(".modeChange").append("<li class='theme'><a href='#'><i class='bi bi-brightness-high-fill icon'></i><span class='text nav-text'>Light Mode</span></a></li>");
        document.cookie = "themeMode=Dark";
      }else{
          $(".theme").remove()
            $(".modeChange").append("<li class='theme'><a href='#'><i class='bi bi-moon-fill icon'></i><span class='text nav-text'>Dark Mode</span></a></li>")
            document.cookie = "themeMode=Light";
      }
    $(".modeChange").click(()=>{
        document.body.classList.toggle("dark-theme");
        if ($('body').hasClass('dark-theme')) {
            $(".theme").remove()
            $(".modeChange").append("<li class='theme'><a href='#'><i class='bi bi-brightness-high-fill icon'></i><span class='text nav-text'>Light Mode</span></a></li>");
            document.cookie = "themeMode=Dark";
        } else {
          $(".theme").remove()
            $(".modeChange").append("<li class='theme'><a href='#'><i class='bi bi-moon-fill icon'></i><span class='text nav-text'>Dark Mode</span></a></li>")
            document.cookie = "themeMode=Light";
        }

    })
})
</script>