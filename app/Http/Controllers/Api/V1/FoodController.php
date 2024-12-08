<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FoodController extends Controller
{
    public function list(Request $request): JsonResponse
    {
        $query = Food::query();

        if ($search = $request->query('search'))
            $query->where('name', 'like', '%' . $search . '%');

        if ($perPage = $request->query('limit'))

        if ($category = $request->query('category'))
            $query->where('category_id', $category);

        $foods = $query->paginate($perPage ?? 10);

        if ($foods->isEmpty())
            throw new NotFoundHttpException('Foods not found.');

        return $this->successResponse('Foods fetched successfully.', $foods->toArray());
    }
}
