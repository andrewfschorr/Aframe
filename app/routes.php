<?php

return [
    ['GET', '/',             ['User', 'show_profile']],

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

    ['GET', '/hello-world',  ['Static_page']],
    ['GET', '/{slug}',       ['Static_page']],
    ['GET', '/hello/{name}', ['Test']],
];
