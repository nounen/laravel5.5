<?php

namespace App\Http\Controllers\Admin;

use App\Models\Form;
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

    public function create()
    {
        $this->data['title'] = '创建表单';

        $this->data['create_rows'] = Form::getCreateFields();

        return view('admin.form.create', $this->data);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
