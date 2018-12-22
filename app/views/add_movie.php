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
    <form action="/add" enctype="multipart/form-data" method="post" class="form-task">
        <div class="field">
            <label class="label" for="titleMovie">Title</label>
            <div class="control">
                <input class="input" type="text" id="titleMovie" name="Title" placeholder="Movie name">
            </div>
        </div>
        <div class="field">
            <label class="label" for="yearMovie">Release year</label>
            <div class="control">
                <input class="input" name="Year" id="yearMovie" type="text" placeholder="Year">
            </div>
        </div>
        <div class="field">
            <label class="label" for="formatMovie">Format</label>
                <div class="control">
                    <div class="select">
                        <select name="Format" id="formatMovie">
                            <option>DVD</option>
                            <option>VHS</option>
                            <option>Blu-Ray</option>
                        </select>
                    </div>
                </div>
        </div>
        <div class="field">
            <label class="label" for="actorsMovie">Actors</label>
            <div class="control">
                <textarea class="textarea" id="actorsMovie" name="Actors" placeholder="Actors"></textarea>
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <input type="submit" value="Submit" class="button is-link">
            </div>
            <div class="control">
                <button class="button is-text">Cancel</button>
            </div>
        </div>
</form>
</body>
</html>