@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.unit.update', ['unit' => $unit]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("patch")
    <div class="row mb-1">
        <div class="col-xs-12 col-sm-12 border">
            <div class="row">
                <div class="col-sm-4 p-0 bg-secondary text-white px-1 d-flex justify-content-start align-items-center">
                    <div class="form-group mb-0">
                        <span>Kode</span>
                    </div>
                </div>
                <div class="col-sm-8 p-1">
                    <input required="required" type="text" name="code" value="{{ $unit?->code }}" maxlength="20"
                        class="form-control border-warning border py-0 text-italic rounded-0 form-control-sm"
                        placeholder="Kode" />
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mb-1">
        <div class="col-xs-12 col-sm-12 border">
            <div class="row">
                <div class="col-sm-4 p-0 bg-secondary text-white px-1 d-flex justify-content-start align-items-center">
                    <div class="form-group mb-0">
                        <span>Nama Unit</span>
                    </div>
                </div>
                <div class="col-sm-8 p-1">
                    <input required="required" type="text" name="nama" value="{{ $unit?->nama }}"
                        class="form-control border-warning border py-0 text-italic rounded-0 form-control-sm"
                        placeholder="Nama Unit" />
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-xs-12 col-sm-12 border">
            <div class="row">
                <div class="col-sm-4 p-0 bg-secondary text-white px-1 d-flex justify-content-start align-items-center">
                    <div class="form-group mb-0">
                        <span>Induk Unit</span>
                    </div>
                </div>
                <div class="col-sm-8 p-1">
                    <select class="form-select form-control border-warning border py-0 text-italic rounded-0 form-control-sm"
                        name="parent_code">
                        <option value="0">Utama ...</option>
                        @foreach(\App\Models\UnitModel::orderBy('code')->where('id','!=',$unit?->id)->get() as $i => $d)
                        <option value="{{ $d->code }}" @selected($d->code == $unit->parent_code)>{{ $d->code . ' - ' . $d->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-xs-12 col-sm-12 border">
            <div class="row">
                <div class="col-sm-12 p-0 bg-secondary text-white px-1 d-flex justify-content-start align-items-center">
                    <div class="form-group mb-0">
                        <span>Keterangan</span>
                    </div>
                </div>
                <div class="col-sm-12 p-1">
                    <textarea name="keterangan" rows="6"
                        class="form-control border-warning border py-0 text-italic rounded-0 form-control-sm"
                        placeholder="Keterangan">{{ $unit?->keterangan }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-1 g-1">
        <div class="col-xs-12 mb-3 text-center">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save" aria-hidden="true"></i>
                Simpan
            </button>
        </div>
    </div>
</form>
