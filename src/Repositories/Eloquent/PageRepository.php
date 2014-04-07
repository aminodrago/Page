<?php namespace Lavalite\Page\Repositories\Eloquent;

use Lavalite\Page\Models\Page as Page;
use Lavalite\Page\Interfaces\PageInterface;

class PageRepository extends BaseRepository implements PageInterface {

	function __construct(Page $page)
	{
		$this->model = $page;
	}

	public function getPage($slug)
	{
		$page 	= $this -> model -> whereSlug($slug) -> first();

		if(!$page) {
            \App::abort(404);
        }

        return $page;
	}
}