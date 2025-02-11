<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function paymentForm($booking_id){
        $booking = Booking::find($booking_id);
        $user = User::find(Auth::id());

        return view('pages.form-pembayaran', ['booking' => $booking, 'user' => $user]);
    }

    public function paymentProcess(Request $request){
        $request->validate([
            'email' => ['required', 'email:dns'],
            'metode_pembayaran' => ['required', 'in:cash,debit'],
            'nomor_kartu' => ['nullable', 'required_if:metode_pembayaran,debit', 'digits_between: 13,19'],
            'total_pembayaran' => ['required', 'numeric', 'min:1'],
        ],[
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid.',
            'nomor_kartu.required_if' => 'Nomor kartu wajib diisi jika memilih metode pembayaran debit.',
            'nomor_kartu.digits_between' => 'Nomor kartu harus antara 13-19 digit.',
        ]);

        $user_id = Auth::id();
        $booking_id = $request->booking_id;
        $metode_pembayaran = $request->metode_pembayaran;
        $booking = Booking::find($booking_id);
        
        if($metode_pembayaran == 'cash'){
            Payment::create([
                'user_id' => $user_id,
                'booking_id' => $booking_id,
                'email' => $request->email,
                'metode_pembayaran' => $request->metode_pembayaran,
                'nomor_kartu' => null,
                'total_pembayaran' => $request->total_pembayaran,
            ]);

            $booking->status = 'paid';
            $booking->save();
        }else {
            Payment::create([
                'user_id' => $user_id,
                'booking_id' => $booking_id,
                'email' => $request->email,
                'metode_pembayaran' => $request->metode_pembayaran,
                'nomor_kartu' => $request->nomor_kartu,
                'total_pembayaran' => $request->total_pembayaran,
            ]);

            $booking->status = 'paid';
            $booking->save();
        }

        return redirect()->route('userTicket')->with('paymentSuccess', 'Pembayaran berhasil diproses. Silakan tunggu...');
    }

}
