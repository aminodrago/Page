<?php

namespace Lavalite\Page\Interfaces;

interface PageRepositoryInterface
{
    public function getPageBySlug($slug);
}
