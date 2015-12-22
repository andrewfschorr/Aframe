<?php

return [
    ['GET', '/todo', ['Todo']],
    ['POST', '/todo', ['Todo', 'add_task']],
    ['DELETE', '/todo', ['Todo', 'delete_task']],

    ['GET', '/signup', ['User']],
    ['POST', '/signup', ['User', 'signup']],


    ['GET', '/home', ['Homepage']],
    //['GET', '/{slug}', ['Page']],
    ['GET', '/hello/{name}', ['Test']],
];  