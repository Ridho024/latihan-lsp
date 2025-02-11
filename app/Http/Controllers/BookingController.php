<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function processBooking(Request $request){
        $request->validate([
            'schedule_id' => ['required'],
            'jumlah_kursi' => ['required', 'numeric'],
            'total_harga' => ['required'],
        ]);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $request->schedule_id,
            'jumlah_kursi' => $request->jumlah_kursi,
            'total_harga' => $request->total_harga,
            'status' => 'pending'
        ]);

        if(!$booking){
            return back()->with('bookingFailed', 'Proses pembelian tiket gagal, coba lagi.');
        }

        $schedule = Schedule::find($request->schedule_id);
        $schedule->kursi_tersedia -= $request->jumlah_kursi;
        $schedule->save();

        return redirect()->route('userTicket');
    }

    public function bookingForm($id){
        $penerbangan = Schedule::find($id);
        return view('pages.booking-tiket', ['penerbangan' => $penerbangan]);
    }
}
