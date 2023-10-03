<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

class PengajuanTerpenuhi extends Component
{
    public Model $model;

    public $field;

    public $terpenuhi;

    public function mount()
    {
        $this->terpenuhi = (bool) $this->model->getAttribute($this->field);
    }

    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();
    }

    public function render()
    {
        return view('livewire.pengajuan-terpenuhi');
    }
}
