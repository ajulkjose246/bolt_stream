<?php
// error_reporting(E_ERROR | E_PARSE);
if ($_SESSION['userData'] != null) {
    $usrId = $_SESSION['userData']['usrId'];
    require __DIR__ . '/../Connection/db_connect.php';
?>
    <section class="home">
        <div id="cards-div">
            <h5 class="fw-bold">Bookmarks</h5>
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $result = crud("SELECT * FROM `tbl_bookmark` WHERE `bmUsrid` ='$usrId'");
                    while ($row = mysqli_fetch_array($result)) {
                        $imdb_id = $row['bmMov'];
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
                        <div class='col-6 col-sm-4 col-md-3 col-lg-2'>
                            <div class="row">
                                <div class="col-12">
                                    <a href='/movie/<?= $imdb_id ?>'>
                                        <div class='card'>
                                            <img src='<?= $movie['large_cover_image'] ?>' class='card-img-top' alt='<?= $movie['title'] ?>'>
                                            <div class='card-body'>
                                                <p class='card-text'><?= $movie['title'] ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 text-center">
                                    <a href="/app/Pages/removeBookmark.php?imdb=<?= $imdb_id ?>" class="btn btn-danger text-center"><i class="bi bi-bookmark-dash-fill"></i>Remove Bookmark</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php
} else {
    echo ("<script>location.href='/app/index.php'</script>");
} ?>