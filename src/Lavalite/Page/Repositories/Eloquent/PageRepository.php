<?php namespace Lavalite\Page\Repositories\Eloquent;

use App;
use Lang;
use Theme;
use Lavalite\Page\Models\Page as Page;
use Lavalite\Page\Interfaces\PageInterface;

class PageRepository extends BaseRepository implements PageInterface
{
    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    public function getPage($slug)
    {
        $page 	= $this -> model -> whereSlug($slug) -> first();

        if (!$page) {
            $page   = $this -> model -> whereSlug('404') -> first();
        }

        if (!$page) {
            App::abort(404, Lang::get("page::messages.nopage"));
        }

        $this -> compile($page);
        return $page;
    }

    public function heading($slug)
    {
        return $this -> pagePart($slug, 'heading');
    }

    public function content($slug)
    {
        return $this -> pagePart($slug, 'content');
    }

    public function title($slug)
    {
        return $this -> pagePart($slug, 'title');
    }

    public function keyword($slug)
    {
        return $this -> pagePart($slug, 'keyword');
    }

    public function description($slug)
    {
        return $this -> pagePart($slug, 'description');
    }

    public function banner($slug)
    {
        return $this -> pagePart($slug, 'banner');
    }

    public function removeFile($id, $field, $no)
    {
        return $this -> model -> removeFile($id, $field, $no);
    }

    public function pagePart($slug, $field)
    {
        $page 	= $this -> model -> whereSlug($slug) -> first();

        if (!$page) {
           return Lang::get("page::messages.nopage");
        }

        return $page->$field;
    }

    public function errors()
    {
        return $this -> model -> errors();
    }

    public function compile(&$page)
    {
        $compiler = $page->compiler;

        if ($compiler == 'blade')
            $page->content = Theme::blader($page -> content, array());
        elseif ($compiler == 'twig')
            $page->content = Theme::twigy($page -> content, array());

    }
}
