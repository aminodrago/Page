<?php
return array(

/**
* Provider .
*/
'provider'   => 'lavalite',

/**
* Package .
*/
'package'    => 'page',

/**
* Modules .
*/
'modules'    => ['page', 'category'],

/**
* Compilers .
*/
'compiler'   => ['none' => 'None', 'php' => 'Php', 'blade' => 'Blade', 'twig' => 'Twig'],

/**
* Views for the page  .
*/
'views'      => ['page' => 'Default'],

'category'  => [
                    'name'          => 'Category',
                    'table'         => 'page_categories',
                    'model'         => 'Lavalite\Page\Models\Category',
                    'permissions'   => ['admin' => ['view', 'create', 'edit', 'delete', 'image']],
                    'image'         => [
                                            'xs'        => ['width' =>'60',     'height' =>'45'],
                                            'sm'        => ['width' =>'100',    'height' =>'75'],
                                            'md'        => ['width' =>'460',    'height' =>'345'],
                                            'lg'        => ['width' =>'800',    'height' =>'600'],
                                            'xl'        => ['width' =>'1000',   'height' =>'750'],
                                        ],
                ],

'page'      => [
                'name'          => 'Pages',
                'table'         => 'pages',
                'model'         => 'Lavalite\Page\Models\Page',
                'permissions'   => ['admin'     => ['view', 'create', 'edit', 'delete', 'image']],
                'image'         => [
                                        'xs'        => ['width' =>'60',     'height' =>'45', 'default' => ''],
                                        'sm'        => ['width' =>'160',    'height' =>'75'],
                                        'md'        => ['width' =>'460',    'height' =>'345'],
                                        'lg'        => ['width' =>'800',    'height' =>'600'],
                                        'xl'        => ['width' =>'1000',   'height' =>'750'],
                                    ],
                'fillable'          =>  ['name', 'slug', 'order', 'banner', 'view', 'compiler', 'status', 'upload_folder', 
                                         'heading', 'title', 'content', 'keyword', 'description', 'images', 'abstract'],
                'listfields'        =>  ['id', 'name', 'category_id', 'slug', 'order', 'status', 'heading', 'title', 
                                        'abstract', 'compiler', 'view'],
                'translatable'      =>  ['heading', 'content', 'title', 'keyword', 'description', 'images'],
                'upload-folder'     =>  '/packages/lavalite/page/page',
                'uploadable'        =>  [
                                            'single' => ['banner'], 
                                            'multiple' => ['images']
                                        ],
               ]
);