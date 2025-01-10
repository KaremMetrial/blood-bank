<?php

	namespace App\Http\Controllers\Web;

	use App\Http\Controllers\Controller;
	use App\Models\BloodType;
	use App\Models\City;
	use App\Models\DonationRequest;
	use Illuminate\Http\Request;

	class DonationController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 */
		public function index(Request $request)
		{
			$cities = City::select('id', 'name')->get();
			$bloodTypes = BloodType::select('id', 'name')->get();

			$query = DonationRequest::query();

			$query->when($request->filled('city_id'), function ($query) use ($request) {
				$query->where('city_id', $request->input('city_id'));
			});

			$query->when($request->filled('blood_type_id'), function ($query) use ($request) {
				$query->where('blood_type_id', $request->input('blood_type_id'));
			});

			$donations = $query->latest()->paginate(5);


			return view('admins.donations.index', get_defined_vars());

		}

		/**
		 * Show the form for creating a new resource.
		 */
		public function create()
		{
			//
		}

		/**
		 * Store a newly created resource in storage.
		 */
		public function store(Request $request)
		{
			//
		}

		/**
		 * Display the specified resource.
		 */
		public function show(string $id)
		{
			//
		}

		/**
		 * Show the form for editing the specified resource.
		 */
		public function edit(string $id)
		{
			//
		}

		/**
		 * Update the specified resource in storage.
		 */
		public function update(Request $request, string $id)
		{
			//
		}

		/**
		 * Remove the specified resource from storage.
		 */
		public function destroy(DonationRequest $donation)
		{
			$donation->delete();
			toastr()->success('Donation Request Deleted Successfully');
            return redirect()->route('donations.index');
		}
	}
