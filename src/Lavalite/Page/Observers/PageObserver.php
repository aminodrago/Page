<?php namespace Lavalite\Page\Observers;


class PageObserver {

    public function saving($model)
    {
        $model->upload($model);

        $model->slug = !empty($model->slug) ? $model->slug : $model->getUniqueSlug($model->name);
    }
}