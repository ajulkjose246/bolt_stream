<?php
require_once 'api_services/index.php';
route('/', function(){
    require_once __DIR__.'/app/header.php';
    require_once __DIR__.'/app/home.php';
    require_once __DIR__.'/app/footer.php';
});
route('/api/?', function(){
    require_once __DIR__.'/api_services/index.php';
});

route('/register/?', function(){
    require_once __DIR__.'/app/Users/login.php';
});
route('/reguser/?', function(){
    require_once __DIR__.'/app/Users/regUser.php';
});
route('/logout/?', function(){
    require_once __DIR__.'/app/Connection/logout.php';
});
route('/profile/?', function(){
    require_once __DIR__.'/app/header.php';
    require_once __DIR__.'/app/Users/profile.php';
    require_once __DIR__.'/app/footer.php';
});
route('/search/?', function(){
    require_once __DIR__.'/app/header.php';
    require_once __DIR__.'/app/Pages/search.php';
    require_once __DIR__.'/app/footer.php';
});
route('/bookmark/?', function(){
    require_once __DIR__.'/app/header.php';
    require_once __DIR__.'/app/Pages/bookmark.php';
    require_once __DIR__.'/app/footer.php';
});
route('/about/?', function(){
    require_once __DIR__.'/app/header.php';
    require_once __DIR__.'/app/Pages/about.php';
    require_once __DIR__.'/app/footer.php';
});
route('/movie/(.*)/?', function($_certid){
    require_once __DIR__.'/app/header.php';
    require_once __DIR__.'/app/Pages/view_movie.php';
    require_once __DIR__.'/app/footer.php';
});

// route('/cert/(.*)/(.*)/?', function($_page,$_id){
//     // require_once __DIR__.'/public/auth/layout/_header.php';
//     require_once __DIR__.'/public/eventcert.php';
//     // require_once __DIR__.'/public/auth/layout/_footer.php';
// },">=0");

// route('/verify/(.*)/?', function($_certid){
//     // require_once __DIR__.'/public/auth/layout/_header.php';
//     require_once __DIR__.'/public/home/certificate_verify.php';
//     // require_once __DIR__.'/public/auth/layout/_footer.php';
// });

?>