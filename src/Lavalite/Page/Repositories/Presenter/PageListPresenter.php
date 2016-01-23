<?php

namespace Lavalite\Page\Repositories\Presenter;

use Litepie\Database\Presenter\FractalPresenter;

class PageListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PageListTransformer();
    }
}