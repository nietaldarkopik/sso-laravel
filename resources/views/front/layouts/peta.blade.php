@extends('front.master-front')

@section('content')

<div id="section1" class="section">
    <div class="container-fluid mt-4 text-center p-0 m-0">
        <div class="row p-0 m-0">
            <div id="map" class="col-12 p-0"></div>
        </div>
    </div>
    </button>
</div>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="Id1"
    aria-labelledby="Enable both scrolling & backdrop">
    <div class="offcanvas-header">
        <!-- <h5 class="offcanvas-title" id="Enable both scrolling & backdrop">
            Backdrop with scrolling
        </h5> -->
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- <div class="row">
            <div class="col-md-12 d-flex justify-content-center p-0">
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar">
                    <div class="btn-group" role="group" aria-label="Button Group">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Pencarian">
                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Basemap / Peta dasar">
                            <i class="fa fa-map" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Grafik">
                            <i class="fa fa-chart-pie" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Informasi">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Refresh Peta">
                            <i class="fas fa-sync" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-12 p-0">
                <hr />
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="true"
                                aria-controls="flush-collapseThree">
                                Basemap / Peta Dasar
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="list-group list-group-flush">
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1 basemap-option" type="radio" value="osm"
                                            name="basemap-option" />
                                        OpenStreetMap
                                    </label>
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1 basemap-option" type="radio" value="google1"
                                            name="basemap-option" />
                                        Google Maps 1
                                    </label>
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1 basemap-option" type="radio" value="google2"
                                            name="basemap-option" />
                                        Google Maps 2
                                    </label>
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1 basemap-option" type="radio" value="google3"
                                            name="basemap-option" />
                                        Google Maps 3
                                    </label>
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1 basemap-option" type="radio" value="esri"
                                            name="basemap-option" />
                                        Esri
                                    </label>
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1 basemap-option" type="radio" value="esri_imagery"
                                            name="basemap-option" />
                                        Esri Satelit
                                    </label>
                                    <!-- <label class="list-group-item">
                                        <input class="form-check-input me-1 basemap-option" type="radio" value="cycliosm"
                                            name="basemap-option" />
                                        CycIOSM
                                    </label> -->
                                    <!-- <label class="list-group-item">
                                        <input class="form-check-input me-1 basemap-option" type="radio" value="pastel"
                                            name="basemap-option" />
                                        Pastel
                                    </label> -->
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1 basemap-option" type="radio" value="alidade_smooth_dark"
                                            name="basemap-option" />
                                        Alidade Smooth Dark
                                    </label>
                                    <!-- <label class="list-group-item">
                                        <input class="form-check-input me-1 basemap-option" type="radio" value="maptiler"
                                            name="basemap-option" />
                                        Map Tiler
                                    </label> -->
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="true"
                                aria-controls="flush-collapseTwo">
                                Layers / Lapisan
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <!-- <div class="list-group list-group-flush" id="layer-container-list-group">
                                </div> -->
                                <div class="row">
                                    <div class="col-12" id="layer-container">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="true"
                                aria-controls="flush-collapseOne">
                                Filter Data
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form>
                                    <div class="form-group mb-3">
                                        <label for="layer">Kabupaten / Kota:</label>
                                        <select class="form-control" id="layer">
                                            <option value="layer1">Layer 1</option>
                                            <option value="layer2">Layer 2</option>
                                            <option value="layer3">Layer 3</option>
                                            <!-- Tambahkan opsi lainnya sesuai dengan kebutuhan -->
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="layer">PSU:</label>
                                        <select class="form-control" id="layer">
                                            <option value="layer1">Layer 1</option>
                                            <option value="layer2">Layer 2</option>
                                            <option value="layer3">Layer 3</option>
                                            <!-- Tambahkan opsi lainnya sesuai dengan kebutuhan -->
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Pencarian</label>
                                        <input type="text" name="" id="" class="form-control" placeholder=""
                                            aria-describedby="helpId" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <button class="btn btn-primary zIndex4 visible position-absolute top-50 start-100 left-auto ms-2 me-auto"
            type="button" data-bs-toggle="offcanvas" data-bs-target="#Id1" aria-controls="Id1">
            <i class="fa fa-caret-right" aria-hidden="true"></i>
    </div>
</div>

<div id="popup" class="card ol-popup p-0" hidden="true">
    <div class="card-header">
        <button type="button" id="popup-closer" class="btn float-end btn-danger btn-sm ol-popup-closer close"
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="card-body" id="popup-content" style="max-height: 300px; overflow: auto;">

    </div>
</div>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
    Launch
</button> -->

<!-- Modal -->
<div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true"
    data-bs-backdrop="false" data-bs-show="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Modal title
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header p-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 p-0">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-0 active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">
                                        Home
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-0" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false">
                                        Profile
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-0" id="messages-tab" data-bs-toggle="tab"
                                        data-bs-target="#messages" type="button" role="tab" aria-controls="messages"
                                        aria-selected="false">
                                        Messages
                                    </button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <!--  <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    home
                                </div>
                                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    profile
                                </div>
                                <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                    messages
                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    var modalId = document.getElementById('modalId');

    modalId.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });
</script>


@include("partials/foot-script")

<link rel="stylesheet" href="map/style.css" />
<style>
    .ol-popup {
        position: absolute;
        background-color: white;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #cccccc;
        bottom: 12px;
        left: -50px;
        min-width: 480px;
    }

    .ol-popup:after,
    .ol-popup:before {
        top: 100%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }

    /* .ol-popup:after {
      border-top-color: white;
      border-width: 10px;
      left: 48px;
      margin-left: -10px;
    }
    .ol-popup:before {
      border-top-color: #cccccc;
      border-width: 11px;
      left: 48px;
      margin-left: -11px;
    }
    .ol-popup-closer {
      text-decoration: none;
      position: absolute;
      top: 2px;
      right: 8px;
    }
    .ol-popup-closer:after {
      content: "✖";
    } */
</style>
<style>
    #filter-form {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1000;
        background-color: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.5);
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="./assets/vendor/openlayers/build/full/ol.js"></script>
<script src="./assets/js/peta-v2.js"></script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>

<script>
    $(document).ready(function () {
        $('.modal-dialog').draggable({
            handle: ".modal-header"
        });
    })
</script>
@endsection