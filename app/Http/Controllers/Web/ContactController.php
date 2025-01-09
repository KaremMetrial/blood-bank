<?php

	namespace App\Http\Controllers\Web;

	use App\Http\Controllers\Controller;
	use App\Models\Client;
	use App\Models\Contact;
	use Illuminate\Http\Request;

	class ContactController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 */
		public function index(Request $request)
		{
			$contacts = Contact::query();

			$contacts->when($request->filled('name'), function ($query) use ($request) {
				$query->whereHas('client', function ($query) use ($request) {
					$query->where('name', 'like', '%' . $request->name . '%');
				});
			});

			$contacts = $contacts->latest()->paginate(5);

			return view('admins.contacts.index', compact('contacts'));
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
		public function destroy(Contact $contact)
		{
			$contact->delete();
			if (!$contact) {
				toastr()->error('Category not deleted');
				return redirect()->back();
			}
			toastr()->success('Category deleted successfully');
			return redirect()->back();
		}
	}
