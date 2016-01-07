<?php

return [
    // ['GET', '/',             ['User', 'show_profile']],
    ['GET', '/',             ['Authorization']],

    ['GET', '/todo',         ['Todo']],
    ['POST', '/todo',        ['Todo', 'add_task']],
    ['DELETE', '/todo',      ['Todo', 'delete_task']],

    ['GET', '/api/todo',      ['Api', 'todos']],

    ['GET', '/signup',       ['Authorization', 'show_signup']],
    ['POST', '/signup',      ['Authorization', 'signup']],
    ['GET', '/login',        ['Authorization', 'show_login']],
    ['POST', '/login',       ['Authorization', 'login']],
    ['GET', '/logout',       ['Authorization', 'logout']],

    ['GET', '/home',         ['Homepage']],

    ['GET', '/{slug}',       ['Static_page']],
];
