<?php
session_start();
$_SESSION['placeholder'] = 'Film placeholder';
include_once "Class/MovieDatabase.php";
$data = array();
$fetch = new MovieDatabase();
$data = $fetch->fetchDir();
if (isset($_POST['submit'])) {
$sent = new MovieDatabase();
$sent->formInsert($_POST['movie'],$_POST['director'],$_POST['year'],$_POST['genre'],$_POST['time']);
}
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
        <a class="nav-link active" href="CREATE.php">CREATE MovieDatabase</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="UPDATE.php">UPDATE MovieDatabase</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="DELETE.php">DELETE MovieDatabase</a>
    </li>
</ul>
    <form method='POST'>
        <h2>CREATE</h2>
        <label for="movie">Film Titel</label>
        <input type="text" name="movie"
               id="movie" required
               placeholder="<?= $_SESSION['placeholder'] ?>">
        <br>
        <label for="director">Film Regisseur</label>
        <select name='director'>
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
                   placeholder="<?= $_SESSION['placeholder'] ?>">
            <br>
            <label for="genre">Film Genre</label>
            <input type="text" name="genre"
                   id="genre" required
                   placeholder="<?= $_SESSION['placeholder'] ?>">
            <br>
            <label for="time">Film Speeltijd</label>
            <input type="number" name="time"
                   id="time" required
                   placeholder="<?= $_SESSION['placeholder'] ?>">
        <button type="submit" name="submit">Save</button>
    </form>
</body>
</html>