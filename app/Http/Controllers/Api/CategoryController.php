<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return $this->errorResponse('لا يوجد أي فئة.', 404);
        }

        return $this->successResponse($categories, 'تم جلب الفئات بنجاح.');
    }
}
