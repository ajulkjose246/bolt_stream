$(document).ready(function () {
  
    $('.navbar-sec').hide();
    $(window).on('load', function () {
        $('.loading-sec').hide();
        $('.navbar-sec').show();
    }); 

    $(document).on("click",".selmovie",function(){
        let selmovie = $(this).attr('movie');
        localStorage.setItem("selected_movie",selmovie);
        window.location.href="./stream.html";
    })
    $(".log-out-btn").click(function(){
        localStorage.setItem("user_email", 0);
        localStorage.setItem("user_pwd", 0);
        window.location.href = "./index.html";
    })
    
})
