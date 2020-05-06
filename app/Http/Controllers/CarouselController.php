<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carousel;
use DataTables;
use Validator;
use Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Carousel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('carousel',function($data){
                    return '<a href="'.asset('uploads/'.$data->carousel).'" target="_blank"><img src="'.asset('uploads/'.$data->carousel).'" class="img-thumbnail rounded mx-auto d-block h-25" alt="Responsive image"></a>';
                })
                ->editColumn('status',function($data){
                    if ($data->status == 'Ditampilkan') {
                        $badge = '<h4><span class="badge badge-success">Ditampilkan</span></h4>';
                    }else{
                        $badge = '<h4><span class="badge badge-warning">Disembunyikan</span></h4>';
                    }
                    return $badge;
                })
                ->addColumn('action',function($data){
                    $button = '<a href="'.route('carousel.edit',$data->kd_carousel).'" class="btn btn-info text-white"><i class="fa fa-edit"></i></a>&nbsp;';
                    $button .= '<button class="btn btn-danger" onclick="deleteCarousel(\''.csrf_token().'\','.$data->kd_carousel.')" ><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action','status','carousel'])
                ->make(true);
        }
        return view('carousel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function unique_code($limit)
    {
      return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $uid = strtolower($this->unique_code(9));

        $validasi = Validator::make($data,[
            'keterangan'=>'required',
            'status'=>'required',
            'carousel'=>'required|mimes:jpeg,jpg,png,mp4,mov,ogg,mkv|max:20000'
        ]);

        if ($validasi->fails())
        {
            return redirect()->route('carousel.create')->withErrors($validasi)->withInput();
        }

        $thumbnail = $request->file('carousel');
        $extention = $thumbnail->getClientOriginalExtension();

        if ($request->file('carousel')->isValid())
        {
            $namaFoto = "carousel/".$uid.'.'.$extention;
            $uploadPath = 'public/uploads/carousel';
            $request->file('carousel')->move($uploadPath,$namaFoto);
            $data['carousel'] = $namaFoto;
        }

        Carousel::create($data);

        return redirect()->route('carousel.index')->with('status','Menambahkan Berita Baru');
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
        $carousel = Carousel::findOrFail($id);
        return view('carousel.edit',compact('carousel'));
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
        $carousel = Carousel::findOrFail($id);
        $data = $request->all();
        $uid = strtolower($this->unique_code(9));

        $validasi = Validator::make($data,[
            'keterangan'=>'required',
            'status'=>'required',
            'carousel'=>'sometimes|nullable|mimes:jpeg,jpg,png,mp4,mov,ogg,mkv|max:20000'
        ]);

        if ($validasi->fails())
        {
            return redirect()->route('carousel.edit',[$id])->withErrors($validasi);
        }

        if ($request->hasFile('carousel')) {
            if ($request->file('carousel')->isValid()) {
                Storage::disk('upload')->delete($carousel->carousel);

                $gambar = $request->file('carousel');
                $extention = $gambar->getClientOriginalExtension();

                $namaFoto = "carousel/".$uid.'.'.$extention;
                $uploadPath = 'public/uploads/carousel';
                $request->file('carousel')->move($uploadPath,$namaFoto);
                $data['carousel'] = $namaFoto;
            }
        }

        $carousel->update($data);

        return redirect()->route('carousel.index')->with('status','Memperbaharui Data Carousel!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Carousel::findOrFail($id);
        Storage::disk('upload')->delete($data->carousel);
        $data->delete($data);
        return response()->json([
            'message' => 'Carousel Berhasil Dihapus!'
        ]);
    }
}
