<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $subjects = Subject::latest()->get();

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Success fetching all subjects',
            'data' => $subjects
        ], 200);
    }
}
