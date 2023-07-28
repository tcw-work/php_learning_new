<?php
$isbn = "0439708184"; // ここに取得したい本のISBNコードを入れてください
$api_url = "https://api.calil.jp/check?appkey=YOUR_APP_KEY&isbn=".$isbn."&format=json&callback=no";

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $api_url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$response = curl_exec($ch); 
curl_close($ch); 

$book_info = json_decode($response, true);

foreach($book_info['books'] as $book) {
    echo "Book Title: " . $book['title'] . "<br>";
    echo "ISBN: " . $book['isbn'] . "<br>";
    echo "Libraries: <br>";
    foreach($book['libraries'] as $library) {
        echo "Library Name: " . $library['formal'] . "<br>";
        echo "Status: " . $library['status'] . "<br><br>";
    }
}
?>