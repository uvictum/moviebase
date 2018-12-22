<?php
class Home
{
    public static $_DEFAULT_PAGE_LIMIT = 10;
    public $movieModel;
    public $page = 1;
    public $pageSize = 10;
    public $movies;
    public $totalPages;

    public function __construct()
    {
        require_once(ROOT . '/models/Movie.php');
        $this->movieModel = new Movie();
        if (isset($_GET['page_elems']) && $this->pageSizeValid($_GET['page_elems'])) {
            $this->movieModel->limit = intval($_GET['page_elems']);
            $this->pageSize = $this->movieModel->limit;
        }
        $this->totalPages = ceil($this->movieModel->moviesTotal / $this->movieModel->limit);
        if (isset($_GET['page']) && $this->pageValid($_GET['page'])) {
            $this->page = intval($_GET['page']);
        }
        $this->movieModel->setPage($this->page);
    }

    public function actionDisplay()
    {
        $this->movies = $this->movieModel->showMovies(null);
        require_once(ROOT . '/views/homepage.php');
    }

    public function actionDisplayContent()
    {
        if (isset($_GET['search_cond']) && isset($_GET['search_val'])) {
            $searchCond['query'] = htmlentities($_GET['search_val']);
            $searchCond['condition'] = $_GET['search_cond'];
            $this->movies = $this->movieModel->showMovies($searchCond);
            $this->totalPages = ceil($this->movieModel->getMovieCount($searchCond) / $this->pageSize);
        } else {
            $this->movies = $this->movieModel->showMovies(null);
        }
        require_once(ROOT . '/views/tpls/many_movies.tpl.php');
    }

    private function pageValid($page)
    {
        if (is_numeric($page)) {
            $page = intval($page);
            if ($page > 0 && $page <= $this->totalPages) {
                return true;
            }
        }
        return false;
    }

    public function actionSearch()
    {
        $searchCond = $this->validateSearch();
        if ($searchCond) {
            $this->movies = $this->movieModel->showMovies($searchCond);
            $this->totalPages = ceil($this->movieModel->getMovieCount($searchCond) / $this->pageSize);
            require_once(ROOT . '/views/homepage.php');
        } else {
            $this->actionDisplay();
            echo '<div class="container"><h6>wrong query</h6></div>';
        }
    }

    public function validateSearch()
    {
        if (($_GET['search_cond'] == 'By actors' || $_GET['search_cond'] == 'By title')) {
            $searchCond['condition'] = ucfirst(substr($_GET['search_cond'], 3));
            if (is_string($_GET['search_val']) && strlen($_GET['search_val']) < 2000) {
                $searchCond['query'] = "%" . htmlentities($_GET['search_val']) . "%";
            } else {
                return null;
            }
            return $searchCond;
        }
        return null;
    }

    private function pageSizeValid($pageSize)
    {
        if (is_numeric($pageSize)) {
            $pageSize = intval($pageSize);
            if ($pageSize == 10 || $pageSize == 20 || $pageSize == 50) {
                return true;
            }
        }
        return false;
    }
}