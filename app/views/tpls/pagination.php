<div class="level" aria-placeholder="Elements on page">
    <div class="select">
        <select id="page_elems">
            <option><?php echo $this->pageSize ?></option>
            <?php if ($this->pageSize == 10): ?>
                <option>20</option>
                <option>50</option>
            <?php elseif ($this->pageSize == 20): ?>
                <option>10</option>
                <option>50</option>
            <?php else :?>
                <option>10</option>
                <option>20</option>
            <?php endif; ?>
        </select>
    </div>
</div>
<?php
        $html = '<li><a class="pagination-link" href= /?page=%s&page_elems='. $this->pageSize;
        if (!empty($searchCond)) {
            $html .= '&search_cond='. $searchCond['condition'] . '&search_val=%' . $searchCond['query'] .'%';
        }
        $html .= '>%s</a></li>';
?>
<?php if ($this->totalPages > 1) :?>
<div class="level">
<nav class="pagination" role="navigation" aria-label="pagination">
    <ul class="pagination-list">
        <?php
        list($pervpage, $page2left, $page1left, $page1right, $page2right, $nextpage) = '';

        if ($this->page != 1)
            $pervpage = sprintf($html, '1','<<') . sprintf($html, $this->page - 1,'Previous');
        if ($this->page != $this->totalPages)
            $nextpage = sprintf($html, $this->page + 1,'Next') . sprintf($html, $this->totalPages,'>>');
        if ($this->page - 2 > 0)
            $page2left = sprintf($html, $this->page - 2, $this->page - 2);
        if ($this->page - 1 > 0)
            $page1left = sprintf($html, $this->page - 1, $this->page - 1);
        if ($this->page + 2 <= $this->totalPages)
            $page2right = sprintf($html, $this->page + 2, $this->page + 2);
        if ($this->page + 1 <= $this->totalPages)
            $page1right = sprintf($html, $this->page + 1, $this->page + 1);

        echo $pervpage.$page2left.$page1left.'<li><b class="pagination-link is-current">'.$this->page.'</b></li>'.$page1right.$page2right.$nextpage;
        ?>
    </ul>
</nav>
</div>
<?php else: ?>
    <?php
    $a = 'style="display: none"';
    $html = substr($html, 4, 3) . $a . substr($html, 6, strlen($html) - 11);
    echo sprintf($html, '1','');
    ?>
<?php endif; ?>