<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('dataMaster.home');
    }
    public function data()
    {
        return view('dataMaster.index');
    }
    public function transaksi()
    {
        return view('dataMaster.transaksi');
    }
    public function laporan()
    {
        return view('dataMaster.laporan');
    }
    public function pengajuan()
    {
        return view('pengajuan.index');
    }
}
