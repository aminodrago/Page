<?php

namespace Lavalite\Page\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Lavalite\Filer\FilerTrait;

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
     * Initialiaze page modal.
     *
     * @param $name
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Initialize the modal variables.
     *
     * @return void
     */
    public function initialize()
    {
        $this->fillable = config('package.page.page.fillable');
        $this->uploads = config('package.page.page.uploadable');
        $this->uploadRootFolder = config('package.page.page.upload_root_folder');
        $this->table = config('package.page.page.table');
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
}
