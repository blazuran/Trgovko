<?php
include('simple_html_dom.php');
include "db.php";
/* 
 * KATEGORIJA: prenosniki
 */

$query = mysqli_query($conn, "SELECT ID, StoreURL FROM Stores WHERE StoreURL = 'https://www.mlacom.si'");
    $store_id = 0;
        if(mysqli_num_rows($query) == 0)
        {
            $query1 = mysqli_query($conn, "INSERT into Stores(Name, StoreURL) VALUES('mlacom', 'https://www.mlacom.si')");
            $query = mysqli_query($conn, "SELECT ID, StoreURL FROM Stores WHERE StoreURL = 'https://www.mlacom.si'");
            $row = mysqli_fetch_assoc($query);
            $store_id = $row['ID'];
        }
        else 
        {
            $row = mysqli_fetch_assoc($query);
            $store_id = $row['ID'];
        }

for ($i = 1; $i < 40; $i++) {

    $html = file_get_html('https://www.mlacom.si/prenosniki-in-oprema/prenosniki?p=' . $i);
    $velHtml = str_word_count($html, 0);

    if ($i == 1) { //pride skoz vse podstrani
        $vel = $velHtml;
    } else {
        if ($vel == $velHtml) {
            break;
        }
    }

    foreach ($html->find('div.box') as $element) {
        $link = 'https://www.mlacom.si/';
        $item[] = $element->find('h2 a', 0)->plaintext; //title
        $title = $element->find('h2 a', 0)->plaintext;
        $item[] = $element->find('p', 0)->plaintext; //description 
        $description = $element->find('p', 0)->plaintext;
        $price = $element->find('div.additional div', 0)->plaintext; //price

        $price = str_replace("Spletna cena:", "", $price);
        $price = str_replace("€", "", $price);
        $price = str_replace(".", "", $price);
        $price = str_replace(",", ".", $price);
        echo $price;
        $linkDesc = $element->find('a', 0)->href; //url
        $linkInsert = $link . $linkDesc; //url

        $image = $element->find('center img', 0)->src; //picture
        $image1 = str_replace("crop2/", "", $image);
        $img = $link . $image1;
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $price, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Prenosniki'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
        
    }
}
//
//print_r($item);

/* 
 * KATEGORIJA: monitorji
 */

for ($i = 1; $i < 40; $i++) {

    $html = file_get_html('https://www.mlacom.si/monitorji?p=' . $i);
    $velHtml = str_word_count($html, 0);

    if ($i == 1) { //pride skoz vse podstrani
        $vel = $velHtml;
    } else {
        if ($vel == $velHtml) {
            break;
        }
    }

    foreach ($html->find('div.box') as $element) {
        $link = 'https://www.mlacom.si/';
        $item[] = $element->find('h2 a', 0)->plaintext; //title
        $title = $element->find('h2 a', 0)->plaintext;
        $item[] = $element->find('p', 0)->plaintext; //description 
        $description = $element->find('p', 0)->plaintext;
        $price = $element->find('div.additional div', 0)->plaintext; //price

        $price = str_replace("Spletna cena:", "", $price);
        $price = str_replace("€", "", $price);
        $price = str_replace(".", "", $price);
        $price = str_replace(",", ".", $price);
        echo $price;
        $linkDesc = $element->find('a', 0)->href; //url
        $linkInsert = $link . $linkDesc; //url

        $image = $element->find('center img', 0)->src; //picture
        $image1 = str_replace("crop2/", "", $image);
        $img = $link . $image1;
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $price, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Monitor'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
    }
}

/* 
 * KATEGORIJA: tipkovnice
 */

