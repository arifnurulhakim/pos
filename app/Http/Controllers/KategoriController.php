<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'image' => 'image|max:2048'
        ]);
    
        $image = $request->file('image');
    
        // Mengambil nama file asli
        $nama_file = $image->getClientOriginalName();
    
        // Mengambil ekstensi file
        $ekstensi_file = $image->getClientOriginalExtension();
    
        // Membuat nama file unik
        $nama_file_unik = uniqid() . '.' . $ekstensi_file;
    
        // Menyimpan file ke folder public/images
        $image->move(public_path('images'), $nama_file_unik);
    
        $array = $request->only([
            'nama_kategori',
        ]);
        $array['image'] = $nama_file_unik;
    
        $kategori = Kategori::create($array);
        return redirect()->route('kategori.index')
            ->with('success_message', 'Berhasil menambah kategori baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        if (!$kategori) return redirect()->route('kategori.index')
            ->with('error_message', 'Kategori tidak ditemukan');
        return view('kategori.edit', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        if ($request->hasFile('image')) {
            $image = base64_encode(file_get_contents($request->file('image')));
            $kategori->image = $image;
        }
        $kategori->save();
        return redirect()->route('kategori.index')
            ->with('success_message', 'Berhasil mengubah data kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        if ($kategori) $kategori->delete();
        return redirect()->route('kategori.index')
            ->with('success_message', 'Berhasil menghapus kategori');
    }
}
