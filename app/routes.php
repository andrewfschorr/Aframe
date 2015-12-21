<?php

return [
    ['GET', '/', ['Todo']],
    ['POST', '/', ['Todo', 'add_task']],
    ['DELETE', '/', ['Todo', 'delete_task']],


    ['GET', '/home', ['Homepage']],
    //['GET', '/{slug}', ['Page']],
    ['GET', '/hello/{name}', ['Test']],
];  