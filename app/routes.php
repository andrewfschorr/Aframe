<?php

return [

    ['GET', '/',                ['Authorization']],
    ['GET', '/groups',          ['Group']],
    ['POST', '/group',          ['Group', 'add_group']],
    ['GET', '/group/{group}',   ['Group', 'display_group']],
    ['DELETE', '/group',        ['Group', 'delete_group']],

    ['POST', '/image',          ['Image', 'add_image']],
    ['DELETE', '/image',        ['Image', 'delete_image']],


    ['GET', '/api/todo',        ['Api', 'todos']],

    ['GET', '/signup',          ['Authorization', 'show_signup']],
    ['POST', '/signup',         ['Authorization', 'signup']],
    ['GET', '/login',           ['Authorization', 'show_login']],
    ['POST', '/login',          ['Authorization', 'login']],
    ['GET', '/logout',          ['Authorization', 'logout']],

    ['GET', '/home',            ['Homepage']],

    //['GET', '/{slug}',          ['Static_page']],
];
