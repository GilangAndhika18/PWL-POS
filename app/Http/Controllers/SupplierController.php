<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object) [
            'title' => 'Daftar supplier yang terdaftar dalam sistem'
        ];

        $activeMenu = 'supplier'; // set menu yang sedang aktif


        return view('supplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $supplier = SupplierModel::select('id', 'kode_supplier', 'nama_supplier', 'telepon', 'alamat');
        

        return DataTables::of($supplier)
        // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($supplier) { // menambahkan kolom aksi
            $btn = '<a href="'.url('/supplier/' . $supplier->id).'" class="btn btn-info btn-sm">Detail</a> ';
        //     $btn .= '<a href="'.url('/supplier/' . $supplier->id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
        //     $btn .= '<form class="d-inline-block" method="POST" action="'. url('/supplier/'.$supplier->id).'">'
        //         . csrf_field() . method_field('DELETE') .
        //         '<button type="submit" class="btn btn-danger btn-sm" onclick="return
        // confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';

            // $btn = '<button onclick="modalAction(\''.url('/supplier/' . $supplier->id .
                // '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/supplier/' . $supplier->id .
                '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/supplier/' . $supplier->id .
                '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';

            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah supplier baru'
        ];

        $activeMenu = 'supplier';
        
        return view('supplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store (Request $request)
    {
        $request->validate([
            'kode_supplier'   => 'required|string|max:20|unique:m_supplier,kode_supplier',
            'nama_supplier'   => 'required|string|max:100',
            'telepon'         => 'nullable|string|max:20',
            'alamat'          => 'nullable|string',

        ]);

        SupplierModel::create([
            'kode_supplier'   => $request->kode_supplier,
            'nama_supplier'   => $request->nama_supplier,
            'telepon'         => $request->telepon,
            'alamat'          => $request->alamat,

        ]);

        return redirect('/supplier')->with('success', 'Data supplier berhasil disimpan');
    }

    public function show(string $id)
    {
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Supplier',
            'list' => ['Home', 'Supplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier ,'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        $supplier = SupplierModel::find($id);
        
        $breadcrumb = (object)[
            'title' => 'Edit Supplier',
            'list' => ['Home', 'Supplier', "Edit"]
        ];
        $page = (object)[
            'title' => "Edit supplier"
        ];
        $activeMenu = 'supplier'; // set menu yang sedang aktif
        return view('supplier.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_supplier'   => 'required|string|max:20|unique:m_supplier,kode_supplier',
            'nama_supplier'   => 'required|string|max:100',
            'telepon'         => 'nullable|string|max:20',
            'alamat'          => 'nullable|string',
        ]);

        SupplierModel::find($id)->update([
            'kode_supplier'   => $request->kode_supplier,
            'nama_supplier'   => $request->nama_supplier,
            'telepon'         => $request->telepon,
            'alamat'          => $request->alamat,
        ]);

        return redirect('/supplier')->with("success", "Data supplier berhasil diubah");
    }

    // Menghapus data user
    public function destroy(string $id)
    {
        $check = SupplierModel::find($id);
        if (!$check) { // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/supplier')->with('error', 'Data level tidak ditemukan');
        }

        try {
            SupplierModel::destroy($id); // Hapus data level
            return redirect('/supplier')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $se) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/supplier')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }


    public function create_ajax()
    {
        return view('supplier.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_supplier' => 'required|string|min:1|unique:m_supplier,kode_supplier',
                'nama_supplier' => 'required|string|max:100',
                'telepon'         => 'nullable|string|max:20',
                'alamat' => 'required|string'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // pesan error validasi
                ]);
            }

            SupplierModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data supplier berhasil disimpan'
            ]);
        }

        redirect('/');
    }


    public function edit_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.edit_ajax', ['supplier' => $supplier]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_supplier' => ['required', 'string', 'min:3', 'unique:m_supplier,kode_supplier,' . $id . ',id'],
                'nama_supplier' => 'required|string|max:100',
                'telepon'         => 'nullable|string|max:20',
                'alamat' => 'required|string'
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,    // respon json, true: berhasil, false: gagal 'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }

            $check = SupplierModel::find($id);
            if ($check) {

                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);

        return view('supplier.confirm_ajax', ['supplier' => $supplier]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $supplier = SupplierModel::find($id);
            if ($supplier) {
                $supplier->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }
}
