<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.pengajuan.uploadDokumen', ['perumahan' => $perumahan]) }}"
                method="POST" enctype="multipart/form-data">
                <div class="card text-left card-primary card-ourline border border-primary card-psu-list">
                    <div class="card-header">
                        <h4 class="card-title">Upload Data Dokumen</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="document-dropzone-{{ $perumahan->id }}">Upload File Pendukung</label>
                                    <div class="needsclick dropzone dropzone-document dropzonePsu"
                                        id="document-dropzone-{{ $perumahan->id }}">
                                        <input type="hidden" class="input-id_perumahan"
                                        name="id_perumahan"
                                        value="{{ $perumahan->id }}" placeholder="Perumahan" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="card card-primary border-primary">
                                    <div class="card-header">
                                        <h4 class="card-title">Daftar File</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Silahkan upload file pendukung lainnya seperti BAST, Siteplan, Hasil Survey dan file lainnya berupa jpg, jpeg, png, pdf, doc, xls atau zip .</p>
                                        <ul class="list-group list-group-flush file-list-dokumen">
                                            @foreach (\App\Models\PerumahanDokumenModel::where('id_perumahan','=',$perumahan->id)->get() as $i => $f)
                                                <li class="list-group-item row d-flex">
                                                    <div class="col-sm-5">
                                                        {{ basename($f->nama_file) }}
                                                    </div>
                                                    <div class="col-sm-5">
                                                        {{ $f->judul_file }}
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <a href="{{ asset(Storage::url($f->nama_file)) }}" target="_blank" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- psuperumahan.storeFromPerumahan
['perumahan' => $perumahanpsuperumahan.updateFromPerumahan
psuperumahan.destroyFromPerumahan --}}

<script>

    var uploadedDocumentDokumen = {}
    const dropzone = new Dropzone("div.my-dropzone", {
        url: '{{ route('admin.pengajuan.uploadDokumen', ['perumahan' => $perumahan]) }}',
        maxFilesize: 512, // MB
        dataType: "json",
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        sending: function(file, xhr, formData) {
            //console.log(file, xhr, formData, $(this));
            var form = $(this)[0].clickableElements[0];
            formData.append("id_perumahan", $(form).find('.input-id_perumahan').val());
        },
        success: function(file, response) {
            var form = $(this)[0].clickableElements[0];
            $(form).append('<input type="hidden" name="document[]" value="' + response.nama_file + '">');
            uploadedDocumentDokumen[file.name] = response.nama_file;
            this.removeFile(file);
            addFileToListDokumen(file,$(this)[0].clickableElements,response);
        },
        queuecomplete: function () {
            // Event ini dipanggil ketika semua file dalam antrian selesai diupload
            // Optional: Membersihkan semua preview (ini mencakup file yang gagal diupload)
            this.removeAllFiles(true);
        },
        error: function(file, response) {
            var form = $(this)[0].clickableElements[0];
            $(form).append('<input type="hidden" name="document[]" value="' + response.name + '">')
            //uploadedDocumentDokumen[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentDokumen[file.name]
            }
            var form = $(this)[0].clickableElements[0];
            $(form).find('input[name="document[]"][value="' + name + '"]').remove()
        },
        init: function(e) {
            var clickableElements = $(this)[0].clickableElements;
            /* this.on("success", function (file, response) {
                // Setelah upload berhasil, tambahkan file ke daftar
            }); */
            //console.log(clickableElements);
            {{-- @if (isset($psuperumahan) && $psuperumahan->document)
                var files =
                    {!! json_encode($psuperumahan) !!};
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    var form = $(this)[0].clickableElements[0];
                    $(form).append('<input type="hidden" name="document[]" value="' + file.file_name +
                        '">')
                }
            @endif --}}
        }
    });

</script>