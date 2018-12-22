<?php
/**
 * Created by PhpStorm.
 * User: Виктор
 * Date: 18.12.2018
 * Time: 23:26
 */

class MoviePage
{
    public $movieModel;
    public $movie;

    public function __construct()
    {
        require_once (ROOT. '/models/Movie.php');
        $this->movieModel = new Movie();
    }

    public function actionShow()
    {
        $params = explode('/', $_SERVER['REQUEST_URI']);
        $id = array_pop($params);
        if (is_numeric($id) && intval($id) > 0 && intval($id) <= $this->movieModel->moviesTotal) {
            $this->movie = $this->movieModel->showMovieInfo($id);
            require_once (ROOT . '/views/single_movie.php');
        } else {
            header('HTTP/1.0 404 Not Found', true, 404);
            die();
        }
    }

    public function actionDelete()
    {
        $id = array_pop(explode('/', $_SERVER['REQUEST_URI']));
        if (is_numeric($id) && intval($id) > 0 && intval($id) <= $this->movieModel->moviesTotal) {
            $message = $this->movieModel->deleteMovie($id);
            echo "film was" . $message;
        } else {
            header('HTTP/1.0 404 Not Found', true, 404);
            die();
        }
    }

}