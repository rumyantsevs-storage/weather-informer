<?php
    $doc = new DOMDocument();
    $doc->loadHTML('https://www.gismeteo.ru/weather-yaroslavl-4313/now/');
    
    // Если не работает загрузка с сайта в Интернете, применять данные
    // оффлайн, откомментировав строку ниже
    //@$doc->loadHTMLFile('saved.html');
    
    /**
     * Определение и поиск значений элементов метеосервиса
     */
    
    $finder = new DomXPath($doc);
    
    // Элемент с показанием температуры
    $tempClassName = 'nowvalue__text_l';
    $tempOut = $finder->query("//*[contains(@class, '$tempClassName')]")[0]->nodeValue;
    $tempOut = trim($tempOut);
    
    // Показания ощущаемой температуры
    $feelClassName = 'now__feel';
    $feelOut = $finder->query("//*[contains(@class, '$feelClassName')]")[0]->nodeValue;
    $feelOut = rtrim($feelOut);
    $feelOut = substr($feelOut, -10);
    $feelOut = ltrim($feelOut);
    
    // Пояснение погодного состояния
    $descClassName = 'now__desc';
    $descOut = $finder->query("//*[contains(@class, '$descClassName')]")[0]->nodeValue;
    $descOut = trim($descOut);
    
    // Текущие дата и время
    $dateClassName = 'js_datestamp now__time_date';
    $timeClassName = 'js_timestamp';
    $temp = $finder->query("//*[contains(@class, '$dateClassName')]")[0]->nodeValue;
    $datetimeOut = $temp . ', ';
    $temp = $finder->query("//*[contains(@class, '$timeClassName')]")[0]->nodeValue;
    $datetimeOut .= $temp;
    $datetimeOut = trim($datetimeOut);
?>
