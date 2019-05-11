<?php
include_once("class/MovieDatabase.php");
$result = array();
$data = new MovieDatabase();
$result = $data->fetchFilm();
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">
</head>
<body>
<ul class="nav nav-pills nav-fill rounded-0">
    <li class="nav-item">
        <a class="nav-link active" href="index_READ.php">READ MovieDatabase</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="CREATE.php">CREATE MovieDatabase</a>
    </li>
        <li class="nav-item disabled">
            <a class="nav-link" href="UPDATE.php">UPDATE MovieDatabase</a>
        </li>
        <li class="nav-item disabled">
            <a class="nav-link" href="DELETE.php">DELETE MovieDatabase</a>
        </li>
    <div class='col-md-12'>
        <form method="get">
        <table class='table'>
            <thead class='thead-dark'>
            <tr>
                <th scope='col'>TITEL</th>
                <th scope='col'>REGISSEUR NAAM</th>
                <th scope='col'>JAAR</th>
                <th scope='col'>GENRE</th>
                <th scope='col'>TIJDSDUUR</th>
                <th scope='col'>UPDATE</th>
                <th scope='col'>DELETE</th>
            </tr>
            <tbody>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?= $row['TITEL'] ?></td>
                    <td><?= $row['ACHTERNAAM'] . '&nbsp;' . $row['VOORNAAM'] ?></td>
                    <td><?= $row['JAAR'] ?></td>
                    <td><?= $row['GENRE'] ?></td>
                    <td><?= $row['TIJDSDUUR'] ?></td>
                    <td><a href="UPDATE.php?NR=<?= $row['NR'] ?>">
                           UPDATE
                        </a></td>
                    <td><a href="DELETE.php?NR=<?= $row['NR'] ?>">
                            DELETE
                        </a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        </form>
    </div>
</body>
</html>