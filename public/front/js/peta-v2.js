//ol.proj.proj4.fromEPSGCode('EPSG:9518');

// Buat peta
var map = new ol.Map({
	target: 'map',
	layers: [
		// Tambahkan lapisan dasar OSM
		new ol.layer.Tile({
			//maxZoom: 1, // visible at zoom levels 14 and below
			//minZoom: 10, // visible at zoom levels 14 and below
			source: new ol.source.OSM()
		})
	],
	view: new ol.View({
		center: ol.proj.fromLonLat([115.24999999999997, -2.750000003999982]),
		//projection: 'EPSG:4326',
		//projection: 'EPSG:9518',
		projection: 'EPSG:3857',
		zoom: 8
	})
});

function updateBasemap(selectedBasemap) {
	var newLayer;
	if (selectedBasemap === 'google1') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}'
			})
		});
	} else if (selectedBasemap === 'google2') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://mt2.google.com/vt/lyrs=m&x={x}&y={y}&z={z}'
			})
		});
	} else if (selectedBasemap === 'google3') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://mt3.google.com/vt/lyrs=m&x={x}&y={y}&z={z}'
			})
		});
	} else if (selectedBasemap === 'esri') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}'
			})
		});
	} else if (selectedBasemap === 'esri_imagery') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}'
			})
		});
	} else if (selectedBasemap === 'cycliosm') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://a.tile-cyclosm.openstreetmap.fr/[cyclosm|cyclosm-lite]/{z}/{x}/{y}.png'
			})
		});
	} else if (selectedBasemap === 'pastel') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://api.maptiler.com/maps/pastel/{z}/{x}/{y}.png'
			})
		});
	} else if (selectedBasemap === 'alidade_smooth_dark') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}.png'
			})
		});
	} else if (selectedBasemap === 'maptiler') {
		newLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: 'https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png'
			})
		});
	} else {
		newLayer = new ol.layer.Tile({
			source: new ol.source.OSM()
		});
	}

	map.getLayers().setAt(0, newLayer);
}

const randomRgba = function (alpha) {
	var r = Math.floor(Math.random() * 256); // Komponen merah
	var g = Math.floor(Math.random() * 256); // Komponen hijau
	var b = Math.floor(Math.random() * 256); // Komponen biru
	var a = alpha; //Math.random(); // Alpha (transparansi)

	// Format nilai RGBA sebagai string
	return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';
}

const image = new ol.style.Circle({
	radius: 5,
	fill: new ol.style.Fill({
		color: randomRgba(1) // Warna isi
	}),
	stroke: new ol.style.Stroke(/* {
		color: randomRgba(1), // Warna pinggiran
		width: 2
	} */)
});

