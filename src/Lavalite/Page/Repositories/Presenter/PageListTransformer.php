<?php

namespace Lavalite\Page\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class PageListTransformer extends TransformerAbstract
{
    public function transform(\Lavalite\Page\Models\Page $page)
    {
        return [
            'id'      => $page->eid,
            'slug' => $page->slug,
            'url' => $page->slug.'.html',
            'name'   => $page->name,
            'heading'   => $page->heading,
            'title'   => $page->title,
            'keyword'   => $page->keyword,
            'status' => $page->status,
            'order' => $page->order
        ];
    }
}