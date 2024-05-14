<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Lookup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd('hello world'); //contoh echo
        //query dalam laravel
        $app = App::with(['getPosition'])->latest()->get(); //with digunakan utk relationship
        //dd($app); //dd fungsi sama dengan echo
        return view('pendaftaran.index', ['app' => $app]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lookup = Lookup::all(); //select * from tbl_lookup
        //return view('pendaftaran.create');
        return view('pendaftaran.create', ['lookup' => $lookup]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            "name" => 'required',
            "new_file_no" => 'required',
            "other_file_no" => 'required',
            "nokp" => 'required',
            "old_kp" => 'required',
            "dob" => 'required',
            "position_category_id" => 'required',
            "file_date" => 'required',
            "location" => 'required',
        ],[
            'name.required' => 'Medan nama diperlukan.',
            'new_file_no.required' => 'Medan nombor fail baru diperlukan.',
            'other_file_no.required' => 'Medan nombor fail lain diperlukan.',
            'nokp.required' => 'Medan NoKp diperlukan.',
            'old_kp.required' => 'Medan NoKp lama diperlukan.',
            'dob.required' => 'Medan tarikh lahir diperlukan.',
            'position_category_id.required' => 'Medan kategori jawatan diperlukan.',
            'file_date.required' => 'Medan tarikh fail diperlukan.',
            'location.required' => 'Medan lokasi diperlukan.',
        ]);


        $model = new App();
        
        $file_date =  Carbon::createFromFormat('d/m/Y H:i:s',  $request->input('file_date') . ' 00:00:00');
        $dob =  Carbon::createFromFormat('d/m/Y H:i:s',  $request->input('file_date') . ' 00:00:00');
        
        $model->name = $request->input('name'); 
        $model->new_file_no = $request->input('new_file_no'); 
        $model->other_file_no = $request->input('other_file_no'); 
        $model->nokp = $request->input('nokp'); 
        $model->old_kp = $request->input('old_kp');
        $model->position_category_id = $request->input('position_category_id'); 
        $model->file_date = $file_date;
        $model->location = $request->input('location');
        $model->dob = $dob;
        $model->status = 1; //'I'
        $model->reg_status = 1; //'M'
        $model->active = 1; // 'Aktif'
        
        $model->save();

        return redirect()->route('anggota-perkhidmatan.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //dd ($id);
        $data = App::where('id', $id)->first();
        $lookup = Lookup::all(); // select * from tbl_lookup

        return view('pendaftaran.edit', ['lookup' => $lookup, 'record' => $data]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            "name" => 'required',
            "new_file_no" => 'required',
            "other_file_no" => 'required',
            "nokp" => 'required',
            "old_kp" => 'required',
            "dob" => 'required',
            "position_category_id" => 'required',
            "file_date" => 'required',
            "location" => 'required',
        ],[
            'name.required' => 'Medan nama diperlukan.',
            'new_file_no.required' => 'Medan nombor fail baru diperlukan.',
            'other_file_no.required' => 'Medan nombor fail lain diperlukan.',
            'nokp.required' => 'Medan NoKp diperlukan.',
            'old_kp.required' => 'Medan NoKp lama diperlukan.',
            'dob.required' => 'Medan tarikh lahir diperlukan.',
            'position_category_id.required' => 'Medan kategori jawatan diperlukan.',
            'file_date.required' => 'Medan tarikh fail diperlukan.',
            'location.required' => 'Medan lokasi diperlukan.',
        ]);


        $model = App::find($id);
        
        $dob = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('dob') . ' 00:00:00');
        
        $model->name = $request->input('name'); 
        $model->new_file_no = $request->input('new_file_no'); 
        $model->other_file_no = $request->input('other_file_no'); 
        $model->nokp = $request->input('nokp'); 
        $model->old_kp = $request->input('old_kp');
        $model->position_category_id = $request->input('position_category_id'); 
        $model->location = $request->input('location');
        $model->dob = $dob;
        $model->status = 1; //'I'
        $model->reg_status = 1; //'M'
        $model->active = 1; // 'Aftif'
        
        $model->update();

        return redirect()->route('anggota-perkhidmatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    
        //dd($id);
        {
            $model = App::find($id);
            $model->delete();

            return redirect()->route('anggota-perkhidmatan.index');
        }

        public function eksport()
                
        {
        $products = App::with(['getPosition'])->get();
        $csvFileName = 'app.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, [
            'Nama', 
            'No Fail', 
            'No Fail Lain',
            'NoKp',
            'NoKp Lama',
            'Jawatan',
            'Tarikh Lahir'
        ]); // Add more headers as needed

        foreach ($products as $app) {
            
            fputcsv($handle, [
                $app->name, 
                $app->new_file_no,
                $app->other_file_no,
                $app->nokp,
                $app->old_kp,
                $app->getPosition->value,
                $app->dob,
            ]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
