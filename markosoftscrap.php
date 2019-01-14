<?php
         include('simple_html_dom.php');
         include "db.php";
         
         $query = mysqli_query($conn, "SELECT ID, StoreURL FROM Stores WHERE StoreURL = 'https://www.markoshop.si'");
         $store_id = 0;
        if(mysqli_num_rows($query) == 0)
        {
            $query1 = mysqli_query($conn, "INSERT into Stores(Name, StoreURL) VALUES('markoshop.si', 'https://www.markoshop.si')");
            $query = mysqli_query($conn, "SELECT ID, StoreURL FROM Stores WHERE StoreURL = 'https://www.markoshop.si'");
            $row = mysqli_fetch_assoc($query);
            $store_id = $row['ID'];
        }
        else 
        {
            $row = mysqli_fetch_assoc($query);
            $store_id = $row['ID'];
        }
        
            function scrap($pageNumStrTemp , $orgLinkTemp, $contextTemp, $fileNameTemp, $conn, $store_id){

                for ($pageNum = 1; $pageNum < 1000 ; $pageNum++){ //gre skoz vse strani
                    $html = file_get_html($orgLinkTemp . $pageNumStrTemp . $pageNum, false, $contextTemp); 
                    if (!$html){ //če prejšnja funkcija vrne prazen html se zanka zaključi, kar pomeni, da ni več naslednjih strani.
                        break; 
                    } else {

                        foreach($html->find('div.product-container') as $izdelek){
                            //naslov,cena,img,opis,link
                            $ime = $izdelek->find('a.product-name',0);

                            $cena = $izdelek->find('div.content_price',0)->find('span',0);
                            $cena = $cena -> plaintext;
                            $cena = str_replace("€", "", $cena);
                            $cena = str_replace(",", ".", $cena);
                            $img = $izdelek->find('a.product_img_link',0)->find('img',0);
                            $link = $izdelek->find('a.quick-view',0);
                            $urlIzdelka = $link->getAttribute("href"); //url od izdelka, ki ga trenutno obdeluje
                            $htmlIzdelka = file_get_html($urlIzdelka);
                            $opis = $htmlIzdelka->find('section.page-product-box',0)->find('p',0);


                            printOut($ime, $cena, $img, $opis  ,$link);
                            $title = $ime -> plaintext;
                            $linkInsert = $link->plaintext;
                            $opis = $opis->plaintext;
                            
                            $date = date("Y-m-d H:i:s");
                            if($fileNameTemp == "prenosniki.txt")
                            {
                              $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $cena, '$date', '$opis', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Prenosniki'))");
                              $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");                       
                            }
                            if($fileNameTemp == "telefoni.txt")
                            {
                              $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $cena, '$date', '$opis', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Multimedija'))");
                              $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");                       
                            }
                            if($fileNameTemp == "racunalniki.txt")
                            {
                              $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $cena, '$date', '$opis', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Namizni PC'))");
                              $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");                       
                            }
                            if($fileNameTemp == "tablice.txt")
                            {
                              $query = mysqli_query($conn, "INSERT INTO Products(Title, ProductURL, Price, DateTime, Description,Rating, Stores_ID, Categories_ID) VALUES('$title', '$linkInsert', $cena, '$date', '$opis', 0, $store_id, (SELECT ID FROM categories WHERE Title = 'Tablet-PC'))");
                              $query2 = mysqli_query($conn, "INSERT INTO pictures(url, Title, Products_ID) VALUES('$img', '$title', (SELECT ID FROM products WHERE ProductURL = '$linkInsert'))");                       
                            }
                            
                        }
                    }
                }

            }
            
            function insert()
            {
                
            }

            
            function printOut ($imeTemp, $cenaTemp, $imgTemp, $opisTemp , $linkTemp){
                        echo 'Title : ' . $imeTemp->plaintext . '</br>';

                        echo 'Cena : ' . $cenaTemp->plaintext . '</br>';
                        //echo 'Dobavljivost : ' . $zalogaTemp->plaintext . '</br>';
                        echo 'Img : ' . $imgTemp . '/<br>';
                        echo 'Link :' . $linkTemp->getAttribute("href") . "</br></br>";
                        echo 'Opis : ' . $opisTemp->plaintext . '</br></br></br>';
            }
        
        $context = stream_context_create(  //ne spremeni url v file_get_html
            array(
                'http' => array(
                    'follow_location' => false 
                )
            )
        );

        //prenosniki
        
        $orgLink1 = "https://www.markoshop.si/12-prenosniki?n=300";
        $pageNumStr1 = "&p=";
        
        scrap($pageNumStr1,$orgLink1,$context,"prenosniki.txt", $conn, $store_id);
        
        //telefoni
        $orgLink2 = "https://www.markoshop.si/153-telefoni";
        $pageNumStr2 = "?p=";

        scrap($pageNumStr2,$orgLink2,$context,"telefoni.txt", $conn, $store_id);
        //racunalniki
        $orgLink3 = "https://www.markoshop.si/13-racunalniki";
        $pageNumStr3 = "?p=";
        
        scrap($pageNumStr3,$orgLink3,$context,"racunalniki.txt", $conn, $store_id);
        
        //tablice
        
        $orgLink4 = "https://www.markoshop.si/23-tablice";
        $pageNumStr4 = "?p=";
        
        scrap($pageNumStr4,$orgLink4,$context, "tablice.txt", $conn, $store_id);
?>