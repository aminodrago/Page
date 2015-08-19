<?php

namespace Lavalite\Page\Models;

use DB;
use Lavalite\Page\Interfaces\ModalInterface;
use Lavalite\Filer\FilerTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

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
     * Initialiaze page modal
     *
     * @param $name
     */
    public function __construct()
    {
        parent::__construct();
        $this->initialize();
    }

    /**
     * Set name to similar fields.
     *
     * @param $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        if (trim($this->getAttribute('title')) == '') {
            $this->setAttribute('title', $name);
        }

        if (trim($this->getAttribute('heading')) == '') {
            $this->setAttribute('heading', $name);
        }
    }

    /**
     * Create a unique slug.
     *
     * @param string $title
     */
    public function getUniqueSlug($title)
    {
        $slug = str_slug($title);
        $row = DB::table($this->table)->where('slug', $slug)->first();
        if ($row) {
            $num = 2;
            while ($row) {
                $newSlug = $slug.'-'.$num;
                $row = DB::table($this->table)->where('slug', $newSlug)->first();
                ++$num;
            }
            $slug = $newSlug;
        }
        return $slug;
    }

    /**
     * Boots the user repository
     *
     * @return void
     */
    public function initialize()
    {
        $this->fillable             = config('pages.page.fillable');
        $this->uploads              = config('pages.page.uploadable');
        $this->uploadRootFolder     = config('pages.page.upload_root_folder');
        $this->table                = config('pages.page.table');
    }

}

