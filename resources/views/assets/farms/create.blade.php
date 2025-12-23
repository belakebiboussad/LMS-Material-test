  @extends('layouts.app')
  @section('title', __('farm.create'))
  @section('css')
    #mapid {
      height: 300px;
    }
  @endsection
  @section('content')
  <div class="main-content position-relative bg-gray-100  h-100">
    <div class="card card-plain h-100">
      <div class="card-header pb-0 p-3">
        <div class="row">
          <div class="col-md-8 d-flex align-items-center">
            <h3 class="mb-3">{{ __('farm.create') }}</h3>
          </div>
        </div>
      </div>
      <div class="card-body p-3">
        <form method='POST' action="{{ route('farms.store') }}">
          @csrf
            @if (session('errors'))
          @foreach (session('errors')->all() as $error)
          <div class="alert alert-warning">{{ $error }}</div>
          @endforeach
          @endif
          <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">{{ __('farm.recordNbr') }}</label>
              <input type="text" name="recordNbr" class="form-control border phone border-2 p-2 {{ $errors->has('recordNbr') ? ' is-invalid' : '' }}" value="{{ old('recordNbr') ?? '' }}" required>
              @error('recordNbr')
              <p class='text-danger inputerror'>{{ $message }} </p>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">{{ __('farm.name') }}</label>
              <input type="text" name="name" class="form-control border border-2 p-2" {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') ?? '' }}" required>
              @error('name')
              <p class='text-danger inputerror'>{{ $message }} </p>
              @enderror
            </div>
            {{-- <div class="mb-3 col-md-6">
              <label class="form-label">{{ __('farm.owner') }}</label>
              <select name="owner_id" class="form-control border border-2 p-2">
                <option value="{{ auth()->id() }}" class="border-2 p-2">
                  {{ auth()->user()->name }}
                </option>
              </select>
              @error('owner_id')
              <p class='text-danger inputerror'>{{ $message }}</p>
              @enderror
            </div> --}}
            <div class="mb-3 col-md-6">
              <label class="form-label">{{ __('farm.guardien_id') }}</label>
              <select name="guardien_id" class="form-control border border-2 p-2">
                <option value="" selected>{{ __('selection')}}</option>  
                @foreach($guardiens as $key =>$value)
                <option value="{{ $key }}" > {{ $value}}</option>
                @endforeach
              </select>
              @error('guardien_id')
              <p class='text-danger inputerror'>{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">{{ __('farm.type') }}</label>
              <div class="col-md-12">
                @foreach($animalTypes as $key=>$type)
                <input type="checkbox" name="animal_types[]" id="{{ $type }}" class="form-check-input chk-col-pink" value="{{ $key }}">
                <label for="{{ $type }}">{{ ucfirst($type) }}</label>
                @endforeach
              </div>
            </div>
          </div>
          <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">{{ __('farm.creationDt') }}</label>
              <input type="date" name="creationDt" class="form-control border border-2 p-2" value="{{ old('creationDt') ?? '' }}">
              @error('creationDt')
              <p class='text-danger inputerror'>{{ $message }} </p>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">{{ __('farm.area') }}</label>
              <input type="number" step="0.01" min="0" name="area" class="form-control border border-2 p-2" value="{{ old('area') ?? '' }}">
              @error('area')
              <p class='text-danger inputerror'>{{ $message }} </p>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">{{ __('farm.address') }}</label>
              <input type="text" name="address" class="form-control border border-2 p-2" value="{{ old('address') ?? '' }}">
              @error('address')
              <p class='text-danger inputerror'>{{ $message }} </p>
              @enderror
            </div>
            <div class="mb-3 col-md-3">
              <label class="form-label">{{ __('farm.wilaya') }}</label>
              <select name="wilaya_id" class="form-control border border-2 p-2">
                @foreach($wilayas as $key=>$wilaya)
                <option value="{{ $key }}" class="border-2 p-2">
                  {{ $wilaya }}
                </option>
                @endforeach
              </select>
              @error('wilaya_id')
              <p class='text-danger inputerror'>{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-3 col-md-3">
              <label class="form-label">{{ __('farm.phone') }}</label>
               <input type="tel" name="phone" pattern="^(0(?:5|6|7)\d{8})$" placeholder="0xxxxxxxxx" class="form-control phone border border-2 p-2" value="{{ old('phone') ?? '' }}">
               @error('phone') 
              <p class='text-danger inputerror'>{{ $message }} </p>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">{{ __('farm.latitude') }}</label>
              <input type="text" name="y_lat" id="latitude"  class="form-control border border-2 p-2" value="{{ old('y_lat', request('y_lat')) }}" required>
              @error('y_lat')
              <p class='text-danger inputerror'>{{ $message }} </p>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">{{ __('farm.longitude') }}</label>
              <input type="text" name="x_lon" id="longitude" class="form-control border border-2 p-2" value="{{ old('x_lon', request('x_lon')) }}" required>
              @error('x_lon')
              <p class='text-danger inputerror'>{{ $message }} </p>
              @enderror
            </div>
          </div>
          <div id="mapid"></div>
          <div class="row mb-0">
            <div class="col-md-12 text-center mt-4">
              <button type="submit" class="btn bg-gradient-primary">{{ __('app.save') }}</button>
              <a href="{{ route('farms.index') }}" class="btn btn-warning">{{ __('app.cancel') }}</a>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>
  @endsection
  @push('scripts')
  <script>
    var mapCenter = [{{ request('y_lat', config('leaflet.map_center_latitude')) }}, {{ request('x_lon', config('leaflet.map_center_longitude')) }}];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.zoom_level') }});
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var marker = L.marker(mapCenter).addTo(map);

    function updateMarker(lat, lng) {
      marker
        .setLatLng([lat, lng])
        .bindPopup("Your location :  " + marker.getLatLng().toString())
        .openPopup();
      return false;
    };
    map.on('click', function(e) {
      let latitude = e.latlng.lat.toString().substring(0, 15);
      let longitude = e.latlng.lng.toString().substring(0, 15);
      $('#latitude').val(latitude);
      $('#longitude').val(longitude);
      updateMarker(latitude, longitude);
    });
    var updateMarkerByInputs = function() {
      return updateMarker($('#latitude').val(), $('#longitude').val());
    }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);
  </script>
  @endpush