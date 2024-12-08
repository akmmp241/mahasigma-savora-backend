<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    public function list(Request $request): JsonResponse
    {
        $query = Category::query()->select(['id', 'name', 'image_url']);

        if ($search = $request->query('search'))
            $query->where('name', 'like', '%' . $search . '%');

        if ($limit = $request->query('limit'))
            $query->limit($limit);

        $categories = $query->get();

        if ($categories->isEmpty())
            throw new NotFoundHttpException('Categories not found.');

        return $this->successResponse(
            message: 'Categories fetched successfully.',
            data: $categories->toArray()
        );
    }
}
