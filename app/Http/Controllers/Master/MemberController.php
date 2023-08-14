<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Member;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function index()
    {
        return view('master.member.index');
    }

    public function data()
    {
        $data = Member::query()
            ->orderBy('id_member', 'desc')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('select_all', function ($data){
                return '<input type="checkbox" name="id_member[]" value="'.$data->id_member.'">';
            })
            ->addColumn('kode_member', function ($data){
                return '<span class="badge bg-success">'.$data->kode_member.'</span>';
            })
            ->addColumn('Action', function ($data){
                return '
                <div class="d-inline-flex">
                <button type="button" onclick="editForm(`'.route('member.update', $data->id_member).'`)" class="justify-content-center w-100 btn me-2 mb-1 btn-rounded btn-warning d-flex align-items-center">
                      <i class="ti ti-edit fs-4 me-2"></i>
                      Edit
                    </button>
                     <button type="button" onclick="deleteData(`'.route('member.destroy', $data->id_member).'`)" class="justify-content-center w-100 btn mb-1 btn-rounded btn-danger d-flex align-items-center">
                      <i class="ti ti-trash fs-4 me-2"></i>
                      Delete
                    </button>
                    </div>
                ';
            })
            ->rawColumns(['Action','kode_member','select_all'])
            ->make(true);

    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lastMember = Member::latest()->first();

        if ($lastMember) {
            $lastKodemember = $lastMember->kode_member;
            $lastNumber = (int) substr($lastKodemember, 2);
            $nextNumber = $lastNumber + 1;
            $kode = 'M' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        } else {
            $kode = 'M00001';
        }

        $data = new Member;
        $data->kode_member= $kode;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->telepon = $request->telepon;
        $data->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Member::where('id_member', $id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Member::where('id_member', $id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Member::where('id_member', $id)->first();
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->telepon = $request->telepon;
        $data->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Member::where('id_member', $id)->first();
        $data->delete();

        return response()->json(null, 204);
    }

    public function deleteSelected(Request $request){
        try {
            foreach ($request->id_produk as $id){
                $data = Member::where('id_member', $id)->first();
                $data->delete();
            }
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan hapus semua member: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function cetakMember(Request $request){
        try {
            $dataMember = collect([]);
            foreach ($request->id_member as $id){
                $data = Member::where('id_member', $id)->first();
                $dataMember[] = $data;
            }

            $dataMember = $dataMember->chunk(2);
            $no = 1;
            $pdf = PDF::loadView('master.member.print', compact('dataMember', 'no'));
            $pdf->setPaper('a4');
            return $pdf->stream('member.pdf');
        } catch (\Exception $e) {

            Log::error('Terjadi kesalahan cetak barcode produk: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
