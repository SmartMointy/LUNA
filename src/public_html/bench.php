<?php

    function testOne()
    {
        $start = hrtime (true);

        $a = [];
    
        for ($i = 0; $i < 10000; $i++) {
            array_push($a, ($i * $i));
            $b = implode(', ', $a);
        }
    
        $end = hrtime(true);
        
        return number_format(($end - $start) / 1000000000, 2);
    }

    function testTwo()
    {
        $start = hrtime (true);
    
        for ($i = 0; $i < 1000000; $i++) {
            echo '                                          ';
        }
    
        $end = hrtime(true);
        
        return number_format(($end - $start) / 1000000000, 2);
    }

    $firstTestTime = 0;

    for ($i = 0; $i < 5; $i++) {
        $firstTestTime = $firstTestTime + testOne();
    }

    $firstTestTime = $firstTestTime / 5;

    $secondTestTime = 0;

    for ($i = 0; $i < 5; $i++) {
        $secondTestTime = $secondTestTime + testTwo();
    }

    $secondTestTime = $secondTestTime / 5;


?>
    <h2>Results:</h2>
    <h3>1. Test</h3>
    <p><?= $firstTestTime ?> Seconds</p>
    <h3>2. Test</h3>
    <p><?= $secondTestTime ?> Seconds</p>