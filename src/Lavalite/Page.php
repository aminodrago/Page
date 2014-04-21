<?php namespace Lavalite\Page;

use Lavalite\Page\PageBuilder;
use Illuminate\Html\HtmlBuilder;
use Illuminate\Routing\UrlGenerator;

use Config, App, URL;

class Page
{

	protected $model;


	public function __construct(\Lavalite\Page\Interfaces\PageInterface $page)
	{
		$this->model 	= $page;
	}

	public function model()
	{
		return $this->model->getModel();
	}

	 public function __call($name, $arguments)
    {
       // dd(print_r($arguments));
        // Note: value of $name is case sensitive.
        return $this->model->$name($arguments[0]);
    }
}