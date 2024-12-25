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
        $query = DonationRequest::query()
        // Filter by blood type ID
            ->when($request->filled('governorate_id'), function ($query) use ($request) {
                $query->whereHas('city', function ($q) use ($request) {
                    $q->where('governorate_id', $request->governorate_id);
                });
            })
        /// Filter by blood type ID
            ->when($request->filled('blood_type_id'), function ($query) use ($request) {
                $query->where('blood_type_id', $request->blood_type_id);
            })
            ->latest();

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

            $donationRequest = DonationRequest::create([
                 ...$request->validated(),
                'client_id' => auth()->id(),
            ]);

            // Return a success response with the created donation request
            return $this->successResponse(new DonationRequestResource($donationRequest), 'Donation request created successfully');

        } catch (\Exception $e) {

            /// Return an error response if an exception occurs
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function show($id)
    {
        // Find the donation request by ID
        $donationRequest = DonationRequest::find($id);
        
        // Check if the donation request exists
        if (!$donationRequest) {
            // Return an error response if the donation request is not found
            return $this->errorResponse('Donation request not found', 404);
        }
        // Return a success response with the donation request
        return $this->successResponse(new DonationRequestResource($donationRequest), 'Donation request retrieved successfully');
    }
}
