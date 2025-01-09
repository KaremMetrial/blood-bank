<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UpdateGovernorateRequest;
use App\Http\Requests\Web\CreateGovernorateRequest;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $governorates = Governorate::latest()->paginate(8);

        return view('admins.governorates.index', compact('governorates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGovernorateRequest $request)
    {
        $governorate = Governorate::create([
            'name' => $request->name,
        ]);
        if (!$governorate) {
            toastr()->error('Governorate not created');
            return redirect()->back();
        }
        toastr()->success('Governorate created successfully');
        return redirect()->route('governorates.index');
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
    public function edit(Governorate $governorate)
    {
        return view('admins.governorates.edit', compact('governorate'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGovernorateRequest $request, Governorate $governorate)
    {
        $governorate->update([
            'name' => $request->name,
        ]);

        if (!$governorate->wasChanged()) {
            toastr()->error('Governorate not updated');
            return redirect()->back();
        }

        toastr()->success('Governorate updated successfully');
        return redirect()->route('governorates.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Governorate $governorate)
    {
        $governorate->delete();
        if (!$governorate) {
            toastr()->error('Governorate not deleted');
            return redirect()->back();
        }
        toastr()->success('Governorate deleted successfully');
        return redirect()->back();
    }
}
