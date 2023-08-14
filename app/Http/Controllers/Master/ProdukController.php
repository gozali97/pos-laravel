<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDF;

class ProdukController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
        return view('master.produk.index', compact('kategori'));
    }

    public function data()
    {
        $data = Produk::query()
        ->leftJoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
            ->select('produk.*', 'kategori.nama_kategori')
        ->orderBy('id_produk', 'desc')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('select_all', function ($data){
                return '<input type="checkbox" name="id_produk[]" value="'.$data->id_produk.'">';
            })
            ->addColumn('kode_produk', function ($data){
                return '<span class="badge bg-success">'.$data->kode_produk.'</span>';
            })
            ->addColumn('harga_beli', function ($data){
                return 'Rp. '.format_uang($data->harga_beli);
            })
            ->addColumn('harga_jual', function ($data){
                return 'Rp. '.format_uang($data->harga_jual);
            })
            ->addColumn('diskon', function ($data){
                return 'Rp. '.format_uang($data->diskon);
            })
            ->addColumn('Action', function ($data){
                return '
                <div class="d-inline-flex">
                <button type="button" onclick="editForm(`'.route('produk.update', $data->id_produk).'`)" class="justify-content-center w-100 btn me-2 mb-1 btn-rounded btn-warning d-flex align-items-center">
                      <i class="ti ti-edit fs-4 me-2"></i>
                      Edit
                    </button>
                     <button type="button" onclick="deleteData(`'.route('produk.destroy', $data->id_produk).'`)" class="justify-content-center w-100 btn mb-1 btn-rounded btn-danger d-flex align-items-center">
                      <i class="ti ti-trash fs-4 me-2"></i>
                      Delete
                    </button>
                    </div>
                ';
            })
            ->rawColumns(['Action','kode_produk','select_all'])
            ->make(true);

    }
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $lastProduk = Produk::latest()->first();

        if ($lastProduk) {
            $lastKodeProduk = $lastProduk->kode_produk;
            $lastNumber = (int) substr($lastKodeProduk, 2);
            $nextNumber = $lastNumber + 1;
            $kode = 'P' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        } else {
            $kode = 'P00001';
        }

        $data = new Produk;
        $data->nama_produk = $request->nama_produk;
        $data->id_kategori = $request->id_kategori;
        $data->kode_produk = $kode;
        $data->merk = $request->merk;
        $data->harga_beli = $request->harga_beli;
        $data->diskon = $request->diskon;
        $data->harga_jual = $request->harga_jual;
        $data->stok = $request->stok;
        $data->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Produk::where('id_produk', $id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Produk::where('id_produk', $id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Produk::where('id_produk', $id)->first();
        $data->nama_produk = $request->nama_produk;
        $data->id_kategori = $request->id_kategori;
        $data->merk = $request->merk;
        $data->harga_beli = $request->harga_beli;
        $data->diskon = $request->diskon;
        $data->harga_jual = $request->harga_jual;
        $data->stok = $request->stok;
        $data->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Produk::where('id_produk', $id)->first();
        $data->delete();

        return response()->json(null, 204);
    }

    public function deleteSelected(Request $request){
        try {
            foreach ($request->id_produk as $id){
                $data = Produk::where('id_produk', $id)->first();
                $data->delete();
            }
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan hapus semua produk: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function cetakBarcode(Request $request){
        try {
            $dataProduk = [];
            foreach ($request->id_produk as $id){
                $data = Produk::where('id_produk', $id)->first();
                $dataProduk[] = $data;
            }
            $no = 1;
            $pdf = PDF::loadView('master.produk.print', compact('dataProduk', 'no'));
            $pdf->setPaper('a4');
            return $pdf->stream('produk.pdf');
        } catch (\Exception $e) {
//            dd($e);
            Log::error('Terjadi kesalahan cetak barcode produk: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
