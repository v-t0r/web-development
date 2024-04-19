<?php
    $n = intval($_GET["qdeParagrafos"]);

    echo "<h1>Parágrafos gerados</h1>";

    for($i = 0; $i < $n; $i++){
        echo "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod numquam ut, libero at et, ullam voluptas debitis soluta repellat excepturi ipsum dignissimos culpa tempora cum enim molestiae magni incidunt aliquid?</p>";
    }

?>
