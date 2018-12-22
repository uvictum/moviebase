<?php
    if (!empty($this->movies)) {
        require_once(ROOT . '/views/tpls/table.tpl.php');
    } else {
        echo '<h4 class="heading title is-4">Sorry, No movies found in database</h4>';
    }
    require_once (ROOT. '/views/tpls/pagination.php');