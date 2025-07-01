<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Carbon\Carbon;


class NotifController extends Controller
{
  public function index()
{
    $today = now()->toDateString();
    $notifs = \App\Models\Loan::with('book')->whereDate('tanggal_pinjam', $today)->get();
    return view('notif', compact('notifs'));
}

}
