<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Services\LabelService;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $service;

    public function __construct(LabelService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return response()->json($this->service->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string'
            ]);
            return response()->json($this->service->create($data));
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            return response()->json($this->service->find($id));
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'sometimes|string'
            ]);
            return response()->json($this->service->update($data, $id));
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            return response()->json($this->service->delete($id));
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }
}
