<?php
    // Just printing the headline and username if passed in
    echo "<h2>" . $data['headline'] . "</h2>";

    if ($data['username']) {
        echo 'Your name is: ' . $data['username'];
    } else {
        echo "You didn't typed in a name like localhost/home/yourname";
    }