const reStyle = function (alpha) {
	const output = {
		'image': new ol.style.Circle({
			radius: 5,
			fill: new ol.style.Fill({
				color: randomRgba(1) // Warna isi
			}),
			stroke: new ol.style.Stroke({
				color: randomRgba(1), // Warna pinggiran
				width: 2
			})
		}),
		'Point': new ol.style.Style({
			image: image,
		}),
		'LineString': new ol.style.Style({
			stroke: new ol.style.Stroke({
				color: randomRgba(1),
				width: 1,
			}),
		}),
		'MultiLineString': new ol.style.Style(/* {
			stroke: new ol.style.Stroke({
				color: randomRgba(1),
				width: 1,
			}),
		} */),
		'MultiPoint': new ol.style.Style({
			image: image,
		}),
		'MultiPolygon': new ol.style.Style({
			stroke: new ol.style.Stroke({
				color: randomRgba(1),
				width: 1,
			}),
			fill: new ol.style.Fill({
				color: randomRgba(alpha),
			}),
		}),
		'Polygon': new ol.style.Style({
			stroke: null /* new ol.style.Stroke({
				color: randomRgba(alpha),
				lineDash: [4],
				width: 1,
			}) */,
			fill: null/*  new ol.style.Fill({
				color: randomRgba(alpha),
			}) */,
		}),
		'GeometryCollection': new ol.style.Style({
			stroke: new ol.style.Stroke({
				color: randomRgba(1),
				width: 2,
			}),
			fill: new ol.style.Fill({
				color: randomRgba(alpha),
			}),
			image: new ol.style.Circle({
				radius: 10,
				fill: null,
				stroke: new ol.style.Stroke({
					color: randomRgba(alpha),
				}),
			}),
		}),
		'Circle': new ol.style.Style({
			stroke: new ol.style.Stroke({
				color: randomRgba(1),
				width: 2,
			}),
			fill: new ol.style.Fill({
				color: randomRgba(alpha),
			}),
		}),

		'LCODE_BA0080': new ol.style.Style({
			stroke: new ol.style.Stroke({
				color: randomRgba(1),
				width: 2,
			}),
			fill: new ol.style.Fill({
				color: randomRgba(alpha),
			}),
		}),
		'LCODE_DA0200': new ol.style.Style({
			stroke: new ol.style.Stroke({
				color: randomRgba(1),
				width: 2,
			}),
			fill: new ol.style.Fill({
				color: randomRgba(alpha),
			}),
		}),
		'LCODE_DA0280': new ol.style.Style({
			stroke: new ol.style.Stroke({
				color: randomRgba(1),
				width: 2,
			}),
			fill: new ol.style.Fill({
				color: randomRgba(alpha),
			}),
		}),
		'LCODE_GF0020': new ol.style.Style({
			stroke: new ol.style.Stroke({
				color: randomRgba(1),
				width: 2,
			}),
			fill: new ol.style.Fill({
				color: randomRgba(alpha),
			}),
		}),
	};
	return output;
}

let defaultStyles = reStyle(.3);

const styleFunction = function (feature) {
	//console.log(feature,'LCODE_'+feature.get('LCODE'));
	//return reStyle(.5)[feature.getGeometry().getType()];

	return (defaultStyles['LCODE_' + feature.get('LCODE')]) ?? defaultStyles[feature.getGeometry().getType()];
};

// Daftar file GeoJSON yang akan dimuat
var geojsonFiles = [
	{
		url: './uploads/json/indonesia.geojson',
		minZoom: 1, // visible at zoom levels above 14
		maxZoom: 4, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/indonesia-province.geojson',
		minZoom: 3, // visible at zoom levels above 14
		maxZoom: 8, // visible at zoom levels above 14
	},
	/* 
	{
		url: './uploads/json/all_kabkota_ind.geojson',
		minZoom: 6, // visible at zoom levels above 14
		maxZoom: 9, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/kabkota.geojson',
		minZoom: 9, // visible at zoom levels above 14
		maxZoom: 12, // visible at zoom levels above 14
	}, */
	{
		url: './uploads/json/kalsel_kabkota.geojson',
		minZoom: 8, // visible at zoom levels above 14
		maxZoom: 12, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_TAPIN.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_TANAHLAUT.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_TANAHBUMBU.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_TABALONG.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_KOTABANJARBARU.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_HULUSUNGAIUTARA.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_HULUSUNGAITENGAH.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_HULUSUNGAISELATAN.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_BARITOTIMUR.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_BARITOKUALA.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_BANJAR.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_BALANGAN.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASIKECAMATAN_AR_50K_KOTA_BANJARMASIN.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_BALANGAN.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_BANJAR.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_BARITOKUALA.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_BARITOTIMUR.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_HULUSUNGAISELATAN.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_HULUSUNGAITENGAH.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_HULUSUNGAIUTARA.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_KOTA_BANJARMASIN.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_KOTABANJARBARU.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_TABALONG.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_TANAHBUMBU.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_TANAHLAUT.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/ADMINISTRASI_LN_50K_TAPIN.geojson',
		minZoom: 12, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_BALANGAN.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_BANJAR.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_BARITOKUALA.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_BARITOTIMUR.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_HULUSUNGAISELATAN.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_HULUSUNGAITENGAH.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_HULUSUNGAIUTARA.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_KOTA_BANJARMASIN.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_KOTABANJARBARU.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_TABALONG.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_TANAHBUMBU.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_TANAHLAUT.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	},
	{
		url: './uploads/json/TOPONIMI_PT_50K_TAPIN.geojson',
		minZoom: 10, // visible at zoom levels above 14
		maxZoom: 20, // visible at zoom levels above 14
	}

];

