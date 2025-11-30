<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Vendor\CategoryService;
class CategoryController extends Controller
{
    public $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService=$categoryService;
    }
    public function index()
    {
        return $this->categoryService->index();
    }
}
