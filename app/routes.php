<?php

return [
    ['GET', '/todo', ['Todo']],
    ['POST', '/todo', ['Todo', 'add_task']],
    ['DELETE', '/todo', ['Todo', 'delete_task']],

    ['GET', '/signup', ['User', 'show_signup']],
    ['POST', '/signup', ['User', 'signup']],
    ['GET', '/login', ['User', 'show_login']],
    ['POST', '/login', ['User', 'login']],

    ['GET', '/home', ['Homepage']],
    //['GET', '/{slug}', ['Page']],
    ['GET', '/hello/{name}', ['Test']],
];  