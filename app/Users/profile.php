<?php
error_reporting(E_ERROR | E_PARSE);
if ($_SESSION['userData'] != null) {
?>
    <link rel="stylesheet" href="/app/assets/profile/profile.css">
    <section class="home">
        <div id="cards-div">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-5"></div>
                    <div class="col-2">
                        <img class="usrProfile" src="https://cdn-icons-png.flaticon.com/512/924/924915.png" alt="">
                    </div>
                    <div class="col-5"></div>
                    <div class="col-12 mt-5">
                        <form>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <span class="form-control"><?=$_SESSION['userData']['usrName']?></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <span class="form-control"><?=$_SESSION['userData']['usrEmail']?></span>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-sm-2 col-form-label">Joined</label>
                                    <span class="form-control"><?=$_SESSION['userData']['usrCreated']?></span>
                                </div>
                                <!-- <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label text-white">ssssss.</label>
                                    <a href="updateProfile.php" class="form-control btn btn-primary">Profile Settings</a>
                                </div> -->
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
} else {
    echo ("<script>location.href='/'</script>");
} ?>