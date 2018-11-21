<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Repositories\Admin\ArticleRepository;
use App\Http\Requests\Admin\ArticleRequest;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->renderView();
    }
}
