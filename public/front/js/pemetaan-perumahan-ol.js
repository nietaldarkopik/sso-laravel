import Circle from '../my-app/node_modules/ol/geom/Circle.js';
import Feature from '../my-app/node_modules/ol/Feature.js';
import GeoJSON from '../my-app/node_modules/ol/format/GeoJSON.js';
import Map from '../my-app/node_modules/ol/Map.js';
import View from '../my-app/node_modules/ol/View.js';
import { Circle as CircleStyle, Fill, Stroke, Style } from '../my-app/node_modules/ol/style.js';
import { OSM, Vector as VectorSource } from '../my-app/node_modules/ol/source.js';
import { Tile as TileLayer, Vector as VectorLayer } from '../my-app/node_modules/ol/layer.js';
import { fromLonLat } from '../my-app/node_modules/ol/proj.js';

const image = new CircleStyle({
  radius: 5,
  fill: null,
  stroke: new Stroke({ color: 'red', width: 1 }),
});

const styles = {
  'Point': new Style({
    image: image,
  }),
  'LineString': new Style({
    stroke: new Stroke({
      color: 'green',
      width: 1,
    }),
  }),
  'MultiLineString': new Style({
    stroke: new Stroke({
      color: 'green',
      width: 1,
    }),
  }),
  'MultiPoint': new Style({
    image: image,
  }),
  'MultiPolygon': new Style({
    stroke: new Stroke({
      color: 'yellow',
      width: 1,
    }),
    fill: new Fill({
      color: 'rgba(255, 255, 0, 0.1)',
    }),
  }),
  'Polygon': new Style({
    stroke: new Stroke({
      color: 'blue',
      lineDash: [4],
      width: 3,
    }),
    fill: new Fill({
      color: 'rgba(0, 0, 255, 0.1)',
    }),
  }),
  'GeometryCollection': new Style({
    stroke: new Stroke({
      color: 'magenta',
      width: 2,
    }),
    fill: new Fill({
      color: 'magenta',
    }),
    image: new CircleStyle({
      radius: 10,
      fill: null,
      stroke: new Stroke({
        color: 'magenta',
      }),
    }),
  }),
  'Circle': new Style({
    stroke: new Stroke({
      color: 'red',
      width: 2,
    }),
    fill: new Fill({
      color: 'rgba(255,0,0,0.2)',
    }),
  }),
};

const styleFunction = function (feature) {
  return styles[feature.getGeometry().getType()];
};

const geojsonObject = {
  'type': 'FeatureCollection',
  'crs': {
    'type': 'name',
    'properties': {
      //'name': 'EPSG:3857',
      'name': 'EPSG:4326',
    },
  },
  'features': [],
};


const vectorSource = new VectorSource({
  features: new GeoJSON().readFeatures(geojsonObject),
});

//vectorSource.addFeature(new Feature(new Circle([5e6, 7e6], 1e6)));

const vectorLayer = new VectorLayer({
  source: vectorSource,
  style: styleFunction,
});

const  map = new Map({
  layers: [
    new TileLayer({
      source: new OSM(),
    }),
    vectorLayer,
  ],
  target: 'map',
  view: new View({
    projection: 'EPSG:4326',
    center: [115.9940, -2.1889],
    zoom: 7,
  }),
});

// Fungsi untuk memuat data GeoJSON dari file menggunakan AJAX
function loadGeoJSONFile(url, callback) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.responseType = 'json';
  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      callback(xhr.response);
    } else {
      console.error('Failed to load GeoJSON file');
    }
  };
  xhr.send();
}

// URL dari file GeoJSON
var geojsonUrl = '/uploads/json/kalsel_kabkota.geojson';

// Memuat data GeoJSON dari file dan menambahkannya ke peta

fetch('uploads/json/kalsel_kabkota.geojson')
.then(function (response) {
    return response.json();
})
.then(function (geojsonObject) {
  var vectorSource = new VectorSource({
    features: new GeoJSON().readFeatures(geojsonObject),
  });

  console.log(new GeoJSON().readFeatures(geojsonObject));
  var vectorLayer = new VectorLayer({
    source: vectorSource,
    style: styleFunction,
  });
  
  map.addLayer(vectorLayer);
  
  // Fungsi untuk mengatur tampilan peta
  function setMapView(lon, lat, zoom) {
    var view = map.getView();
    view.setCenter([lon, lat]);
    view.setZoom(zoom);
  }

  // Panggil fungsi setMapView untuk mengatur tampilan peta
  setMapView(115.9940, -2.1889, 7);
});