var kabkota = [
	{title: 'KAB. TANAH LAUT'},
	{title: 'KAB. KOTABARU'},
	{title: 'KAB. BANJAR'},
	{title: 'KAB. BARITO KUALA'},
	{title: 'KAB. TAPIN'},
	{title: 'KAB. HULU SUNGAI SELATAN'},
	{title: 'KAB. HULU SUNGAI TENGAH'},
	{title: 'KAB. HULU SUNGAI UTARA'},
	{title: 'KAB. TABALONG'},
	{title: 'KAB. TANAH BUMBU'},
	{title: 'KAB. BALANGAN'},
	{title: 'KOTA BANJARMASIN'},
	{title: 'KOTA BANJARBARU'},
];

var psu = [
	{
		title: 'Pra Sarana',
		childs: [
			{ title: 'Jalan' },
			{ title: 'Drainase' },
			{ title: 'Air Minum' },
			{ title: 'Sanitasi' },
			{ title: 'Air Limbah' },
		],
	},
	{
		title: 'Sarana',
		childs: [
			{ title: 'Sarana Perniagaan/ Perbelanjaan' },
			{ title: 'Sarana Pelayanan Umum Dan Pemerintahan' },
			{ title: 'Sarana Pendidikan' },
			{ title: 'Sarana Kesehatan' },
			{ title: 'Sarana Peribadatan' },
			{ title: 'Sarana Rekreasi Dan Olah Raga' },
			{ title: 'Sarana Pemakaman' },
			{ title: 'Sarana Pertamanan Dan Ruang Terbuka Hijau (RTH)' },
			{ title: 'Sarana Parkir' },
		],
	},
	{
		title: 'Utilitas',
		childs: [
			{ title: 'jaringan listrik' },
			{ title: 'jaringan air bersih' },
			{ title: 'jaringan telepon' },
			{ title: 'jaringan gas' },
			{ title: 'jaringan transportasi' },
			{ title: 'pemadam kebakaran' },
			{ title: 'sarana penerangan jalan umum' },
		],
	},
];

var layerData = [
	{
		'title': 'Administrasi Area',
		'childs': kabkota
	},
	{
		'title': 'Administrasi Line',
		'childs': kabkota
	},
	{
		'title': 'Jenis PSU',
		'childs': psu
	}
];

function createAccordion(datas,prefix)
{
	prefix = (!prefix)?'':prefix;
	var output = $('<div class="accordion accordion-flush accordion--custom" id="accordionLayerContainer'+prefix+'"></div>');

	datas.forEach((v,i) => {
		var idx = prefix+"_"+i;
		var child = (!v.childs || v.childs.length == 0)?$('<div></div>'):createAccordion(v.childs,idx);

		$(output).append(
			`	<div class="accordion-item">` +
			`		<div class="accordion-header d-flex justify-content-beetween" id="flush-heading`+idx+`">` +
			`			<div class="d-flex my-auto">` +
			`				<input class="form-check-input me-1" type="checkbox" value="osm" name="layer-options">` +
			`			</div>` +
			`			<div class="accordion-button collapsed" type="button" data-bs-toggle="collapse"` +
			`				data-bs-target="#flush-collapse`+idx+`" aria-expanded="true" aria-controls="flush-collapse`+idx+`">` + v.title +
			`			</div>` +
			`		</div>` +
			`		<div id="flush-collapse`+idx+`" class="accordion-collapse collapse" aria-labelledby="flush-heading`+idx+`"` +
			`			data-bs-parent="#accordionLayerContainer`+prefix+`">` +
			`			<div class="accordion-body pe-0 py-0">` + $(child).prop('outerHTML') + `</div>` +
			`		</div>` +
			`	</div>`
		);
	});

	return output;
}


// Fungsi Filter
function filterFeatures(vectorSource,attribute, value) {
    vectorSource.clear(); // Membersihkan layer vektor

    vectorSource.addFeatures(vectorSource.getFeatures().filter(function(feature) {
        return feature.get(attribute) === value;
    }));
}

