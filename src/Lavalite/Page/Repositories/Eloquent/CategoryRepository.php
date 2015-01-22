<?php namespace Lavalite\Page\Repositories\Eloquent;

use Lavalite\Page\Interfaces\CategoryInterface;

use App;
use Lang;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function __construct(\Lavalite\Page\Models\Category $category)
    {
        $this->model = $category;
    }

    public function categories()
    {
        return $this->model->lists('name','id');
    }
}
