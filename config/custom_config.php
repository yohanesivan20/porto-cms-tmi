<?php

if (config('app.env') =='production') {
    return [ 
        
];

} else if(config('app.env') == 'local'){
    return [
        'curl_url' => 'http://192.168.1.6/porto_cms_tmi/public/',
        'client_id' => '2',
        'client_secret' => 'zwMyStaPqOqkSjjrbvsBbz7AgXKawIifL75UXwzP',
        'path_url_log_upload' => '',
    ];
}