<?php namespace Lavalite\Page\Models;

use Lavalite\Filer\FilerTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{

    use FilerTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'banner' => 'array',
        'images' => 'array',
    ];


    /**
     * @param $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        if (trim($this->getAttribute('title')) == '')
            $this->setAttribute('title', $name);

        if (trim($this->getAttribute('heading')) == '')
            $this->setAttribute('heading', $name);
    }

    public function initialize()
    {
        $this->fillable             = config('pages.page.fillable');
        $this->uploads              = config('pages.page.uploadable');
        $this->uploadRootFolder     = config('pages.page.upload-folder');
        $this->table                = config('pages.page.table');
    }

}