function writeMap(filters)
{
	// Iterasi melalui setiap file GeoJSON
	geojsonFiles.forEach(function (geojsonFile) {
		// Buat sumber data vektor untuk file GeoJSON
		var vectorSource = new ol.source.Vector({
			format: new ol.format.GeoJSON(),
			url: geojsonFile.url,
			maxZoom: geojsonFile.maxZoom ?? 10,
			minZoom: geojsonFile.minZoom ?? 1,
			//projection: 'EPSG:4326',
			projection: 'EPSG:9518',
		});

		// Buat lapisan vektor untuk file GeoJSON
		var vectorLayer = new ol.layer.Vector({
			source: vectorSource,
			style: styleFunction,
			maxZoom: geojsonFile.maxZoom ?? 10,
			minZoom: geojsonFile.minZoom ?? 1,
			projection: 'EPSG:9518',
		});

		if(!filters)
		{}else{
			filters.forEach((v,i) => {
				console.log(v,i,vectorSource)
				vectorSource.clear(); // Membersihkan layer vektor

				vectorSource.addFeatures(vectorSource.getFeatures().filter(function(feature) {
					return feature.get(i) === v;
				}));

				//filterFeatures(vectorSource, i, v);
			})
		}
		// Tambahkan lapisan vektor ke peta
		map.addLayer(vectorLayer);
	});
}

writeMap([{'REMARK': 'Kampung/Dusun'}]);

this.popupOverlay = new ol.Overlay({
	element: document.getElementById('popup'),
	offset: [9, 9]
});
this.map.addOverlay(this.popupOverlay);

function filterUniquePropertyValues(arr, prop) {
	let uniqueValues = new Object();
	let output = [];

	arr.forEach(function (obj) {
		var pr = obj.getProperties();
		let length1 = Object.keys(uniqueValues).length;
		uniqueValues[pr[prop]] = obj;
		let length2 = Object.keys(uniqueValues).length;
		if (length2 > length1) {
			output.push(obj);
		}
	});
	return output;
}
this.map.on('click', (event) => {
	let features = [];
	let layers = [];
	this.map.forEachFeatureAtPixel(event.pixel,
		(feature, layer) => {
			features.push(feature)
		},
		{
			layerFilter: (layer) => {
				layers.push(layer);
				return (layer.type === new ol.layer.Vector().type) ? true : false;
			}
		} //, hitTolerance: 6 }
	);
	if (!features || features.length === 0) {
		document.getElementById('popup-content').innerHTML = '';
		document.getElementById('popup').hidden = true;
	} else {
		document.getElementById('popup-content').innerHTML = '';
		var tfeatures = filterUniquePropertyValues(features, 'LCODE');
		tfeatures.forEach((v, i) => {
			var prop = v.getProperties();
			var head = [];
			var body = [];

			for (var k2 in prop) {
				if (!prop[k2] == false && k2 != 'geometry') {
					head.push('<th>' + k2 + '</th>');
				}
				if (!prop[k2] == false && k2 != 'geometry') {
					//body.push('<tr><td>'+k2+'</td><td>:</td><td>'+prop[k2]+'</td></tr>');
					body.push('<td>' + prop[k2] + '</td>');
				}
			}

			document.getElementById('popup-content').innerHTML += '<table class="table table-bordered table-stripped text-start fs-6"><thead><tr>' + head.join('') + '</tr></thead><tbody>' + body.join('') + '</tbody></table>';
			document.getElementById('popup').hidden = false;
			this.popupOverlay.setPosition(event.coordinate);
		});
	}


	//Create an empty extent that we will gradually extend
	var extent = ol.extent.createEmpty();
	var selectedLayers = [];
	map.getLayers().forEach(function (layer) {
		selectedLayers.push(layer);
		//If this is actually a group, we need to create an inner loop to go through its individual layers
		if (layer instanceof ol.layer.Group) {
			layer.getLayers().forEach(function (groupLayer) {
				//If this is a vector layer, add it to our extent
				if (layer instanceof ol.layer.Vector)
					ol.extent.extend(extent, groupLayer.getSource().getExtent());
			});
		}
		else if (layer instanceof ol.layer.Vector)
			ol.extent.extend(extent, layer.getSource().getExtent());
	});

	//Finally fit the map's view to our combined extent
	//map.getView().fit(extent, map.getSize());
	console.log(extent, selectedLayers);
});



