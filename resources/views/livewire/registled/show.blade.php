<div>
	@foreach($registleds as $registled)
	<div class="card">
		<div class="card-body text-wrap p-2" style="font-size: 14px; font-weight: 400">
@if(auth()->check() && auth()->user()->isAdmin())
			<div class="float-right">
				<a href="/item/{{ $registled->id }}/edit">edit</a>
			</div>
			@endif

			<div class="d-block mb-1">
			<img class="avatar avatar-sm mr-3 float-left" src="{{ $registled->dropType->url }}" /> <a href="/item/{{ $registled->id }}"> {{ $registled->name }}</a> <div class="flag flag-id ml-2"></div>
			</div>

			<div class="d-block">
			<img class="avatar avatar-sm mr-3 float-left" src="{{ $registled->dropType->url }}" /> <a href="/en/item/{{ $registled->id }}"> {{ $registled->name_en }}</a> <div class="flag flag-us ml-2"></div>
			</div>

			<hr class="my-2"/>

			<div class="row">
				<div class="col-6 col-md-3">
					<label class="form-label">Max Level</label>
					<span> {{ $registled->registled->max_level ?? '~ unknown ~' }}</span>
				</div>

				<div class="col-6 col-md-5">
					<label class="form-label">Recommended Level</label>
					@if($registled->registled)
					@foreach(array_keys($registled->registled->recommended_lv) as $lv)

					<span class="tag tag-sm">{{ $lv }}</span>
					@endforeach
					@else
					<span class="text-muted">~ Unknown ~</span>
					@endif
				</div>

				<div class="col-12 col-md-4">
					@if($registled->registled)
					<label class="form-label">Chest</label>
					@forelse(array_keys($registled->registled->box) as $box)
					<span class="image">
						<img src="/img/drop/{{ $box }}.jpg"  class="mr-1 mb-1" width="30px" height="30px"/>
					</span>
					@empty

					@endforelse
					@endif
				</div>


				<div class="col-12 mt-5">
					<b class="d-block">Description</b>
					{{ toHtml(translate(optional($registled->note)['monster'])) }}
				</div>

			</div>
		</div>
	</div>
	@endforeach

	{{ $registleds->onEachSide(1)->links() }}
</div>