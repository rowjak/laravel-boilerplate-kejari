<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Storage;
use DataTables;
use App\RunningText;

class RunningTextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RunningText::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($data){
                    if ($data->status == 'Ditampilkan') {
                        $badge = '<h4><span class="badge badge-success">Ditampilkan</span></h4>';
                    }else{
                        $badge = '<h4><span class="badge badge-warning">Disembunyikan</span></h4>';
                    }
                    return $badge;
                })
                ->addColumn('action',function($data){
                    $button = '<button class="btn btn-info" onclick="ubahRunningtext('.$data->kd_running_text.')" ><i class="fa fa-edit"></i></button>&nbsp;';
                    $button .= '<button class="btn btn-danger" onclick="deleteRunningtext(\''.csrf_token().'\','.$data->kd_running_text.')" ><i class="fa fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('runningtext.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validasi = Validator::make($data,[
            'text' => 'required',
            'status'=>'required'
        ]);

        if ($validasi->fails())
        {
            $error = '';

            foreach($validasi->errors()->all() as $row){
                $error .= '<li>'.$row.'</li>';
            }

            return response()->json([
                'status' => false,
                'message' => '<div class="alert alert-danger" role="alert">
                <div class="alert-message">
                    '.$error.'
                </div>
            </div>'
            ],200);
        }

        RunningText::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Disimpan!'
        ],200);
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
        $runningtext = RunningText::findOrFail($id);
        return response()->json($runningtext,200);
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
        $runningtext = RunningText::findOrFail($id);
        $data = $request->all();

        $validasi = Validator::make($data,[
            'text' => 'required',
            'status'=>'required'
        ]);

        if ($validasi->fails())
        {
            $error = '';

            foreach($validasi->errors()->all() as $row){
                $error .= '<li>'.$row.'</li>';
            }

            return response()->json([
                'status' => false,
                'message' => '<div class="alert alert-danger" role="alert">
                <div class="alert-message">
                    '.$error.'
                </div>
            </div>'
            ],200);
        }

        $runningtext->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Diperbarui!'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RunningText::findOrFail($id);
        $data->delete($data);
        return response()->json([
            'message' => 'Running Text Berhasil Dihapus!'
        ]);
    }
}
