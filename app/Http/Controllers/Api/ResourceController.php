<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ResourceRepositoryInterface;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Resources\ResourceResource;
use App\Http\Resources\BookingResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="ResourceInput",
 *   type="object",
 *   required={"name", "type"},
 *   @OA\Property(property="name", type="string", example="Room 1"),
 *   @OA\Property(property="type", type="string", example="meeting_room")
 * )
 */
class ResourceController extends Controller
{
    protected $resources;
    protected $bookings;

    public function __construct(ResourceRepositoryInterface $resources, BookingRepositoryInterface $bookings)
    {
        $this->resources = $resources;
        $this->bookings = $bookings;
    }

    /**
     * @OA\Get(
     *     path="/api/resources",
     *     summary="Get all resources",
     *     tags={"Resources"},
     *     @OA\Response(
     *         response=200,
     *         description="List of resources"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return ResourceResource::collection($this->resources->all())
            ->additional(['status' => 'success'])
            ->response()
            ->setStatusCode(200);
    }

    /**
     * @OA\Post(
     *     path="/api/resources",
     *     summary="Create a new resource",
     *     tags={"Resources"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/ResourceInput")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created"
     *     )
     * )
     */
    public function store(StoreResourceRequest $request): JsonResponse
    
    {
        $resource = $this->resources->create($request->validated());
        return (new ResourceResource($resource))
            ->additional(['status' => 'success'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *     path="/api/resources/{id}/bookings",
     *     summary="Get all bookings for a resource",
     *     tags={"Resources"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of bookings"
     *     )
     * )
     */
    public function bookings(int $id): JsonResponse
    {
        $bookings = $this->bookings->getByResourceId($id);
        return BookingResource::collection($bookings)
            ->additional(['status' => 'success'])
            ->response()
            ->setStatusCode(200);
    }
}
