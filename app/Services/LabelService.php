<?php

namespace App\Services;

use App\Repositories\Contracts\LabelRepositoryInterface;

class LabelService
{
    protected $labelRepo;

    public function __construct(LabelRepositoryInterface $labelRepo)
    {
        $this->labelRepo = $labelRepo;
    }

    public function getAll()
    {
        return [
            'labels' => $this->labelRepo->getAll()
        ];
    }

    public function create(array $data)
    {
        $label = $this->labelRepo->create($data);

        return [
            'message' => 'Label created success',
            'label' => $label
        ];
    }

    public function update(array $data, $id)
    {
        $label = $this->labelRepo->find($id);
        $label->update($data);

        return [
            'message' => 'Label updated success',
            'label' => $label
        ];
    }


    public function delete($id)
    {
       $this->labelRepo->delete($id);
       return [
        'message'=>'Label deleted successfully'
       ];
    }

    public function find($id)
    {
        return [
            'label'=>$this->labelRepo->find($id)
        ];
    }
}
