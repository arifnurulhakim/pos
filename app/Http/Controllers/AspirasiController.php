<?php

namespace App\Http\Controllers;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as ImageManager;


class AspirasiController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aspirasi = Aspirasi::all();
        return view('aspirasi.index', [
            'aspirasi' => $aspirasi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aspirasi.create');
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nim' => 'required',
    //         'aspirasi' => 'required',
    //         'kategori' => 'required',
    //         'status' => 'in:pending,accept,done',
    //         'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);
  
    //     $input = $request->all();
    //     dd($input);
    //     if ($image = $request->file('images')) {
    //         $destinationPath = 'images/';
    //         $Images = date('YmdHis') . "." . $image->getClientOriginalExtension();
    //         $image->move($destinationPath, $Image);
    //         $input['images'] = "$Image";
    //     }
    
    //     Aspirasi::create($input);
     
    //     return redirect()->route('index')->with('success_message', 'Berhasil menambah aspirasi baru');
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        $rules=[
            'nim' => 'required',
            'aspirasi' => 'required',
            'kategori' => 'required',
            'status' => 'in:pending,accept,done',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return redirect()->back()
                ->withInput($request->all)
                ->withErrors($validator);
        } else{
            $aspirasi = new Aspirasi();
            $aspirasi -> nim = $request->input('nim');
            $aspirasi -> aspirasi = $request->input('aspirasi');
            $aspirasi -> kategori = $request->input('kategori');
            $aspirasi -> status = $request->input('status');
            

            if ($request->hasFile('images')) {
                $path = $request->file('images')->store('images');
                dd($path);
                $gambar_aspirasi = ImageManager::make('storage/images/'.$path);
                $gambar_aspirasi->fit(1200, 500);
                $gambar_aspirasi->save(storage_path().'/app/public/images/'.$path);
                $aspirasi->gambar = $path;
            }

            
            $aspirasi->save();
            return redirect()->route('index')
            ->with('success_message', 'Berhasil menambah aspirasi baru');
        }
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
        $aspirasi = Aspirasi::find($id);
        if (!$aspirasi) return redirect()->route('aspirasi.index')
            ->with('error_message', 'aspirasi tidak ditemukan');
        return view('users.edit', [
            'user' => $aspirasi
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
        $aspirasi = Aspirasi::find($id);
        $rules=[
            'nim' => 'required',
            'aspirasi' => 'required',
            'kategori' => 'required|in:akademi,minat bakat, fasilitas, ormawa, dll',
            'status' => 'in:pending,accept,done',
        ];
        
        if (!empty($request->input('gambar'))) {
            $rules['gambar'] = 'mimes:jpeg,jpg,png,JPG,JPEG,PNG';
        }
       
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return redirect()->back()
                ->withInput($request->all)
                ->withErrors($validator)
                ->with('aspirasi', $aspirasi);
        } else{
            $aspirasi = Aspirasi::find($id);
            $aspirasi -> nim = $request->input('nim');
            $aspirasi -> aspirasi = $request->input('aspirasi');
            $aspirasi -> kategori = $request->input('kategori');
            $aspirasi -> status = $request->input('status');

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('','gambar');
                $gambar_aspirasi = ImageManager::make('storage/gambar/'.$path);
                $gambar_aspirasi->fit(1200, 500);
                $gambar_aspirasi->save(storage_path().'/app/public/gambar/'.$path);
                $aspirasi->gambar = $path;
            }

            $aspirasi->save();
            return redirect()->route('index')
            ->with('success_message', 'Berhasil menambah aspirasi baru');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $aspirasi = Aspirasi::find($id);
        if ($aspirasi->delete()){
            Storage::delete('public/gambar/'.$aspirasi->gambar);
            return redirect()->route('aspirasi.index')
            ->with('success_message', 'Berhasil menghapus aspirasi');
        }
            
    }
}
