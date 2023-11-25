<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Transection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    function index() {
        $car = Car::all();
        return view('homepage', [
            'car' => $car
        ]);
    }

    function index_admin()  {
        return view('admin.dashboard.dashboard');
    }

    function show(Car $car) {
        $transaction = Transection::where('car_id', $car->id)->paginate(10);
        return view('show', [
            'car' => $car,
            'transaction' => $transaction
        ]);
    }

    function booking(Car $car, Request $request) {
        $startDate = $request->start_at;
        $endDate = $request->end_at;

        // Memeriksa apakah mobil sudah dipesan pada rentang tanggal yang diminta
        $check = Transection::where('car_id', $car->id)
                        ->where(function($query) use ($startDate, $endDate) {
                            $query->whereBetween('start_at', [$startDate, $endDate])
                                ->orWhereBetween('end_at', [$startDate, $endDate])
                                ->orWhere(function($query) use ($startDate, $endDate) {
                                    $query->where('start_at', '<=', $startDate)
                                            ->where('end_at', '>=', $endDate);
                                });
                        })
                        ->exists();

        if($check) {
            return back()->with('alert', 'Car is already booked for the requested dates.');
        }

        $numberOfDays = \Carbon\Carbon::parse($startDate)->diffInDays(\Carbon\Carbon::parse($endDate));
        $rentalPrice = $numberOfDays * $car->price;

        return view('booking', [
            'car' => $car,
            'start_at' => $startDate,
            'end_at' => $endDate,
            'numberOfDays' => $numberOfDays,
            'rentalPrice' => $rentalPrice
        ]);
    }

    function payment(Car $car, Request $request) {
        Transection::create([
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'car_id' => $car->id,
            'user_id' => Auth::user()->id,
            'total_price' => $request->rentalPrice,
            'transaction_status' => '1',
        ]);

        return redirect()->route('detail',[$car->id])->with('status', 'Booking Has Been Save');
    }
}
