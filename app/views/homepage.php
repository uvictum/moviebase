<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users overview</title>
    <link rel="stylesheet" href="/css/bulma.min.css">
    <style>
        #main-content > table{
            margin: 0 auto;
        }
        .level {
            margin-top: 1.5rem;
        }
        .level > * {
            margin: 0 auto;
        }
    </style>
</head>
<body class="has-navbar-fixed-top">
<div id="navigate" class="navbar is-fixed-top has-shadow">
    <div class="navbar-menu">
        <div class="navbar-start"></div>
        <a class="navbar-item" href="/">Home</a>
        <a class="navbar-item" href="/upload">Import data</a>
        <a class="navbar-item" href="/add">Add movie</a>
        <div class="navbar-item">
            <form action="/search" class="field has-addons" method="get">
                <p class="control">
                    <span class="select">
                        <select name="search_cond">
                            <option>By actors</option>
                            <option>By title</option>
                        </select>
                    </span>
                </p>
                <p class="control">
                    <input class="input" type="search" placeholder="Search..." name="search_val">
                </p>
                <p class="control">
                    <input class="button" type="submit" value="Search">
                </p>
            </form>
        </div>
        <div class="navbar-end"></div>
    </div>
</div>
<div  id="main-content" class="container">
    <?php require_once(ROOT. '/views/tpls/many_movies.tpl.php'); ?>
</div>
</body>
<script src="/js/pagination_elems.js"></script>
</html>
