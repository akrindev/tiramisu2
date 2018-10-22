
    <div class="col-md-4">
    <div class="card">
      <div class="card-body p-3" style="font-size:14px;font-weight:400">


  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')

        @foreach(collect((new App\Skill)->get())->groupBy('type') as $skill => $child)
        <div class="mb-5">
        <h4>{{ ucfirst($skill) }}</h4>

          @foreach($child as $kid)
        <div class="mb-2">
        <img src="{{ $kid->picture }}" alt="{{ $kid->name }}" class="avatar avatar-md mr-4"> <a href="/skill/{{ str_replace(' ', '-',$kid->name) }}"> {{ $kid->name }} </a> </div>


          @endforeach
        </div>

        @endforeach


  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_matched')

      </div>
    </div>
    </div>