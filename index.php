<?php 
include 'src/isiKartu.php'; 
include 'img/counter.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | CodingAhay</title>
<?php include 'src/header.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php" id="main">
            <img src="profil/profile_temp.png" alt="Logo" width="40" height="auto" class="d-inline-block align-text-bottom">
            <span class="judul">CodingAhay</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                <li class="nav-item ms-2">
                    <a class="nav-link" href="about.php" id="about">About</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-lg-0">
                <a class="btn btn-outline-success mx-3" href="login.php" role="button">
                    <i class="bx bx-log-in mx-auto"></i>
                    Login
                </a>
                <a class="btn btn-outline-primary mx-3" href="daftar.php" role="button">
                    <i class='bx bx-user-plus'></i>
                    Sign Up
                </a>
                <!--<form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>-->
            </ul>
        </div>
    </div>
</nav>
<div class="backgroundImg">
    <div class="container my-3">
        <!-- <h2 class="text-center mt-md-4">Mau belajar apa?</h2>
        <div class="row">
            <?php /* for ($i=0; $i < iterator_count($count) - 1; $i++) : */ ?>
            <div class="col-md-3 justify-content-center">
                <div class="card mt-4 mb-4 w-75 mx-auto text-light bg-dark bg-gradient">
                    <img src="img/<?php /* echo $i */ ?>.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3"><?= $lang[$i]; ?></h5>
                        <a href="#" class="d-flex btn btn-primary justify-content-center">Gaskeun..</a>
                    </div>
                </div>
            </div>
            <?php /* endfor; */ ?>
        </div> -->
        <h2 class="text-center mt-5 fw-bold">Halo! Selamat datang di CodingAhay!</h2><br />
        <div class="row mt-4">
            <div class="col-sm-4 ms-auto">
                <p>
                    <small>CodingAhay adalah sebuah forum dimana para programmer dari seluruh Indonesia berkumpul.<br /><br />
                    Ayo kita semua belajar bersama di <span><a href="guest/index.php">CodingAhay!</a></span><br />
                    Ingin menjadi bagian dari kami? <br /><span><a class="btn btn-primary mt-2" href="daftar.php" role="button">Sign Up</a></span><br /><br />
                    Sudah menjadi bagian dari kami?<br />
                    <span><a class="btn btn-success mt-2" href="login.php" role="button">Login</a></span></small>
                </p>
            </div>
            <div class="col-sm-5">
                <img src="ilustrations/ilustrations.svg" alt="ilustrasi" class="rounded float-start mt-4 w-75" />
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#about').removeClass('active')
    })
</script>
<?php
include 'src/footer.php';
?>