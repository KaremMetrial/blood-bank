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
        // Get all categories
        $categories = Category::all();
        // Check if categories are empty
        if ($categories->isEmpty()) {
            // Return error response
            return $this->errorResponse('لا يوجد أي فئة.', 404);
        }
        // Return success response with categories
        return $this->successResponse($categories, 'تم جلب الفئات بنجاح.');
    }
}
