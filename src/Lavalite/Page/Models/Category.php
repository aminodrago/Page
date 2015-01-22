<?php namespace Lavalite\Page\Models;

use Config;
use Str;


class Category extends Model
{

    protected $dates = [null];
    public static $rules = array(
        'name' => 'required',
    );
    protected $table = 'page_categories';
    protected $module = 'category';
    protected $package = 'page';
    protected $fillable = ['name', 'slug'];


    /**
     * Listen for save and updating event
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = !empty($model->slug) ? Str::slug($model->slug) : $model->getUniqueSlug($model->name);
            return $model->validate();
        });

    }

    /**
     * Return package name of the module
     *
     * @return string
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Connect the pages
     *
     * @return object
     */
    public function pages()
    {
        return $this->hasMany('\Lavalite\Page\Models\Page');
    }

}