var selectedStyle = new ol.style.Style({
	stroke: new ol.style.Stroke({
		width: 2,
		color: 'blue'
	}),
	fill: new ol.style.Fill()
});

var start;

var select = new ol.interaction.Select({
	condition: ol.events.condition.pointerMove,
	style: function (feature) {
		var elapsed = new Date().getTime() - start;
		var opacity = Math.min(0.3 + elapsed / 10000, 0.8);
		selectedStyle.getFill().setColor('rgba(255,0,0,' + opacity + ')');
		feature.changed();
		return selectedStyle;
	}
});
select.on('select', function () { start = new Date().getTime(); });
map.addInteraction(select);

$("body").on("click", ".ol-popup-closer", function () {
	document.getElementById('popup').hidden = true;
})

$("body").on("change", ".basemap-option", function () {
	var baseMapOption = $(".basemap-option:checked").val();
	updateBasemap(baseMapOption);
})

$(document).ready(function () {
	$("#layer-container").html(createAccordion(layerData));
	/* $("#layer-container").html(`<div class="accordion accordion-flush accordion--custom" id="accordionLayerContainer">` +
		`	<div class="accordion-item">` +
		`		<div class="accordion-header d-flex justify-content-beetween" id="flush-headingOne1">` +
		`			<div class="d-flex my-auto">` +
		`				<input class="form-check-input me-1" type="checkbox" value="osm" name="layer-options">` +
		`			</div>` +
		`			<div class="accordion-button collapsed" type="button" data-bs-toggle="collapse"` +
		`				data-bs-target="#flush-collapseOne1" aria-expanded="true" aria-controls="flush-collapseOne1">Administrasi Area` +
		`			</div>` +
		`		</div>` +
		`		<div id="flush-collapseOne1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne1"` +
		`			data-bs-parent="#accordionLayerContainer">` +
		`			<div class="accordion-body pe-0">` +
		`				<div class="accordion accordion-flush" id="accordionLayerContainerSub1">` +
		`					<div class="accordion-item">` +
		`						<div class="accordion-header d-flex justify-content-beetween" id="flush-headingOne1a">` +
		`							<div class="d-flex my-auto">` +
		`								<input class="form-check-input me-1" type="checkbox" value="osm" name="layer-options">` +
		`							</div>` +
		`							<div class="accordion-button collapsed" type="button" data-bs-toggle="collapse"` +
		`								data-bs-target="#flush-collapseOnea" aria-expanded="true"` +
		`								aria-controls="flush-collapseOnea">Banjar Masin` +
		`							</div>` +
		`						</div>` +
		`						<div id="flush-collapseOnea" class="accordion-collapse collapse"` +
		`							aria-labelledby="flush-headingOne1a" data-bs-parent="#accordionLayerContainerSub1">` +
		`							<div class="accordion-body pe-0">` +
		`								This is the first item's accordion body.` +
		`							</div>` +
		`						</div>` +
		`					</div>` +
		`					<div class="accordion-item">` +
		`						<div class="accordion-header d-flex justify-content-beetween" id="flush-headingOne1b">` +
		`							<div class="d-flex my-auto">` +
		`								<input class="form-check-input me-1" type="checkbox" value="osm" name="layer-options">` +
		`							</div>` +
		`							<div class="accordion-button collapsed" type="button" data-bs-toggle="collapse"` +
		`								data-bs-target="#flush-collapseOneb" aria-expanded="true"` +
		`								aria-controls="flush-collapseOneb">Banjarbaru` +
		`							</div>` +
		`						</div>` +
		`						<div id="flush-collapseOneb" class="accordion-collapse collapse"` +
		`							aria-labelledby="flush-headingOne1b" data-bs-parent="#accordionLayerContainerSub1">` +
		`							<div class="accordion-body pe-0">` +
		`								This is the first item's accordion body.` +
		`							</div>` +
		`						</div>` +
		`					</div>` +
		`				</div>` +
		`			</div>` +
		`		</div>` +
		`	</div>` +
		`</div>`
	); */
	/* 
	$("#layer-container").html(
		`<ol class="list-group list-group-flush" id="accordionLayerContainer">`+
		`	<li class="list-group-item d-flex justify-content-between align-items-start">`+
		`	<div class="ms-2 me-auto">`+
		`		<div class="fw-bold">Subheading</div>`+
		`		Content for list item`+
		`	</div>`+
		`	<span class="badge text-bg-primary rounded-pill">14</span>`+
		`<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree1" aria-expanded="false" aria-controls="flush-collapseThree">+</button>` +
		`<div id="flush-collapseThree1" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionLayerContainer">`+
			`<div class="accordion-body">`+
				`<div class="list-group list-group-flush">`+
					`<label class="list-group-item">`+
						`<input class="form-check-input me-1 basemap-option" type="radio" value="osm" name="basemap-option">`+
						`OpenStreetMap`+
					`</label>`+
					`<label class="list-group-item">`+
						`<input class="form-check-input me-1 basemap-option" type="radio" value="google" name="basemap-option">`+
						`Google Maps`+
					`</label>`+
					`<label class="list-group-item">`+
						`<input class="form-check-input me-1 basemap-option" type="radio" value="esri" name="basemap-option">`+
						`Esri`+
					`</label>                                    `+
				`</div>`+
			`</div>`+
		`</div>`+
		`	</li>`+
		`	<li class="list-group-item d-flex justify-content-between align-items-start">`+
		`	<div class="ms-2 me-auto">`+
		`		<div class="fw-bold">Subheading</div>`+
		`		Content for list item`+
		`	</div>`+
		`	<span class="badge text-bg-primary rounded-pill">14</span>`+
		`<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree2" aria-expanded="false" aria-controls="flush-collapseThree">+</button>` +
		`<div id="flush-collapseThree2" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionLayerContainer">`+
			`<div class="accordion-body">`+
				`<div class="list-group list-group-flush">`+
					`<label class="list-group-item">`+
						`<input class="form-check-input me-1 basemap-option" type="radio" value="osm" name="basemap-option">`+
						`OpenStreetMap`+
					`</label>`+
					`<label class="list-group-item">`+
						`<input class="form-check-input me-1 basemap-option" type="radio" value="google" name="basemap-option">`+
						`Google Maps`+
					`</label>`+
					`<label class="list-group-item">`+
						`<input class="form-check-input me-1 basemap-option" type="radio" value="esri" name="basemap-option">`+
						`Esri`+
					`</label>                                    `+
				`</div>`+
			`</div>`+
		`</div>`+
		`	</li>`+
		`	<li class="list-group-item d-flex justify-content-between align-items-start">`+
		`	<div class="ms-2 me-auto">`+
		`		<div class="fw-bold">Subheading</div>`+
		`		Content for list item`+
		`	</div>`+
		`	<span class="badge text-bg-primary rounded-pill">14</span>`+
		`<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree3" aria-expanded="false" aria-controls="flush-collapseThree">+</button>` +
		`<div id="flush-collapseThree3" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionLayerContainer">`+
			`<div class="accordion-body">`+
				`<div class="list-group list-group-flush">`+
					`<label class="list-group-item">`+
						`<input class="form-check-input me-1 basemap-option" type="radio" value="osm" name="basemap-option">`+
						`OpenStreetMap`+
					`</label>`+
					`<label class="list-group-item">`+
						`<input class="form-check-input me-1 basemap-option" type="radio" value="google" name="basemap-option">`+
						`Google Maps`+
					`</label>`+
					`<label class="list-group-item">`+
						`<input class="form-check-input me-1 basemap-option" type="radio" value="esri" name="basemap-option">`+
						`Esri`+
					`</label>                                    `+
				`</div>`+
			`</div>`+
		`</div>`+
		`	</li>`+
		`</ol>`); */
});