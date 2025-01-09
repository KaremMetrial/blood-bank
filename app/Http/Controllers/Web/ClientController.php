<?php

    namespace App\Http\Controllers\Web;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Web\CreateCategoryRequest;
    use App\Http\Requests\Web\UpdateCategoryRequest;
    use App\Http\Requests\Web\UpdateClientRequest;
    use App\Models\BloodType;
    use App\Models\Category;
    use App\Models\City;
    use App\Models\Client;
    use Illuminate\Http\Request;

    class ClientController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index(Request $request)
        {
            $query = Client::query();

            $query->when($request->filled('name'), function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
            $query->when($request->filled('city_id'), function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            });
            $query->when($request->filled('blood_type_id'), function ($q) use ($request) {
                $q->where('blood_type_id', $request->blood_type_id);
            });

            $clients = $query->latest()->paginate(5);

            $cities = City::select('id', 'name')->get();
            $bloodTypes = BloodType::select('id', 'name')->get();

            return view('admins.clients.index', compact('clients', 'cities', 'bloodTypes'));
        }


        /**
         * Display the specified resource.
         */
        public
        function show(string $id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public
        function edit(Client $client)
        {
            $bloodTypes = BloodType::all();
            $cities = City::all();
            return view('admins.clients.edit', compact('client', 'bloodTypes', 'cities'));

        }

        /**
         * Update the specified resource in storage.
         */
        public
        function update(UpdateClientRequest $request, Client $client)
        {
            $client->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'd_o_b' => $request->date_of_birth,
                'last_donation_date' => $request->last_donation_date,
                'city_id' => $request->city_id,
                'blood_type_id' => $request->blood_type_id,
                'is_active' => $request->status,
            ]);

            if (!$client->wasChanged()) {
                toastr()->error('Client not updated');
                return redirect()->back();
            }

            toastr()->success('Client updated successfully');
            return redirect()->route('clients.index');

        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Client $client)
        {
            $client->delete();
            if (!$client) {
                toastr()->error('Category not deleted');
                return redirect()->back();
            }
            toastr()->success('Category deleted successfully');
            return redirect()->back();
        }
    }

