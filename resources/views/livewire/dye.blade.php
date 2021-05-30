<div>
     <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Dye {{ now()->formatLocalized('%B %Y') }} </h3>
        </div>
        <div class="card-body p-0" style="font-size:15px">

            <ul class="nav nav-tabs justify-content-center m-0" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="indo-tab" data-toggle="tab" href="#indo" role="tab" aria-controls="indo" aria-selected="true">
               Indonesian</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">English
              <span class="nav-unread"></span>
              </a>
            </li>
          </ul>


          <div class="tab-content" id="myTabContent">
            <!-- leveling list -->
          <div class="tab-pane fade show active" id="indo" role="tabpanel" aria-labelledby="indo-tab">

			  <div class="p-3" style="font-size:14px;font-weight:400">
				{{ toHtml(__('dye.info', [], 'id')) }}
			  </div>
            </div>
            <!-- info exp gain -->
            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
            <div class="p-3" style="font-size:14px;font-weight:400">
				{{ toHtml(__('dye.info', [], 'en')) }}
             </div>
            </div>
          </div>

        </div>
      </div>

        @includeUnless(app()->isLocal(), 'inc.ads_mobile')

    <div class="card">
          <div class="card-header">
            <h3 class="card-title">Dye bulan {{ now()->formatLocalized('%B %Y') }}</h3>
          </div>

        <div class="card-body p-3">
            <div class="selectgroup w-100">
                <label class="selectgroup-item">
                    <input type="radio" name="value" value="id" class="selectgroup-input" checked="" wire:click="switchLocalization('id')">
                    <span class="selectgroup-button">Indonesia</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="value" value="en" class="selectgroup-input" wire:click="switchLocalization('en')">
                    <span class="selectgroup-button">English</span>
                </label>
            </div>
        </div>

          <div class="card-table">
          <table class="card-table table table-striped" style="font-size:14px">
            @if($dyes->count())
          <caption class="p-3">  Dye {{ now()->formatLocalized('%B %Y') }} </caption>
          <thead>
            <tr>
              <th> Nama Boss </th>
              <th> A </th>
              <th> B </th>
              <th> C </th>
            </tr>
          </thead>
            @endif
          @forelse($dyes as $dye)
          <tr>
            <td class="p-2"> <div><b><a href="/monster/{{ $dye->monster->id }}" style="color:black">{{ $dye->monster->name }}</a></b> <br/>
              <small class="text-muted">
                {{ $dye->monster->map->name }}
              </small>
            </div>

              @auth @if(auth()->user()->isAdmin())[<a href="#" class="dd text-danger" data-id="{{ $dye->id }}">hapus</a>] @endif @endauth
              </td>
            <td class="p-2" {!! $dye->type == 'a' ? "style='color:white;text-shadow:0 0 8px black, 0 0 4px blue;text-align:center;background:#{$dye->dye->hex}'" : '' !!}> {{ $dye->type == 'a' ? $dye->dye->color : '' }}</td>
            <td class="p-2" {!! $dye->type == 'b' ? "style='color:white;text-shadow:0 0 8px black, 0 0 4px blue;text-align:center;background:#{$dye->dye->hex}'" : '' !!}> {{ $dye->type == 'b' ? $dye->dye->color : '' }}</td>
          	<td class="p-2" {!! $dye->type == 'c' ? "style='color:white;text-shadow:0 0 8px black, 0 0 4px blue;text-align:center;background:#{$dye->dye->hex}'" : '' !!}> {{ $dye->type == 'c' ? $dye->dye->color : '' }}</td>
          </tr>
          @empty
            <tr class="p-5 font-weight-bold"><td> Wait for update</td></tr>
          @endforelse
        </table>
          </div>
        </div>
</div>