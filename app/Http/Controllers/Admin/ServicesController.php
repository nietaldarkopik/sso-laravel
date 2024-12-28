<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\KelurahanModel;
use App\DataTables\KelurahansDataTable;
use App\Models\KabupatenKotaModel;
use App\Models\KecamatanModel;
use DB;

class ServicesController extends Controller
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

    public function getKabupatenKota()
    {
        return KabupatenKotaModel::orderBy('name','asc')->get()->toJson();
    }

    public function getKecamatan($id_kabupatenkota)
    {
        return KecamatanModel::where('regency_id','=',$id_kabupatenkota)->select('districts.*')->orderBy('districts.name','asc')->get()->toJson();
    }

    public function getKelurahan($id_kabupatenkota,$id_kecamatan)
    {
        $q =  KelurahanModel::orderBy('villages.name','asc');
        if(!empty($id_kabupatenkota))
        {
            $q->join('regencies','regencies.id','=','districts.regency_id');
            $q->where('regencies.id','=',$id_kabupatenkota);
        }
        if(!empty($id_kecamatan))
        {
            $q->join('districts','districts.id','=','villages.district_id');
            $q->where('districts.id','=',$id_kecamatan);
        }

        return $q->select('villages.*')->get()->toJson();
    }

}
