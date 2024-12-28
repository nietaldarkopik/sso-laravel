<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\UnitModel;
use App\DataTables\UnitsDataTable;
use App\Models\UnitDokumenModel;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use Str;
use PDF;

class UnitController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        //$this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        //$this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        //$this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        
        $this->middleware('auth');
    }

    public function index(UnitsDataTable $dataTable)
    {
        return $dataTable->render('vendor.adminlte.units.index');
    }

    public function getData(Request $request)
    {
        $units = UnitModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.units.index', compact('units'));
    }

    public function create(Request $request)
    {
        if($request->ajax()){
            return view('vendor.adminlte.units.form-create');
        }else{
            return view('vendor.adminlte.units.create');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code',
            'parent_code',
            'nama',
            'keterangan',
        ]);
        $user_id = Auth::user()->id;
        $dt = [
            'code' => $request->input('code'),
            'parent_code' => $request->input('parent_code'),
            'nama' => $request->input('nama'),
            'keterangan' => $request->input('keterangan'),
        ];

        $unit = UnitModel::create($dt);

        return redirect()->route('admin.unit.index')
            ->with('success', 'Unit berhasil disimpan');
    }

    public function updateSort(Request $request)
    {
		$data = $request->input('data');
		if(is_array($data) and count($data) > 0)
		{
			foreach($data as $i => $d)
			{
				$unit = UnitModel::find($d['id']);
				$unit->parent_code = (empty($d['parent_code']))?null:$d['parent_code'];
				if($d['sort_order'] >= 0)
				{
					$unit->sort_order = $d['sort_order'];
				}
				$unit->save();
			}
		}
        return response()->json(['message' => 'Data berhasil diperbarui!'], 200);
    }

    public function show($id,Request $request)
    {
        $unit = UnitModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.units.form-show', compact('unit'));
        }else{
            return view('vendor.adminlte.units.show', compact('unit'));
        }
    }

    
    public function edit($id,Request $request)
    {
        $unit = UnitModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.units.form-edit', compact('unit'));
        }else{
            return view('vendor.adminlte.units.edit', compact('unit'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code',
            'parent_code',
            'nama',
            'keterangan',
        ]);

        $user_id = Auth::user()->id;

        $unit = UnitModel::find($id);
        UnitModel::where('parent_code',$unit->code)->update(['parent_code' => $request->input('code')]);
        
        $unit->code = $request->input('code');
        $unit->parent_code = (empty($request->input('parent_code')))?null:$request->input('parent_code');
        $unit->nama = $request->input('nama');
        $unit->keterangan = $request->input('keterangan');
        $unit->save();


        return redirect()->route('admin.unit.index')
            ->with('success', 'Unit berhasil diubah');
    }

    public function destroy(UnitModel $unit, Request $request)
    {
        $unit->delete();
        return redirect()->route('admin.unit.index')
            ->with('success', 'Unit telah dihapus');
    }

    public function generateCode(Request $request,$data = 0,$unit_parent = 0)
    {
		if(empty($data))
		{
			UnitModel::whereNotNull('id')->update(['code' => null]);
		}

		$data = (!empty($data))?$data:$request->input('data');

		if(is_array($data) and count($data) > 0)
		{
			foreach($data as $i => $d)
			{
				$unit = UnitModel::find($d['id']);
				$unit->parent_code = (empty($unit_parent))?null:$unit_parent->code;
				$code = (empty($unit->parent_code))?str_pad($i+1,2,'0',STR_PAD_LEFT):$unit->parent_code . str_pad($i+1,2,'0',STR_PAD_LEFT);
				$unit->code = $code;
				$unit->sort_order = $i+1;


				$unit->save();

				if(isset($d['children']) and is_array($d['children']) and count($d['children']) > 0)
				{
					$this->generateCode($request,$d['children'],$unit);
				}
			}
		}
        return response()->json(['message' => 'Data berhasil diperbarui!'], 200);
    }
}
