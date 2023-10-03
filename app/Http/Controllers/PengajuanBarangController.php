<?php

namespace App\Http\Controllers;

use App\Models\PengajuanBarang;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengajuanBarangRequest;
use App\Http\Requests\UpdatePengajuanBarangRequest;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengajuanBarangExport;
use App\Imports\PengajuanBarangImport;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PengajuanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data['pengajuan'] = PengajuanBarang::orderBy('created_at', 'DESC')->get();

            return view('pengajuan.index')->with($data);
        } catch (QueryException | Exception | PDOException $error) {
            $this->failResponses($error->getMessage(), $error->getCode());
        }
    }

    public function pengajuanExport()
    {
        $date = date('Y-m-d');
        return Excel::download(new PengajuanBarangExport, $date . '_pengajuan.xlsx');
    }

    public function pengajuanPdf()
    {
        $data = PengajuanBarang::all();
        $pdf = PDF::loadView('pengajuan.data', ['pengajuan' => $data]);

        return $pdf->download('pengajuan.pdf');
    }

    public function pengajuanImport()
    {
        Excel::import(new PengajuanBarangImport, request()->file('import'));
        return redirect()->back()->with('success', 'Data Berhasil di Import!!');
    }

    /**
     * Show the form for creating a new resource.   
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengajuanBarangRequest $request)
    {
        $input = $request->all();
        $input['terpenuhi'] = false;
        PengajuanBarang::create($input);
        return redirect('pengajuan')->with('success', 'Data Pengajuan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanBarang $pengajuanBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanBarang $pengajuanBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengajuanBarangRequest $request, PengajuanBarang $pengajuanBarang, $id)
    {
        // dd($request);
        $pengajuanBarang->find($id)->update($request->all());

        return redirect('pengajuan')->with('success', 'Update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanBarang $pengajuanBarang, $id)
    {
        $pengajuanBarang->find($id)->delete();
        return redirect('pengajuan')->with('success', 'Data pengajuan berhasil dihapus!');
    }
}
