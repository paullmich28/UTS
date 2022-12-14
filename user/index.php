<?php
include '../koneksi.php';

session_start();
date_default_timezone_set('Asia/Jakarta');
$id = $_SESSION['user_id'];
if($_SESSION['user_status'] != 'online'){
    session_destroy();
    header('location:../login.php?status=logout');
}

$sql = "SELECT * FROM user WHERE id = ?";

$stmt = $db->prepare($sql);
$online = [$id];
$stmt->execute($online);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['action'])){
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];

    switch($action){
        case 'like':
            $sql = "INSERT INTO suka(suka_user, suka_thread, status)
                    VALUES({$id}, {$post_id}, '{$action}')
                    ON DUPLICATE KEY UPDATE status='like'";
            break;

        case 'unlike':
            $sql = "DELETE FROM suka WHERE suka_user = {$id} AND suka_thread = {$post_id}";
            break;

        default:
            break;
    }

    $db->query($sql);
    exit(0);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<?php include '../src/header.php' ?>
<div class="sidebar bg-dark">
    <div class="logo_content">
        <div class="logo text-white">
            <div class="logo_name fw-bold title">Coding<span class="half-color">Ahay</span></div>
        </div>
        <i class='bx bx-menu text-white btn'></i>
    </div>
    <ul class="navbar-nav">
        <li>
            <i class='bx bx-search mt-2'></i>
            <form action="test.php" method="post">
                <input type="text" placeholder="Search . . .">
            </form> 
        </li>
        <li>
            <a href="index.php" class="home list active">
                <i class='bx bx-home'></i>
                <span class="links_name">Home</span>
            </a>
        </li>
        <li>
            <a href="category.php" class="category list">
                <i class='bx bx-category'></i>
                <span class="links_name">Categories</span>
            </a>
        </li>
        <li>
            <a href="#" class="about list">
                <i class='bx bx-info-circle'></i>
                <span class="links_name">About</span>
            </a>
        </li>
        <li>
            <a href="profil.php" class="login list">
                <i class='bx bx-user-circle'></i>
                <span class="links_name">Profil</span>
            </a>
        </li>
        <li>
            <a href="logout.php" class="login list">
                <i class='bx bx-log-out'></i>
                <span class="links_name">Logout</span>
            </a>
        </li>
    </ul>
    <div class="profile_content">
        <div class="profile">
            <div class="profile_detail">
                <?php if($result['user_img'] == ""){ ?>
                    <a href="profil.php" class="list"><img src="../img/default.png" alt="" style="width: 35px;height: 35px;border-radius: 100%"></a>
                <?php }else{ ?>
                    <img src="../img/<?= $result['user_img'] ?>" alt="" style="width: 35px;height: 35px;border-radius: 100%">
                <?php } ?>
                <span class="name"><?= $result['user_nama'] ?></span>
            </div>
        </div>
    </div>
