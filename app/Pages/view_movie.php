<?php
// fetch movie comments
$uri = $_SERVER['REQUEST_URI'];
$imdb_id = preg_match('/[^\/]+$/', $uri, $matches) ? $matches[0] : null;

$url = "https://yts.mx/api/v2/movie_details.json?imdb_id=" . urlencode($imdb_id);
$response = file_get_contents($url);
if (!$response) {
    die("Failed to fetch movie details.");
}
$data = json_decode($response, true);
$movie = $data['data']['movie'];
if (!$data) {
    die("Failed to parse movie details.");
}

?>
<script>console.log('<?=$imdb_id?>')</script>
<link rel="stylesheet" href="/app/assets/view_movies/view_movies.css">
<section class="home">
    <div id="cards-div">
        <div class="container-fluid">
            <div class="row main_row">
                <div class="col-12 col-md-4 m-2 mov_img_div">
                    <div class="bm-alert"></div>
                    <div class="row">
                        <div class="col-12">
                            <img src="<?= $movie['large_cover_image'] ?>" alt="">
                        </div>
                        <?php if ($_SESSION['userData']['usrId'] != null) { ?>
                            <span class="movBookmark" onclick="bookmark('<?= $imdb_id ?>','<?= $_SESSION['userData']['usrId'] ?>',1)"><i class="bi bi-bookmark-fill"></i></span>
                        <?php } ?>
                        <div class="col-6 mt-2">
                            <div class="d-grid gap-1">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#movieWatch" type="button">Watch</button>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="d-grid gap-1">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#movieTrailer" type="button">Trailer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7 m-2 column">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="fw-bold"><?= $movie['title'] ?> [<?= $movie['language'] ?>] - <?= $movie['year'] ?></h3>
                        </div>
                        <div class="col-12">
                            <h6>IMDB <?= $movie['rating'] ?> <i class="bi bi-star-fill"></i></h6>
                        </div>
                        <div class="col-12 mt-2">
                            <h6>
                                <?php
                                $genres = $movie['genres'];
                                foreach ($genres as $value) {
                                    echo ("$value ");
                                } ?>
                            </h6>
                        </div>

                        <div class="col-12 mt-4">
                            <h6 class="fw-bold">Summary</h6>
                            <p><?= $movie['description_full'] ?></p>
                        </div>

                        <div class="col-12 mt-4">
                            <h6 class="fw-bold">Available in:</h6>
                        </div>
                        <?php
                        $torrent = $movie['torrents'];
                        foreach ($torrent as $value) { ?>
                            <div class="d-grid mt-2 gap-2 col-6 mx-auto">
                                <a href="<?= $value['url'] ?>" class="btn btn-outline-primary btn-sm"><?= $value['quality'] ?> <?= $value['type'] ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-12 col-sm-12 m-2">
                    <h5 class="fw-bold">Tech Specs</h5>
                    <div class="accordion" id="accordionExample">
                        <?php
                        $torrent = $movie['torrents'];
                        foreach ($torrent as $value) {
                        ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $value['hash'] ?>" aria-expanded="false" aria-controls="<?= $value['hash'] ?>">
                                        <?= $value['quality'] ?> <?= $value['type'] ?>
                                    </button>
                                </h2>
                                <div id="<?= $value['hash'] ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="row">
                                        <div class="col-6 col-sm-6 col-md-3">
                                            <div class="accordion-body">
                                                <i class="bi bi-folder2"></i> <?= $value['size'] ?> <br>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3">
                                            <div class="accordion-body">
                                                <b>P/S</b> <?= $value['peers'] ?> / <?= $value['seeds'] ?> <br>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3">
                                            <div class="accordion-body">
                                                <i class="bi bi-calendar-check"></i> <?= $value['date_uploaded'] ?> <br>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3">
                                            <div class="accordion-body">
                                                <i class="bi bi-translate"></i> <?= $movie['language'] ?> <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="movieWatch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Watch Movie</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe style="border-radius: 10px;" src="https://www.2embed.cc/embed/<?= $imdb_id ?>" width="100%" height="500" frameborder="0" scrolling="no" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="movieTrailer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Movie Trailer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe style="border-radius: 10px;" width="100%" height="500" src="https://www.youtube.com/embed/<?= $movie['yt_trailer_code'] ?>?controls=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    $(document).ready(() => {
        bookmark('<?= $imdb_id ?>', '<?= $_SESSION['userData']['usrId'] ?>', 0)
    })

    function bookmark(movId, usrId, condition) {
        $.ajax({
            url: "/app/Pages/bookmarkAjax.php",
            type: "post",
            data: {
                movId: movId,
                usrId: usrId,
                condition: condition,
            },
            success: function(data) {
console.log(data)
                if (data == 1) {
                    $(".bi-bookmark-fill").attr("style", "color:green !important");
                    $(".alert").remove();
                    $(".bm-alert").append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> <strong>Movie is now bookmarked</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>")
                    console.log(data)
                } else if (data == 0) {
                    $(".bi-bookmark-fill").attr("style", "color:gray !important");
                    $(".alert").remove();
                    $(".bm-alert").append("<div class='alert alert-warning alert-dismissible fade show' role='alert'> <strong>Bookmark has been removed</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>")
                    console.log(data)
                } else if (data == 2) {
                    $(".bi-bookmark-fill").attr("style", "color:green !important");
                    console.log(data)
                } else if (data == 3) {
                    $(".bi-bookmark-fill").attr("style", "color:gray !important");
                    console.log(data)
                }
            },
        });
    }
</script>
