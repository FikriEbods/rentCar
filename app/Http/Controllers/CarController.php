<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Brand;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\type;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::paginate(10);
        $brand = Brand::all();
        $type = Type::all();
        return view('admin.mobil.index', [
            'cars' => $cars, 
            'brand' => $brand, 
            'type' => $type, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = Brand::all();
        $type = Type::all();
        return view('admin.mobil.create', [
            'brand' => $brand, 
            'type' => $type, 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $image_path = $request->file('image')->store('image', 'public');
        Car::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image_path,
            'brand_id' => $request->brand_id,
            'type_id' => $request->type_id,
            'number_plate' => $request->number_plate,
            'price' => $request->price,
        ]);

        return redirect()->route('cars')->with('status', 'Data Has Been Save');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        ///get post by ID
        Storage::delete('public/posts/'. $car->image);
        $car->delete();
        //redirect to index
        return redirect()->back()->with(['success' => 'Data Has Been Delete!']);
    }
}