</div>
<div class="home_content mt-4">
    <h3>Halo, <?= $result['user_nama'] ?></h3><hr />
    <i class='bx bx-plus-circle btn tambahThread' ></i><br />
    <div class="row formThread">
        <div class="col-lg-4">
            <form action="thread_proses.php" method="post">
                <div class="card bg-light bg-gradient">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="fw-bold">Judul Thread</label>
                            <input type="text" name="judul_thread" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="fw-bold">Kategori</label><br />
                            <select class="form-control" name="kategori" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="1">Python</option>
                                <option value="2">HTML</option>
                                <option value="3">C/C++</option>
                                <option value="4">CSS</option>
                                <option value="5">JavaScript</option>
                                <option value="6">PHP</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label class="fw-bold">Isi Thread</label>
                            <textarea name="isi_thread" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary btn-sm pull-right" value="Submit Thread">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="threads">
    <?php
    $sqlThread = "SELECT * FROM thread, user, category WHERE thread_user = id AND id_category = thread_category ORDER BY tanggal_thread";
    $jumlahThread = $db->prepare($sqlThread);
    $jumlahThread->execute();
    
    if($jumlahThread->rowCount() == 0){ ?>
        <h3>Belum ada thread nih, tambahin yuk!</h3>
    <?php
    }else{
    while($threadShow = $jumlahThread->fetch(PDO::FETCH_ASSOC)){?>
    <div class="row">
        <div class="col-lg-4">
            <div class="card bg-light bg-gradient mt-3">
                <div class="card-body">
                    <div class="clearfix">
                        <span class="pull-left">
                        <?php 
                        if($threadShow['user_img'] == ""){
                            ?>
                            <img src="../img/default.png" class="mr-1" style="width: 35px;height: 35px;border-radius: 100%">
                            <?php
                        }else{
                            ?>
                            <img src="../img/<?php echo $threadShow['user_img']; ?>" class="mr-1" style="width: 35px;height: 35px;border-radius: 100%">
                            <?php
                        }
                        ?>
                        <?php echo $threadShow['user_nama']; ?>
                        </span>
                        <?php
                        if($id == $threadShow['id']){ ?>
                            <a href="?id=<?= $threadShow['id_thread'] ?>" class="btn btn-danger dlt">Delete Thread</a>
                            
                        <?php 
                        }
                        ?>
                        <br /><small class="mt-1 pull-right text-muted font-italic"><?php echo date('d-m-Y H:i:s',strtotime($threadShow['tanggal_thread'])); ?></small><br />
                        <small class="mt-1 pull-right text-muted font-italic">Kategori: <?php echo $threadShow['category_name']; ?></small>
                        
                        <hr />
                    </div>
                    
                    <h4 class="ms-4"><?= $threadShow['judul_thread'] ?></h4><hr />
                    <div class="mt-2">
                        <?php echo $threadShow['isi_thread']; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <i class='bx bx-like like-btn' data-id="<?= $threadShow['id_thread']; ?>"></i>
                    <i class='bx bx-comment btn btn-primary komen'><span>Komentar</span></i>
                    <div class="row formComment">
                        <div class="col-lg-10">
                            <form action="komen_proses.php" method="post">
                                <div class="form-group mt-3">
                                    <label class="fw-bold">Tambahkan Komentar</label>
                                    <input type="hidden" name="idthread" value="<?= $threadShow['id_thread'] ?>">
                                    <textarea name="isi_komen" cols="30" rows="5" class="form-control" required></textarea>
                                    <input type="submit" value="Comment" class="btn btn-primary">
                                </div>
                            </form>
                            <?php
                            $sqlKoment = "SELECT * FROM komentar WHERE komentar_thread = {$threadShow['id_thread']}";

                            $koment = $db->query($sqlKoment);
                            $koment->execute();
                                
                            
                            if($koment->rowCount() == 0){
                                echo 'Belum ada komen';
                            }else{
                                while($komentVal = $koment->fetch(PDO::FETCH_ASSOC)){ ?>
                                <div class="clearfix">
                                    <span class="pull-left">
                                    <?php 
                                    if($komentVal['komentar_img'] == ""){
                                        ?>
                                        <img src="../img/default.png" class="mr-1" style="width: 35px;height: 35px;border-radius: 100%">
                                        <?php
                                    }else{
                                        ?>
                                        <img src="../img/<?php echo $komentVal['komentar_img']; ?>" class="mr-1" style="width: 35px;height: 35px;border-radius: 100%">
                                        <?php
                                    }
                                    ?>
                                    <?php echo $komentVal['komentar_user_nama']; ?>
                                    </span>
                                    <?php
                                    if($id == $komentVal['komentar_userid']){ ?>
                                        <a href="?id=<?= $komentVal['id_komentar'] ?>" class="btn btn-danger dlt">Delete Thread</a>
                                        
                                    <?php 
                                    }
                                    ?>
                                    <br /><small class="mt-1 pull-right text-muted font-italic"><?php echo date('d-m-Y H:i:s',strtotime($komentVal['tanggal_komentar'])); ?></small>
                                </div>
                                
                                <div class="mt-2">
                                    <?php echo $komentVal['isi_komentar']; ?>
                                </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }
        } ?>
    </div>
</div>
<?php
if(isset($_GET['id'])){
    $sql = "DELETE FROM thread WHERE id_thread = '$_GET[id]'";
    $db->query($sql);

    echo "<meta http-equiv=refresh content=1;URL='index.php'>";
}
?>
<script type="text/javascript" src="likeDislikeSystem.js"></script>
<script>
    let btn = document.querySelector(".btn");
    let sidebar = document.querySelector(".sidebar");
    let search = document.querySelector(".bx-search");
    let plus = document.querySelector(".tambahThread");
    let form = document.querySelector(".formThread");

    btn.onclick = function(){
        sidebar.classList.toggle("active");
    }

    plus.onclick = function(){
        form.classList.toggle("active");
    }

    search.onclick = function(){
        sidebar.classList.toggle("active");
    }
</script>

<?php include '../src/footer.php' ?>