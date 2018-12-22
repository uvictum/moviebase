<?php

class Movie
{
    public $pdo;
    public $limit = 10;
    public $offset = 0;

    public function __construct()
    {
        $this->pdo = ConnectDatabase::ConnectDB();
    }

    public function __get($name)
    {
        if ($name == 'moviesTotal') {
            return ($this->getMovieCount(null));
        }
        return null;
    }

    public function setPage($page)
    {
        if (isset($page)) {
            $this->offset = $page * $this->limit - $this->limit;
            $this->limit = "$this->offset, $this->limit";
        }
    }

    public function getMovieCount($searchCond)
    {
        if (isset($searchCond)) {
            $sql = "SELECT COUNT(*) FROM `Movies` WHERE " . $searchCond['condition'] . " LIKE :query";
            $statement = $this->pdo->prepare($sql);
            $statement->execute(array(':query' => $searchCond['query']));
        } else {
            $sql = "SELECT COUNT(*) FROM Movies";
            $statement = $this->pdo->query($sql);
        }
        return ($statement->fetchColumn());
    }

    public function showMovies($searchCond)
    {
        if (isset($searchCond)) {
            $sql = "SELECT `ID`, `Title`, `Format` FROM `Movies` WHERE ".$searchCond['condition']." LIKE :query LIMIT ";
            $sql .= $this->limit;
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':query', $searchCond['query']);
            $statement->execute();
        } else {
            $sql = "SELECT ID, Title, Format FROM Movies ORDER BY Title ASC LIMIT ". $this->limit;
            $statement = $this->pdo->query($sql, PDO::FETCH_ASSOC);
        }
        return($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    public function showMovieInfo($id)
    {
        $sql = "SELECT * FROM Movies WHERE ID = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return ($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function saveMovie($params)
    {
        $sql = "INSERT INTO Movies (Title, Year, Format, Actors) VALUES(:Title, :Year, :Format, :Actors)";
        $statement = $this->pdo->prepare($sql);
        try {
            $statement->execute($params);
        } catch(PDOException $error) {
            echo "error " . $error->getMessage();
            return (0);
        }
        return (1);
    }

    public function deleteMovie($id)
    {
        $sql = 'DELETE FROM Movies WHERE ID = :id';
        $statement = $this->pdo->prepare($sql);
        try {
            $statement->execute([':id' => $id]);
        } catch(PDOException $error) {
            return ("not removed " . $error->getMessage());
        }
        return ("successfully removed");
    }

    public function importMovies($tableDest)
    {
        $tableDest = addcslashes($tableDest, '\\');
        $sql = '
        LOAD DATA LOCAL INFILE "'.$tableDest.'"
            INTO TABLE Users  
            FIELDS TERMINATED by \',\' ENCLOSED BY \'"\'
            LINES TERMINATED BY \'\n\'
            IGNORE 1 LINES
            ;';
        try {
            $res = $this->pdo->query($sql);
        } catch(PDOException $error) {
            return ("not uploaded" . $error->getMessage());
        }
        if ($res) {
            return ("successfully uploaded");
        }
        return ("not uploaded");
    }

    public function checkDoubles($title)
    {
        $sql = 'SELECT COUNT(Title) FROM Movies WHERE Title = :Title';
        $statement = $this->pdo->prepare($sql);
        try {
            $statement->execute([':Title' => $title]);
        } catch(PDOException $error) {
            return (" error " . $error->getMessage());
        }
        return ($statement->fetchColumn());
    }
}