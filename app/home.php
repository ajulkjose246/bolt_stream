
<section class="home">
    <div class="text">Latest Movies</div>
    <div id="cards-div">
        <div class="container-fluid">
            <div class="row recent">

            </div>
        </div>
    </div>
</section>
<section class="home">
    <div class="text">Popular Movies</div>
    <div id="cards-div">
        <div class="container-fluid">
            <div class="row popular">
            </div>
        </div>
    </div>
</section>
<script>
    // Set the API endpoint URL
    url = "https://yts.mx/api/v2/list_movies.json"
    // Sort by download count
    sort_by = "download_count"
    // Limit to 6 movies
    limit = 6
    //dispaly parent div
    div = ".popular"
    getMovie(url, sort_by, limit, div);

    // Set the API endpoint URL
    url = "https://yts.mx/api/v2/list_movies.json"
    // Sort by download recent
    sort_by = "recent"
    // Limit to 6 movies
    limit = 6
    //dispaly parent div
    div = ".recent"
    getMovie(url, sort_by, limit, div);
</script>
<script>
    console.log("User Email");
    console.log("<?=$_SESSION['userData']['usrEmail']?>");
    console.log("User Email");
</script>
