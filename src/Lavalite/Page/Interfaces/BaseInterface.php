<?php

namespace Lavalite\Page\Interfaces;

interface BaseInterface
{
    /**
     * Base methods.
     */
    public function all();

    public function create($array);

    public function json();

    public function update($id, $array);

    public function find($id);

    public function destroy($id);

    public function instance($array);
}
