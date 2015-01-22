<?php namespace Lavalite\Page\Models;

use Eloquent;

class PageLang extends  Eloquent
{
    protected $softDelete	= false;
    protected $fillable		= ['page_id', 'heading', 'content','title','keyword', 'description', 'abstract', 'lang'];
    protected $table		= 'page_langs';

    public $timestamps = false;


}
