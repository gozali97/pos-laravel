<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    public function index()
    {
        return view('master.supplier.index');
    }

    public function data()
    {
        $data = Supplier::query()
            ->orderBy('id_supplier', 'desc')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('select_all', function ($data){
                return '<input type="checkbox" name="id_supplier[]" value="'.$data->id_supplier.'">';
            })
            ->addColumn('Action', function ($data){
                return '
                <div class="d-inline-flex">
                <button type="button" onclick="editForm(`'.route('supplier.update', $data->id_supplier).'`)" class="justify-content-center w-100 btn me-2 mb-1 btn-rounded btn-warning d-flex align-items-center">
                      <i class="ti ti-edit fs-4 me-2"></i>
                      Edit
                    </button>
                     <button type="button" onclick="deleteData(`'.route('supplier.destroy', $data->id_supplier).'`)" class="justify-content-center w-100 btn mb-1 btn-rounded btn-danger d-flex align-items-center">
                      <i class="ti ti-trash fs-4 me-2"></i>
                      Delete
                    </button>
                    </div>
                ';
            })
            ->rawColumns(['Action','select_all'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = new Supplier;
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            $data->telepon = $request->telepon;
            $data->save();

            return response()->json('Data berhasil disimpan', 200);

        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan menambah supplier: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Supplier::where('id_supplier', $id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Supplier::where('id_supplier', $id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Supplier::where('id_supplier', $id)->first();
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->telepon = $request->telepon;
        $data->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function destroy(string $id)
    {
        $data = Supplier::where('id_supplier', $id)->first();
        $data->delete();

        return response()->json(null, 204);
    }

    public function deleteSelected(Request $request){
        try {
            foreach ($request->id_produk as $id){
                $data = Supplier::where('id_supplier', $id)->first();
                $data->delete();
            }
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan hapus semua member: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
