<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $url = $_POST['link'];
        function getVideoID($url)
        {
            $queryString = parse_url($url,PHP_URL_QUERY);
            parse_str($queryString,$item);
            if(isset($item['v']) && strlen($item['v']) > 0)
            {
                return $item['v'];
            }
            else{
                return "";
            }
        }
        $apiKey = "AIzaSyDCUpKzoELms_nUDtLlFzCV8MZBLCeYp14";
        $apiURL = "https://www.googleapis.com/youtube/v3/videos?id=" . getVideoID($url) ."&key=" . $apiKey . "&part=snippet,contentDetails,statistics,status";
        $data   = json_decode(file_get_contents($apiURL));
        echo $data->items[0]->snippet->title."</br>";
        $countViews =number_format($data->items[0]->statistics->viewCount);
        echo $countViews;
        $thumbLink = "https://i.ytimg.com/vi/" . getVideoID($url) . "/maxresdefault.jpg";
        echo '<img src="' . $thumbLink. '">';

            
        }
    else{
    ?>
        <!DOCTYPE html>
            <html>
                <head>
                    <title>Wikipedia Scrapping </title>
                    <meta charset="UTF-8">
                </head>
                <body>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <input type="text" name="link">
                        <input type="submit" name="submit" value="get data">
                    </form>
                </body>
            </html>
    <?php
    }
    ?>
    
    

