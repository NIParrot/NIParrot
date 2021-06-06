<?php

use Models\Eloquent\Town;

NI_route::get('/', function () {

    $pla = new Town;
    var_dump($pla->get());
    NI_view::V_html('welcome');
});
