<?php
include_once("class/RedirectHandler.php");

class MovieDatabase
{
    private $db;

    public function __construct()
    {
        include_once('DB.php');
        $this->db = new DB();
    }

    public function fetchDir()
    {
        $params = null;
        $SQL = "SELECT * FROM regisseurs;";
        $DBQuery = $this->db->Select($SQL, $params);
        $result = null;
        if (count($DBQuery) > 0)
            $result = $DBQuery;
        return $result;
    }

    public function fetchFilm()
    {
        $params = null;
        $SQL = "SELECT films.NR, films.TITEL, films.GENRE, films.JAAR, films.TIJDSDUUR, regisseurs.ACHTERNAAM, regisseurs.VOORNAAM FROM films,regisseurs WHERE films.DIRNR = regisseurs.NR ORDER BY films.TITEL ASC ;";
        $DBQuery = $this->db->Select($SQL, $params);
        $result = null;
        if (count($DBQuery) > 0)
            $result = $DBQuery;
        return $result;
    }

    public function fetchUpdate($id)
    {
        if (!empty($id)) {
            $params = array(":id" => $id);
            $SQL = "SELECT films.NR, films.TITEL, films.GENRE, films.JAAR, films.TIJDSDUUR, regisseurs.ACHTERNAAM, regisseurs.VOORNAAM
FROM films,regisseurs WHERE films.NR = :id AND films.DIRNR = regisseurs.NR;";
            $DBQuery = $this->db->Select($SQL, $params);
            $result = null;
            if (count($DBQuery) > 0)
                $_SESSION['placeholder'] = $DBQuery;
            return $_SESSION['placeholder'];
        } else {
            echo "Werk niet";
        }
    }

    public function formInsert($title, $dir, $year, $genre, $time)
    {
        if (!empty($title) && !empty($dir) && !empty($year) && !empty($genre) && !empty($time)) {
            $params = array(":title" => $title, ":dir" => $dir, ":filmyear" => $year, ":genre" => $genre, ":movietime" => $time);
            $SQL = "INSERT INTO films (NR, TITEL, DIRNR, JAAR, GENRE, TIJDSDUUR)values ((SELECT UUID()), :title, :dir, :filmyear, :genre, :movietime);";
            $DBQuery = $this->db->Insert($SQL, $params);
            echo "You Have Inserted an New Movie.";
        } else {
            echo "Werk niet";
        }
    }

    public function formUpdate($title, $dir, $year, $genre, $time, $id)
    {
        if (!empty($title) && !empty($dir) && !empty($year) && !empty($genre) && !empty($time)) {
            $params = array(":title" => $title, ":dir" => $dir, ":filmyear" => $year, ":genre" => $genre, ":movietime" => $time, ":filmid" => $id);
            $SQL = "UPDATE films SET TITEL = :title, DIRNR = :dir, JAAR = :filmyear, GENRE = :genre, TIJDSDUUR = :movietime WHERE NR = :filmid";
            $DBQuery = $this->db->Update($SQL, $params);
            echo "You Have Inserted an New Movie.";
        } else {
            echo "Werkt niet";
        }
    }


    public function formDelete($delID)
    {
        if (!empty($delID)) {
            $params = array(":filmid" => $delID);
            $SQL = "DELETE FROM films WHERE NR = :filmid;";
            $DBQuery = $this->db->Delete($SQL, $params);
            RedirectHandler::HTTP_301('index_READ.php');
            echo "Movie has been DELETED!!!";
        } else {
            RedirectHandler::HTTP_301('index_READ.php');
            echo "There is nothing to DELETE.";
        }
    }
}