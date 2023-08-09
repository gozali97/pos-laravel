<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index()
    {
        return view('master.kategori.index');
    }

    public function data()
    {
        $data = Kategori::orderBy('id_kategori', 'desc')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('Action', function ($data){
                return '
                <div class="d-inline-flex">
                <button type="button" onclick="editForm(`'.route('kategori.update', $data->id_kategori).'`)" class="justify-content-center w-100 btn me-2 mb-1 btn-rounded btn-warning d-flex align-items-center">
                      <i class="ti ti-edit fs-4 me-2"></i>
                      Edit
                    </button>
                     <button type="button" onclick="deleteData(`'.route('kategori.destroy', $data->id_kategori).'`)" class="justify-content-center w-100 btn mb-1 btn-rounded btn-danger d-flex align-items-center">
                      <i class="ti ti-trash fs-4 me-2"></i>
                      Delete
                    </button>
                    </div>
                ';
            })
            ->rawColumns(['Action'])
            ->make(true);

    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = new Kategori;
        $data->nama_kategori = $request->nama_kategori;
        $data->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Kategori::where('id_kategori', $id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Kategori::where('id_kategori', $id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Kategori::where('id_kategori', $id)->first();
        $data->nama_kategori = $request->nama_kategori;
        $data->save();

        return response()->json('Data berhasil diubah', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kategori::where('id_kategori', $id)->first();
        $data->delete();

        return response()->json(null, 204);
    }
}
