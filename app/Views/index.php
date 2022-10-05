<?= $this->extend('layouts/V_Layouts') ?>

<?= $this->section('layout') ?>

      <div class="page-content">
            <!-- Page Header-->
            <div class="bg-dash-dark-2 py-4">
              <div class="container-fluid">
                <h2 class="h5 mb-0">Dashboard</h2>
              </div>
            </div>
        <section>
          <div class="container-fluid">
            <div class="row gy-4">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <a class="btn btn-primary btn-sm d-block mb-3" data-bs-toggle="modal" data-bs-target="#tambah" href="#" role="button">Add Place</a>
                    <div id="map"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Place</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="<?= base_url('/tambah-tempat') ?>" method="post">
                <div class="modal-body">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="nama" id="floatingPlace" placeholder="Place Name">
                    <label for="floatingPlace">Place</label>
                  </div>
                  <div class="form-floating">
                    <input type="text" class="form-control" name="longitude" id="floatingLongitude" placeholder="Longitude">
                    <label for="floatingLongitude">Longitude</label>
                  </div>
                  <div class="form-floating">
                    <input type="text" class="form-control" name="latitude" id="floatingLatitude" placeholder="Latitude">
                    <label for="floatingLatitude">Latitude</label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <script>
            var map = L.map('map').setView([-6.587758969110724, 106.80593782651178], 13);
            
            var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            
            var places_Array = [];
            for (const places of <?= json_encode($tempats); ?>) {
              var place = L.marker([places.longitude, places.latitude]).bindPopup(places.nama);
              places_Array.push(place);
            }
            var marker = L.layerGroup(places_Array);

            var Stadia_AlidadeSmoothDark = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
              maxZoom: 20,
              attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
            });

            var Stamen_Toner = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}{r}.{ext}', {
              attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
              subdomains: 'abcd',
              minZoom: 0,
              maxZoom: 20,
              ext: 'png'
            });

            var baseLayers = {
              "OpenStreetMap": osm,
              "Dark Map" : Stadia_AlidadeSmoothDark,
              "Stamen Toner Map" : Stamen_Toner
            };

            var overlays = {
                "Marker": marker,
            };

            L.control.layers(baseLayers, overlays).addTo(map);
        </script>
        
        <?= $this->endSection() ?>