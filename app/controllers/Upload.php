<?php

class Upload
{
    public $movieModel;
    protected static $tableStructure = Array('Title' => '', 'Year' => '', 'Format' =>'', 'Actors' =>'');

    public function __construct()
    {
       require_once(ROOT . '/models/Movie.php');
       $this->movieModel = new Movie();
    }

    public function actionGetFile()
    {
        if (isset($_POST['import']))
            if (isset($_FILES['movie']['size']) && $this->getFileContent()) {
               echo "Success </br>";
                header('Refresh: 2, url=../');
            } else {
                echo "The file isn't correct";
        } else {
            require_once(ROOT . '/views/upload_page.php');
        }
    }

    public function actionAddMovie()
    {
        if (isset($_POST['Title'])) {
            if ($movie = $this->movieValid($_POST)
                AND $this->movieModel->saveMovie($movie)) {
                echo "Movie was added to base";
                header('Refresh: 2, url=../');
            } else {
                echo "Input isn't correct";
            }
        } else {
            require_once(ROOT . '/views/add_movie.php');
        }
    }

    protected function getFileContent()
    {
        $res = 0;
        $mimes = array('text/plain');
        $type = in_array($_FILES['movie']['type'], $mimes);
        $fileContent = trim(file_get_contents($_FILES['movie']['tmp_name']));

        if ($fileContent && $type) {
            $movies = preg_split('/\n{2}|\r\n{2}|\r{2}/', $fileContent);
            foreach ($movies as $movie) {
                if (!$this->decodeMovieFile($movie, $res))
                    return false;
            }
            if ($res > 0) {
                echo "$res movies was uploaded to database </br>";
                if ($res == count($movies)) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        echo "wrong file was uploaded </br>";
        return false;
    }

    protected function decodeMovieFile($movie, &$res)
    {
        $movie = preg_split('/\n|\r\n|\r/', $movie);
        foreach ($movie as $pair) {
            list ($k,$v) = explode (': ', $pair);
            if ($k == 'Stars') {
                $k = 'Actors';
            }
            if ($k == 'Release Year') {
                $k = 'Year';
            }
            $movie[$k] = $v;
        }
        array_splice($movie, 0, 4);
        if ($movie = $this->movieValid($movie)) {
            $res += $this->movieModel->saveMovie($movie);
        } else {
            echo "wrong file structure, procession stopped </br>";
            return false;
        }
        return true;
    }

    protected function movieValid($movie)
    {
        if (!array_diff_key($movie, self::$tableStructure)) {
            $valid = true;
            foreach($movie as $key => $val) {
                $method = lcfirst($key). 'Valid';
                $valid = ($this->$method($val) and $valid);
            }
            if ($valid) {
                return $movie;
            }
        }
        return false;
    }

    protected function titleValid($title)
    {
        $doubles = $this->movieModel->checkDoubles($title);
        if (!empty($title) && strlen($title) < 200 && $doubles == 0) {
            return true;
        }
        return false;
    }

    protected function yearValid(&$year)
    {
        if (is_numeric($year)) {
            $year = intval($year);
            if ($year <= intval(date("Y") + 1) && $year > 1832) {
                return true;
            }
        }
        return false;
    }

    protected function formatValid($format)
    {
        if ($format == 'VHS' || $format == 'DVD' || $format == 'Blu-Ray') {
            return true;
        }
        return false;
    }

    protected function actorsValid($actors)
    {
        if (!empty($actors) && strlen($actors) < 2000) {
            return true;
        }
        return false;
    }
}