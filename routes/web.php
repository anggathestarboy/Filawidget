<?php

use IbrahimBougaoua\Filawidget\Services\AreaService;
use IbrahimBougaoua\Filawidget\Services\PageService;
use Illuminate\Support\Facades\Route;



Route::get('/', function(){
    $pages =  PageService::getAllPages();
    $areas =  AreaService::getAllAreas();

    return view('welcome',[
        'pages' => $pages,
        'areas' => $areas,
    ]);
});

Route::get('/homepage', function () {
    $heroArea = AreaService::getWidgetByIdentifier('hero');
 
    return view('welcome', [
        'heroArea' => $heroArea,
    ]);
});
 
