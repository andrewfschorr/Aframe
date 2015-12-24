<?php

return [
    ['GET', '/todo',         ['Todo']],
    ['POST', '/todo',        ['Todo', 'add_task']],
    ['DELETE', '/todo',      ['Todo', 'delete_task']],

    ['GET', '/signup',       ['Authorization', 'show_signup']],
    ['POST', '/signup',      ['Authorization', 'signup']],
    ['GET', '/login',        ['Authorization', 'show_login']],
    ['POST', '/login',       ['Authorization', 'login']],
    ['GET', '/logout',       ['Authorization', 'logout']],

    ['GET', '/profile',      ['User', 'show_profile']],

    ['GET', '/home',         ['Homepage']],
    //['GET', '/{slug}',     ['Page']],
    ['GET', '/hello/{name}', ['Test']],
];
