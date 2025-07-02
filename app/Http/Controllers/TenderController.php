<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenderFilterRequest;
use App\Http\Requests\StoreTenderRequest;
use App\Models\Tender;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    public function index(TenderFilterRequest $request): JsonResponse
    {
        $query = Tender::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('date')) {
            $query->whereDate('updated_at', $request->date);
        }

        return response()->json($query->get());
    }

    public function show($id): JsonResponse
    {
        $tender = Tender::findOrFail($id);
        return response()->json($tender);
    }

    public function store(StoreTenderRequest $request): JsonResponse
    {
        $tender = Tender::create($request->validated());
        return response()->json($tender, 201);
    }
}
