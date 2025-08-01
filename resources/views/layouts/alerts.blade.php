@if(session('success'))
  <div class="light-green-background black-color margin-top-2 border-radius-1 padding-3 font-size-1-4 text-align">
    {{ session('success') }}
  </div>
@endif

@if ($errors->has('unauthorized'))
  <div class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
    {{ $errors->first('unauthorized') }}
  </div>
@endif

@if ($errors->any())
  <div class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
    <ul class="no-list-style padding-0 margin-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
