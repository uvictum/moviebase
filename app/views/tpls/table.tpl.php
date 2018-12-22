<table class="table is-bordered is-striped">
    <thead>
    <tr>
        <th>Title</th>
        <th>Format</th>
    </tr>
    </thead>
    <tbody>
        <?php
            foreach($this->movies as $movie) {
                echo '<tr>';
                echo '<td><a href="/movies/'.$movie['ID'].'">'.$movie['Title'].'</a></td>';
                echo '<td>'. $movie['Format'].'</td>';
                echo  '</tr>';
            }
            ?>
    </tbody>
</table>