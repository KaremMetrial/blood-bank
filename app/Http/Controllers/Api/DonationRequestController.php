<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DonationRequest as ApiDonationRequest;
use App\Http\Resources\DonationRequestResource;
use App\Models\DonationRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    use ApiResponse;
    private const PAGINATION_COUNT = 2;
    public function index(Request $request)
    {
        // Initialize donation requests query
        $query = DonationRequest::query();

        // Filter by governorate_id if provided
        if ($request->filled('governorate_id')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('governorate_id', $request->governorate_id);
            });
        }

        // Filter by blood_type_id if provided
        if ($request->filled('blood_type_id')) {
            $query->where('blood_type_id', $request->blood_type_id);
        }

        // Paginate the filtered results
        $donationRequests = $query->paginate(self::PAGINATION_COUNT);

        if ($donationRequests->isEmpty()) {
            // Return an error response if no records found
            return $this->errorResponse('No donation requests found', 404);
        }

        // Return a success response with the results
        return $this->successResponse($donationRequests, 'Donation requests retrieved successfully');
    }

    public function store(ApiDonationRequest $request)
    {
        try {

            // Validate the request data
            $validated = $request->validated();

            // Get the authenticated client
            $client = auth()->user();
            // Set the client_id attribute of the validated data
            $validated['client_id'] = $client->id;
            // Create a new donation request
            $donationRequest = DonationRequest::create($validated);

            // Return a success response with the created donation request
            return $this->successResponse(new DonationRequestResource($donationRequest), 'Donation request created successfully');

        } catch (\Exception $e) {

            /// Return an error response if an exception occurs
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
