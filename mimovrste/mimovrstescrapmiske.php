<?php
        include('simplehtmldom/simple_html_dom.php');
        

        function scrap ($path){
            $html = file_get_html($path);    
            if (!$html){ 
                echo "prazen file";

            } else {


                foreach($html->find('article.lst-item') as $izdelek){
                               //naslov,cena,img,opis,link        

                    $ime = $izdelek->find('h3.lst-product-item-title',0)->find('a',0);

                    $cena = $izdelek->find('span.lst-product-item-price-value',0);

                    $url = $izdelek->find('h3.lst-product-item-title',0)->find('a',0);
                    $orgLink = "https://www.mimovrste.com";
                    $link = $orgLink .  $url->getAttribute("href");     
                    

                    $img = $izdelek->find('img',0);

                   

                    $urlIzdelka = $orgLink . $url;
                    echo "Title : " . $ime->plaintext . "</br>";

                    echo "Cena : " . $cena->plaintext . "</br>";                           
                    echo "link : " . $orgLink . $url->getAttribute("href") . "</br>";
                    echo "img : " . $img->getAttribute("src") . "</br>";
                    $htmlIzdelka = file_get_html($link);
                    if ($htmlIzdelka){
                        $opis = $htmlIzdelka->find('section.pro-column',1)->find('p',1);
                        echo "opis : " . $opis->plaintext . "</br>";
                    } 



                }
           }
        
        }
		
		
		
		scrap ('mimovrste/mmiske1.txt');
		scrap ('mimovrste/mmiske2.txt');
		scrap ('mimovrste/mmiske3.txt');
		scrap ('mimovrste/mmiske4.txt');
		scrap ('mimovrste/mmiske5.txt');
		scrap ('mimovrste/mmiske6.txt');
		scrap ('mimovrste/mmiske7.txt');
		scrap ('mimovrste/mmiske8.txt');
		scrap ('mimovrste/mmiske9.txt');
        


?>