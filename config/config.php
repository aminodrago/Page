<?php

return [

    /*
     * Provider .
     */
    'provider' => 'lavalite',

    /*
     * Package.
     */
    'package'  => 'page',

    /*
     * Modules.
     */
    'modules'  => ['page', 'category'],

    /*
     * Compilers .
     */
    'compiler' => ['none' => 'None', 'php' => 'Php', 'blade' => 'Blade', 'twig' => 'Twig'],

    /*
     * Views for the page  .
     */
    'views'    => ['page' => 'Default', 'left' => 'Left side menu'],

    /*
     * Modale variables for page module.
     */
    'page'     => [
        'model'        => 'Lavalite\Page\Models\Page',
        'table'        => 'pages',
        'primaryKey'   => 'id',
        'hidden'       => [],
        'visible'      => [],
        'guarded'      => ['*'],
        'slugs'        => ['slug' => 'name'],
        'dates'        => ['deleted_at'],
        'appends'      => ['eid'],
        'fillable'     => ['name', 'title', 'heading', 'sub_heading', 'abstract', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'banner', 'images', 'compiler', 'view', 'order', 'status'],
        'translate'    => ['name', 'title', 'heading', 'sub_heading', 'abstract', 'content', 'meta_title', 'meta_keyword', 'meta_description'],

        'uploadfolder' => '/uploads/page',
        'uploads'      => [
            'single'   => ['banner'],
            'multiple' => ['images'],
        ],
        'casts'        => [
            'banner' => 'array',
            'images' => 'array',
        ],
        'revision'     => ['name', 'title', 'heading', 'sub_heading', 'abstract', 'meta_title', 'meta_keyword'],
        'perPage'      => '20',
    ],
];
