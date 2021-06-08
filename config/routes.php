<?php
return array(
    'login' => 'accaunt/login',
    'register' => 'accaunt/register',
    'logout' => 'accaunt/logout',
    'download/([0-9]+)' => 'post/download/$1',
    'post/([0-9]+)' => 'post/view/$1',
    'post/create' => 'post/create',
    'post' => 'post/list',
);