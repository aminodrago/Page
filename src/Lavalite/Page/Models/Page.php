<?php

namespace Lavalite\Page\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Lavalite\Filer\FilerTrait;
use Lavalite\Database\Traits\Hashids;
use Lavalite\Database\Traits\Slugger;
use Lavalite\Database\Traits\Translator;
use Lavalite\Database\Model;

class Page extends Model
{
    use FilerTrait, SoftDeletes, Hashids, Slugger, Translator;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Attributes from which slugs to be generated.
     *
     * @var array
     */
    protected $slugs = ['slug' => 'name'];

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
     * List of attributes to encrypt.
     *
     * @var array
     */
    protected $encryptable = ['id'];

    /**
     * List of attribute names which should be translated.
     *
     * @var array
     */
     protected $translate = ['name', 'content'];


    /**
     * Initialiaze page modal.
     *
     * @param $name
     */
    public function __construct()
    {
        $this->initialize();
        return parent::__construct();
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
