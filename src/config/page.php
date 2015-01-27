<?php

return array(
        'name'          => 'Product',
        'table'         => 'pages',
        'model'         => 'Lavalite\Catalogue\Models\Product',
        'permissions'   => ['admin'     => ['view', 'create', 'edit', 'delete', 'image']],
        'image'         =>
            [
            'xs'        => ['width' =>'60',     'height' =>'45', 'default' => 'path-to-banner-set-it-in-page-config'],
            'sm'        => ['width' =>'160',    'height' =>'75'],
            'md'        => ['width' =>'460',    'height' =>'345'],
            'lg'        => ['width' =>'800',    'height' =>'600'],
            'xl'        => ['width' =>'1000',   'height' =>'750'],
            ],

        'fillable'          => ['name', 'category_id', 'slug', 'order', 'status', 'heading', 'content', 'title', 'keyword', 'description', 'abstract', 'compiler', 'view'],
        'translatable'      => ['heading', 'content', 'title', 'keyword', 'description', 'images'],
        'upload-folder'     => '/packages/lavalite/page/page/',
        'uploadable'        => ['single' => ['banner'], 'multiple' => ['images']],
        'table'             => 'pages',
);