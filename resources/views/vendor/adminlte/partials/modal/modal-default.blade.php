<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#{{$modalId ?? 'modalId'}}">
  Launch
</button> --}}

<!-- Modal -->
<div class="modal fade" id="{{ $modalId ?? 'modalId' }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog {{ $modalSize ?? '' }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle ?? '' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $modalContent ?? '' }}
            </div>
            @if($modalFooter)
            <div class="modal-footer">
                {{ $modalFooter ?? '' }}
            </div>
            @endif
        </div>
    </div>
</div>

@push('js')
    <script>
        $('#{{ $modalId ?? "modalId" }}').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modalTitle = $(button).data("modal-title");
            var modalSize = $(button).data("modal-size");
            var modal = $(this);
            var action_url = $(button).attr("href");
            
            if(!modalSize){
                $('#{{ $modalId ?? "modalId" }}').find(".modal-dialog").removeClass("modal-xl").removeClass("modal-lg").removeClass("modal-sm").removeClass("modal-fullscreen").addClass('modal-lg');
            }else{
                $('#{{ $modalId ?? "modalId" }}').find(".modal-dialog").removeClass("modal-xl").removeClass("modal-lg").removeClass("modal-sm").removeClass("modal-fullscreen").addClass(modalSize);
            }

            $('#{{ $modalId ?? "modalId" }}').find(".modal-title").html(modalTitle);
            $('#{{ $modalId ?? "modalId" }}').find(".modal-body").html('<div class="row"><div class="col-12 p-5 text-center"><img src="http://localhost/si-psu-new/public/vendor/adminlte/dist/img/logo-sipsu-kalsel.png" class="img-circle animation__shake" alt="AdminLTE Preloader Image" width="60" height="60" style="animation-iteration-count: infinite; "></div></div>');

            $.get(action_url,function(msg){
                $('#{{ $modalId ?? "modalId" }}').find(".modal-body").html($(msg));
            })
            // Use above variables to manipulate the DOM
        });
    </script>
@endpush
