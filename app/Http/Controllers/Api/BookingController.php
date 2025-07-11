<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="BookingInput",
 *   type="object",
 *   required={"resource_id", "user_id", "start_time", "end_time"},
 *   @OA\Property(property="resource_id", type="integer", example=1),
 *   @OA\Property(property="user_id", type="integer", example=1),
 *   @OA\Property(property="start_time", type="string", format="date-time", example="2026-07-11 10:00:00"),
 *   @OA\Property(property="end_time", type="string", format="date-time", example="2026-07-11 11:00:00")
 * )
 */
class BookingController extends Controller
{
    protected $bookings;

    public function __construct(BookingRepositoryInterface $bookings)
    {
        $this->bookings = $bookings;
    }

    /**
     * @OA\Post(
     *     path="/api/bookings",
     *     summary="Create a new booking",
     *     tags={"Bookings"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/BookingInput")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Booking created"
     *     )
     * )
     */
    public function store(StoreBookingRequest $request): JsonResponse
    {
        $booking = $this->bookings->create($request->validated());

        return (new BookingResource($booking))
            ->additional(['status' => 'success'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * @OA\Delete(
     *     path="/api/bookings/{id}",
     *     summary="Delete a booking by id",
     *     tags={"Bookings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successfully deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->bookings->delete($id);
        if ($deleted) {
            return response()->json(['status' => 'success'], 204);
        }
        return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
    }
}
