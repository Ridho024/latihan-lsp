<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutingController extends Controller
{
    public function homePage(){
        return view('pages.homepage', ['hasil_pencarian' => []]);
    }

    public function jadwalPenerbangan(){
        $jadwal_penerbangan = Schedule::paginate(10);

        return view('pages.list-penerbangan', compact('jadwal_penerbangan'));
    }

    public function cariPenerbangan(Request $request){
        $bandara_asal = $request->bandara_asal;
        $bandara_tujuan = $request->bandara_tujuan;
        $tanggal_berangkat = $request->tanggal_berangkat;
        $tanggal_sampai = $request->tanggal_sampai;

        $hasil_pencarian = Schedule::where('bandara_asal', 'LIKE', "%$bandara_asal%")
                                    ->where('bandara_tujuan', 'LIKE', "%$bandara_tujuan%")
                                    ->whereDate('tanggal_berangkat', $tanggal_berangkat)
                                    ->whereDate('tanggal_sampai', $tanggal_sampai)
                                    ->paginate(10);

        if($hasil_pencarian->isEmpty()){
            return back()->with('emptyList', 'Penerbangan tidak ditemukan');
        }

        return view('pages.homepage', compact('hasil_pencarian'));
    }

    public function bookingPenerbangan(){
        return view('pages.booking-tiket');
    }

    public function userTicket(){
        $user_id = Auth::id();

        $my_tickets = Booking::where('user_id', $user_id)->with(['schedule'])->get();

        if($my_tickets->isEmpty()){
            return view('pages.user-tickets', ['my_tickets' => []]);
        }

        return view('pages.user-tickets', compact('my_tickets'));
    }

}
