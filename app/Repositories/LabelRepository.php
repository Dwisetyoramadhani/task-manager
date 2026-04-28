<?php

namespace App\Repositories;

use App\Models\Label;
use App\Repositories\Contracts\LabelRepositoryInterface;

class LabelRepository implements LabelRepositoryInterface{
    public function getAll()
    {
        return Label::all();
    }
    public function find($id)
    {
        return Label::find($id);
    }
    public function create(array $data)
    {
        return Label::create($data);
    }
    public function update($id, array $data)
    {
        return Label::update($id, $data);
    }
    public function delete($id)
    {
        return Label::destroy($id);
    }
}