for ($i = 1; $i < 40; $i++) {

    $html = file_get_html('https://www.mlacom.si/racunalniska-oprema/tipkovnice?p=' . $i);
    $velHtml = str_word_count($html, 0);

    if ($i == 1) { //pride skoz vse podstrani
        $vel = $velHtml;
    } else {
        if ($vel == $velHtml) {
            break;
        }
    }

    foreach ($html->find('div.box') as $element) {
        $link = 'https://www.mlacom.si/';
        $item[] = $element->find('h2 a', 0)->plaintext; //title
        $title = $element->find('h2 a', 0)->plaintext;
        $item[] = $element->find('p', 0)->plaintext; //description 
        $description = $element->find('p', 0)->plaintext;
        $price = $element->find('div.additional div', 0)->plaintext; //price

        $price = str_replace("Spletna cena:", "", $price);
        $price = str_replace("€", "", $price);
        $price = str_replace(".", "", $price);
        $price = str_replace(",", ".", $price);
        echo $price;
        $linkDesc = $element->find('a', 0)->href; //url
        $linkInsert = $link . $linkDesc; //url

        $image = $element->find('center img', 0)->src; //picture
        $image1 = str_replace("crop2/", "", $image);
        $img = $link . $image1;
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $price, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Tipkovnice'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
    }
}

//print_r($item);

/* 
 * KATEGORIJA: miške in podlage
 */

for ($i = 1; $i < 40; $i++) {

    $html = file_get_html('https://www.mlacom.si/racunalniska-oprema/miske-in-podloge?p=' . $i);
    $velHtml = str_word_count($html, 0);

    if ($i == 1) { //pride skoz vse podstrani
        $vel = $velHtml;
    } else {
        if ($vel == $velHtml) {
            break;
        }
    }

    foreach ($html->find('div.box') as $element) {
        $link = 'https://www.mlacom.si/';
        $item[] = $element->find('h2 a', 0)->plaintext; //title
        $title = $element->find('h2 a', 0)->plaintext;
        $item[] = $element->find('p', 0)->plaintext; //description 
        $description = $element->find('p', 0)->plaintext;
        $price = $element->find('div.additional div', 0)->plaintext; //price

        $price = str_replace("Spletna cena:", "", $price);
        $price = str_replace("€", "", $price);
        $price = str_replace(".", "", $price);
        $price = str_replace(",", ".", $price);
        echo $price;
        $linkDesc = $element->find('a', 0)->href; //url
        $linkInsert = $link . $linkDesc; //url

        $image = $element->find('center img', 0)->src; //picture
        $image1 = str_replace("crop2/", "", $image);
        $img = $link . $image1;
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $price, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Miske'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
    }
}


/* 
 * KATEGORIJA: grafične kartice
 */

for ($i = 1; $i < 40; $i++) {

    $html = file_get_html('https://www.mlacom.si/racunalniska-oprema/graficne-kartice-pcie?p=' . $i);
    $velHtml = str_word_count($html, 0);

    if ($i == 1) { //pride skoz vse podstrani
        $vel = $velHtml;
    } else {
        if ($vel == $velHtml) {
            break;
        }
    }

    foreach ($html->find('div.box') as $element) {
        $link = 'https://www.mlacom.si/';
        $item[] = $element->find('h2 a', 0)->plaintext; //title
        $title = $element->find('h2 a', 0)->plaintext;
        $item[] = $element->find('p', 0)->plaintext; //description 
        $description = $element->find('p', 0)->plaintext;
        $price = $element->find('div.additional div', 0)->plaintext; //price

        $price = str_replace("Spletna cena:", "", $price);
        $price = str_replace("€", "", $price);
        $price = str_replace(".", "", $price);
        $price = str_replace(",", ".", $price);
        echo $price;
        $linkDesc = $element->find('a', 0)->href; //url
        $linkInsert = $link . $linkDesc; //url

        $image = $element->find('center img', 0)->src; //picture
        $image1 = str_replace("crop2/", "", $image);
        $img = $link . $image1;
        
        $date = date("Y-m-d H:i:s");
        $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $price, '$date', '$description', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Komponente'))");
        $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");
    }
}

//print_r($item);

?>
