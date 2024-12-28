var ArrLayers = [];
var map;
var popupContent = document.getElementById('popup-content');
var popupCloser = document.getElementById('popup-closer');


// Function to fetch layer list from GeoServer
function fetchGeoServerLayers(callback) {
	var url = 'http://localhost:8081/geoserver/rest/layers.json';
	fetch(url, {
		//credentials: 'include', // Use credentials
		headers: {
			'Authorization': 'Basic ' + btoa('admin:geoserver')
		}
	})
		.then(response => response.json())
		.then(data => {
			var layers = data.layers.layer.map(layer => layer.name);
			callback(layers);
		});
}

// Function to fetch layer list from GeoServer
function fetchGeoServerWorkspaces(callback) {
	var url = 'http://localhost:8081/geoserver/rest/workspaces.json';
	fetch(url, {
		//credentials: 'include', // Use credentials
		headers: {
			'Authorization': 'Basic ' + btoa('admin:geoserver')
		}
	})
		.then(response => response.json())
		.then(data => {
			var layers = data.workspaces.workspace.map(workspace => workspace.name);
			callback(workspaces);
		});
}

// Function to create OpenLayers layers from GeoServer layers
function createOpenLayersLayers(layers) {
	var openLayersLayers = layers.map(layerName => {
		return new ol.layer.Tile({
			source: new ol.source.TileWMS({
				url: 'http://localhost:8081/geoserver/wms',
				params: {
					'LAYERS': layerName,
					'TILED': true
				},
				serverType: 'geoserver'
			}),
			title: layerName
		});
	});
	return openLayersLayers;
}

function updateBasemap(selectedBasemap) {
	var newLayer;
	if (selectedBasemap === 'google') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}'
			})
		});
	} else if (selectedBasemap === 'esri') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}'
			})
		});
	} else {
		newLayer = new ol.layer.Tile({
			source: new ol.source.OSM()
		});
	}
	
	map.getLayers().setAt(0, newLayer);
}


var popup = new ol.Overlay({
	element: document.getElementById('popup'),
	autoPan: true,
	autoPanAnimation: {
		duration: 250
	}
});


// Fetch GeoServer layers and create OpenLayers map
fetchGeoServerLayers(function (layers) {
	var openLayersLayers = createOpenLayersLayers(layers);

	map = new ol.Map({
		target: 'map',
		layers: [
			new ol.layer.Tile({
				source: new ol.source.OSM()
			}),
			...openLayersLayers // Spread operator to add layers array
		],
		view: new ol.View({
			center: ol.proj.fromLonLat([115.24999999999997, -2.750000003999982]),
			zoom: 10
		})
	});
	map.addOverlay(popup);
	
	map.on('pointermove', function(evt) {
		var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
			return feature;
		});
		console.log(feature);
		if (feature) {
			var geometry = feature.getGeometry();
			var coord = geometry.getCoordinates();
			popup.setPosition(coord);
			var content = '<h2>Informasi Fitur</h2>';
			// Di sini Anda dapat membangun konten popup sesuai dengan atribut fitur yang Anda inginkan
			// Contoh: Jika fitur memiliki properti "name", Anda dapat menampilkan nilainya.
			// content += '<p>Name: ' + feature.get('name') + '</p>';
			popupContent.innerHTML = content;
		} else {
			popup.setPosition(undefined);
			popupCloser.blur();
		}
	});
});



$("body").on("click",popupCloser,function() {
	popup.setPosition(undefined);
	popupCloser.blur();
	return false;
});

$(document).ready(function () {
		
	var tmpt_layer_check = `<label class="list-group-item">
		<input class="form-check-input me-1" type="checkbox" value="{{value}}" />
		{{Title}}
	</label>`;

	ArrLayers = fetchGeoServerLayers(function (layers) {
		var openLayersLayers = createOpenLayersLayers(layers);
		openLayersLayers.forEach(function(v,i){
			console.log(v);
			$("#layer-container").append(tmpt_layer_check.replace('{{Title}}',v.values_.title).replace('{{value}}',v.values_.title));
		})
	});

	$("body").on("change",".basemap-option",function(){
		var baseMapOption = $(".basemap-option:checked").val();
		updateBasemap(baseMapOption);
	})
})