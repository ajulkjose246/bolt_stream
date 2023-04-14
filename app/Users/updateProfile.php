<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
if ($_SESSION['userData'] != null) {
    include("../header.php")
?>
    <link rel="stylesheet" href="/assets/profile/profile.css">
    <script src="/assets/validation/validation.js"></script>
    <section class="home">
        <div id="cards-div">
            <div class="container-fluid">
                <form action="#" class="akjFval" method="POST">
                    <div class="row">
                        <div class="col-5"></div>
                        <div class="col-2">
                            <img class="usrProfile" src="https://cdn-icons-png.flaticon.com/512/4333/4333609.png" alt="">
                            <!-- <input type="file" style="display: none;"> -->
                        </div>
                        <div class="col-5"></div>
                        <div class="col-12 mt-5">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="col-sm-12 col-form-label">Name</label>
                                    <input type="text" class="form-control akjval" RegExp="^[a-zA-Z ]+$" ErrMsg="Enter a Valid name" value="<?= $_SESSION['userData']['usrName'] ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-12 col-form-label">Email</label>
                                    <input type="email" class="form-control akjval" RegExp="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" ErrMsg="Enter a Valid email" value="<?= $_SESSION['userData']['usrEmail'] ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-sm-12 col-form-label">New Password</label>
                                    <input type="password" class="form-control akjval">
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-sm-12 col-form-label">Confirm Password</label>
                                    <input type="password" class="form-control akjval">
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-12 col-form-label text-white">ssssss.</label>
                                    <a href="profile.php" class="form-control btn btn-danger">Cancel</a>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="col-sm-12 col-form-label text-white">ssssss.</label>
                                    <a type="button" class="form-control btn btn-primary">Profile Settings</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php include("../footer.php");
} else {
    echo ("<script>location.href='/index.php'</script>");
} ?>