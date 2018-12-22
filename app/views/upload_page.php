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
<div class="container" id="main-content">
    <form action="/upload" method="post" enctype="multipart/form-data" class="file has-name is-fullwidth">
        <label class="file-label">
            <input class="file-input" type="file" name="movie">
            <span class="file-cta">
                <span class="file-icon">
                    <i class="fas fa-upload"></i>
                </span>
                <span class="file-label">Choose a file…</span>
            </span>
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <input type="submit" name="import" value="Import Data" class="button is-link">
        </label>
    </form>
</div>
</body>
</html>
