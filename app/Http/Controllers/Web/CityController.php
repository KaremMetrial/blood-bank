<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CreateCityRequest;
use App\Http\Requests\Web\UpdateCityRequest;
use App\Models\City;
use App\Models\Governorate;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::with(['governorate:id,name'])
            ->latest()
            ->paginate(8);

        return view('admins.cities.index', compact('cities'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $governorates = Governorate::select('id', 'name')->get();
        return view('admins.cities.create', compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCityRequest $request)
    {
        $city = City::create([
            'name' => $request->name,
            'governorate_id' => $request->governorate_id,

        ]);
        if (!$city) {
            toastr()->error('City not created');
            return redirect()->back();
        }
        toastr()->success('City created successfully');
        return redirect()->route('cities.index');
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
    public function edit(City $city)
    {
        $governorates = Governorate::select('id', 'name')->get();
        return view('admins.cities.edit', compact('city', 'governorates'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {

        $city->update([
            'name' => $request->name,
            'governorate_id' => $request->governorate_id,
        ]);

        if (!$city->wasChanged()) {
            toastr()->error('City not updated');
            return redirect()->back();
        }

        toastr()->success('City updated successfully');
        return redirect()->route('cities.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        if (!$city) {
            toastr()->error('City not deleted');
            return redirect()->back();
        }
        toastr()->success('City deleted successfully');
        return redirect()->back();
    }
}
