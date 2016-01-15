<?php

return [

    ['GET', '/',                ['Authorization']],

    ['GET', '/todo',            ['Todo']],
    ['POST', '/todo',           ['Todo', 'add_task']],
    ['DELETE', '/todo',         ['Todo', 'delete_task']],

    ['POST', '/page',           ['Page', 'add_page']],
    ['DELETE', '/page',         ['Page', 'delete_page']],
    ['GET', '/page/{page}',     ['Page', 'display_page']],

    ['GET', '/api/todo',        ['Api', 'todos']],

    ['GET', '/signup',          ['Authorization', 'show_signup']],
    ['POST', '/signup',         ['Authorization', 'signup']],
    ['GET', '/login',           ['Authorization', 'show_login']],
    ['POST', '/login',          ['Authorization', 'login']],
    ['GET', '/logout',          ['Authorization', 'logout']],

    ['GET', '/home',            ['Homepage']],

    //['GET', '/{slug}',          ['Static_page']],
];
