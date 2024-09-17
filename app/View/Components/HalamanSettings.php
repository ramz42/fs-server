<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\View\Component;

class HalamanSettings extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var Application
     */
    public $application;

    /**
     * Create a new component instance.
     *
     * @param Application $application
     * @param string      $name
     */
    public function __construct(Application $application, string $name)
    {
        $this->application = $application;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
<div class="row justify-content-center d-md-flex h-100" style="padding: 5%">

    <hr>
    <div style="padding: 2%">


        <form action="/proses" method="post">
            {{ csrf_field() }}
            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input class="form-control" type="text" name="nama" value="{{ old('nama') }}">
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Pekerjaan</label>
                    <input class="form-control" type="text" name="pekerjaan" value="{{ old('pekerjaan') }}">
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="form-label">Usia</label>
                    <input class="form-control" type="text" name="usia" value="{{ old('usia') }}">
                </div>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Proses">
            </div>
        </form>
    </div>
    <hr>
</div>
blade;
    }
}
