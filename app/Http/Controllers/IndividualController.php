<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

use App\Traits\Pagination;
use App\Services\IndividualService;
use App\Http\Resources\IndividualCollection;
use App\Http\Resources\IndividualResource;
use App\Http\Requests\IndividualRequest;

class IndividualController extends Controller
{
    use Pagination;

    protected $individualService;

    public function __construct(IndividualService $individualService)
    {
        $this->individualService = $individualService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $individuals = $this->individualService->all();
            return response()->json(new IndividualCollection($individuals), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(), 
                'status' => $e->getCode()
            ], $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IndividualRequest $request): JsonResponse
    {
        try {
            $input = $request->only(['name', 'document', 'mail', 'phone', 'address', 'number', 'complement', 'district', 'city', 'cep', 'state', 'active']);
            $individual = $this->individualService->store($input);
            
            return response()->json(new IndividualResource($individual), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(), 
                'status' => $e->getCode()
            ], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $individual = $this->individualService->findById($id);  
            return response()->json(new IndividualResource($individual), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => $e->getCode()
            ], $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IndividualRequest $request, string $id): JsonResponse|Response
    {
        try {
            $input = $request->only(['name', 'document', 'mail', 'phone', 'address', 'number', 'complement', 'district', 'city', 'cep', 'state', 'active']);
            $this->individualService->update($id, $input);
            
            return response()->noContent();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(), 
                'status' => $e->getCode()
            ], $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse|Response
    {
        try {
            $this->individualService->destroy($id);

            return response()->noContent();
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(), 
                'status' => $e->getCode()
            ], $e->getCode());
        }
    }
}
