<?php

NI_route::get('/', function () {
    echo Inflect::singularize("users");
    NI_view::V_html('welcome');
});