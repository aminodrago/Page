<?php namespace Lavalite\Page\Models;

use \LaravelBook\Ardent\Ardent;
use \Venturecraft\Revisionable\RevisionableTrait;
use \Conner\Tagging\Taggable;
use \Lavalite\FileUp\FileUpTrait;
use \Dimsav\Translatable\Translatable;

class Page extends Ardent{

	use RevisionableTrait, Taggable, FileUpTrait, Translatable{
		RevisionableTrait::boot as rtBoot;
		FileUpTrait::boot as fuBoot;
	}

	protected $softDelete   = true;

	protected $rowsPerPage  = 15;

	protected $table  		= 'pages';

	public $autoHydrateEntityFromInput      = true;
	public $forceEntityHydrationFromInput   = true;

	public static function boot(){
		parent::boot();
		static::rtBoot();
		static::fuBoot();
	}

	public static $sluggable = array(
		'build_from' => 'name' );

	public static $rules = array(
		'name'      => 'required');
	/**
	* Array with the fields translated in the Translation table
	*
	* @var array
	*/
	public $translatedAttributes = array('heading','content','title','keyword','description','abstract');

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
	public $translationForeignKey   = 'page_id';

	/**
	* Add your translated attributes here if you want
	* fill them with mass assignment
	*
	* @var array
	*/
	protected $fillable = ['name','slug','order','status', 'heading', 'content','title','keyword','description','abstract'];

	/**
	* The database field being used to define the locale parameter in the translation model.
	* Defaults to 'locale'
	*
	* @var string
	*/
	public $localeKey = 'lang';

	protected $keepRevisionOf = array(
		'name', 'content','title','keyword','description','abstract');


	protected $uploads          = array('single'        => array('banner'));
}