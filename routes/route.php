<?php
NI_route::get('/', function () {
    NI_view::V_html('welcome');
});

NI_route::get('/ss', 'ss@vv');
