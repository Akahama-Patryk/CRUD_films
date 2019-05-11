// CODE VAN PATRYK ORLOWSKI N2F
<?php
session_start();
if (isset($_GET['NR']) && !empty($_GET['NR'])) {
    $updateID = $_GET['NR'];
}else{
    $error = 'UPDATE';
    $error = $_SESSION['error'];
    header("Location: error.php");
    return $_SESSION['error'];
};
include_once "Class/MovieDatabase.php";
$data = array();
$readUpdate = array();
$fetch = new MovieDatabase();
$fetchReadUpdate = new MovieDatabase();
$data = $fetch->fetchDir();
$readUpdate = $fetchReadUpdate->fetchUpdate($updateID);
if (isset($_POST['submit'])) {
    var_dump($updateID,$_POST['movie'],$_POST['director'],$_POST['year'],$_POST['genre'],$_POST['time']);
    $sent = new MovieDatabase();
    $sent->formUpdate($_POST['movie'],$_POST['director'],$_POST['year'],$_POST['genre'],$_POST['time'],$updateID);
}
if (!empty($_SESSION['placeholder'])){
    $datasave = $_SESSION['placeholder'];
};
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
<body>
<ul class="nav nav-pills nav-fill rounded-0">
    <li class="nav-item">
        <a class="nav-link" href="index_READ.php">READ MovieDatabase</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="CREATE.php">CREATE MovieDatabase</a>
    </li>
        <li class="nav-item">
            <a class="nav-link active disabled" href="UPDATE.php">UPDATE MovieDatabase</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="DELETE.php">DELETE MovieDatabase</a>
        </li>
</ul>
<form method='POST'>
    <?php
    foreach ($datasave as $sessiondata) :
    ?>
    <h2>CREATE</h2>
    <label for="movie">Film Titel</label>
    <input type="text" name="movie"
           id="movie" required
           placeholder="<?= $sessiondata['TITEL'] ?>">
    <br>
    <label for="director">Film Regisseur</label>
    <select name="director">
        <option value="<?= $sessiondata["DIRNR"]?>" disabled selected><?= $sessiondata["ACHTERNAAM"] .'&nbsp;' . $sessiondata["VOORNAAM"] ?></option>
        <?php
        foreach ($data as $row) :
            ?>
            <option value="<?= $row["NR"] ?>"><?= $row["ACHTERNAAM"] .'&nbsp;' . $row["VOORNAAM"] ?></option>
        <?php
        endforeach;
        ?>
    </select>
    <br>
    <label for="year">Film Jaar</label>
    <input type="number" name="year"
           id="number" required
           placeholder="<?= $sessiondata['JAAR'] ?>">
    <br>
    <label for="genre">Film Genre</label>
    <input type="text" name="genre"
           id="genre" required
           placeholder="<?= $sessiondata['GENRE'] ?>">
    <br>
    <label for="time">Film Speeltijd</label>
    <input type="number" name="time"
           id="time" required
           placeholder="<?= $sessiondata['TIJDSDUUR'] ?>">
    <?php
    endforeach;
    ?>
    <button type="submit" name="submit">Save</button>
</form>
</body>
</html>