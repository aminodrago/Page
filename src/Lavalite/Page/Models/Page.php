<?php namespace Lavalite\Page\Models;

use Config;
use Dimsav\Translatable\Translatable;
use Lavalite\Filer\FilerTrait;
use Str;

class Page extends Model
{

    use Translatable;
    use FilerTrait;

    public static $rules = [];

    /**
     * Array with the fields translated in the Translation table
     *
     * @var array
     */
    public $translatedAttributes = [];
    /**
     * Set $translationModel if you want to overwrite the convention
     * for the name of the translation Model. Use full namespace if applied.
     *
     * The convention is to add "Translation" to the name of the class extending Translatable.
     * Example: Country => CountryTranslation
     */
    public $translationModel = 'Lavalite\Page\Models\PageLang';
    /**
     * This is the foreign key used to define the translation relationship.
     * Set this if you want to overwrite the laravel default for foreign keys.
     *
     * @var
     */
    public $translationForeignKey = 'page_id';
    /**
     * The database field being used to define the locale parameter in the translation model.
     * Defaults to 'locale'
     *
     * @var string
     */
    public $localeKey = 'lang';


    protected $keepRevisionOf =[];

    protected $uploads = [];

    protected $uploadFolder = '';

    /**
     * Listen for save and updating event
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if (!empty($model->id)) $model->upload();
            $model->slug = !empty($model->slug) ? $model->slug : $model->getUniqueSlug($model->name);
            return $model->validate();
        });
    }

    public function save(array $options = array())
    {
        if (parent::save($options))
        {
            return $this->saveTranslations();
        }
        return false;
    }

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

    public function getBannerAttribute($banner)
    {
        $value  = $banner;
        return ($value == '') ? array() : unserialize($value);
    }

    public function initialize()
    {
        $this->fillable = Config::get('page::page.fillable');
        $this->translatedAttributes = Config::get('page::page.translatable');
        $this->uploads = Config::get('page::page.uploadable');
        $this->uploadFolder = Config::get('page::page.upload-folder');
        $this->table = Config::get('page::page.table');
    }

}
