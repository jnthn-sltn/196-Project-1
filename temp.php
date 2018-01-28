<?php
    $conn = new MongoClient("mongodb://admin:admin@ds217898.mlab.com:17898/ambilampdb"); // paste your db URL
    $db = $conn->ambilampdb;
    $collection = $db->temp; // paste collection name
    $newData = array('num' => 131, 'val' => 57, 'time' => '8pm');
    $collection->insert($newData);

    $cursor = $collection->find();
    echo "First loop: <br>";
    foreach ($cursor as $doc) {
        echo $doc['num'] . "<br>";
    }

    echo "<br>";
    $cursor = $collection->find(array('num' => 131));
    echo "Second loop: <br>";
    foreach ($cursor as $doc) {
        echo $doc['num'] . "<br>";
    }
?>
