<?php

return [

    ['GET', '/',                    ['Authorization']],
    ['GET', '/groups',              ['Group']],
    ['POST', '/group',              ['Group', 'add_group']],
    ['GET', '/group/{group}',       ['Group', 'display_group']],
    ['DELETE', '/group',            ['Group', 'delete_group']],

    ['POST', '/image',              ['Image', 'add_image']],
    ['DELETE', '/image',            ['Image', 'delete_image']],
    ['POST', '/feature-image',      ['Image', 'feature_image']],

    ['GET', '/api/groups',          ['Api', 'groups']],
    ['GET', '/api/group/{group}',   ['Api', 'group_images']],
    ['GET', '/api/images',          ['Api', 'all_images']],
    ['GET', '/api/featured-images', ['Api', 'featured_images']],

    ['GET', '/signup',              ['Authorization', 'show_signup']],
    ['POST', '/signup',             ['Authorization', 'signup']],
    ['GET', '/login',               ['Authorization', 'show_login']],
    ['POST', '/login',              ['Authorization', 'login']],
    ['GET', '/logout',              ['Authorization', 'logout']],

    ['GET', '/home',                ['Homepage']],
];
