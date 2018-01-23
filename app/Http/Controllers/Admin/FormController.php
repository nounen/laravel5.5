<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class FormController extends Controller
{
    protected $tagRepository;

    public function __construct()
    {
        parent::__construct();

        $this->data['base_url'] = url('admin/form');
    }

    public function example()
    {
        return view('admin.form.example', $this->data);
    }

    public function postExample(Request $request)
    {
        dd($request->all());
    }
}
