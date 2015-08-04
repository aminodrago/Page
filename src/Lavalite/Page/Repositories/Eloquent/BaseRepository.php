<?php namespace Lavalite\Page\Repositories\Eloquent;

use Lavalite\Page\Interfaces\BaseInterface;

abstract class BaseRepository implements BaseInterface
{
    /**
     * @var Model
     */
    protected $model;

    public function all()
    {
        return $this->model->all();
    }

    public function json()
    {
        return  $this->model->get()->toArray();
    }

    public function create($array)
    {
        $row =  $this->instance($array);
        $row -> fill($array);
        $row -> save();
        return $row;
    }

    public function update($id, $array)
    {
        $row =  $this->model->find($id);
        $row -> fill($array);
        $row -> save();
        return $row;
    }

    public function find($id)
    {
        if ($id == 0) return $this -> instance();
        return $this-> model
                    -> whereId($id)
                    -> first();
    }

    public function delete($id)
    {
        $this -> model -> find($id) -> delete();
    }


    public function destroy($id)
    {
        $this -> model -> destroy($ids);
    }

    public function instance($data = array())
    {
        return new $this -> model($data);
    }

}
