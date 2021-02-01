<div class="col-12 my-3">
	<div class="card">
		<div class="card-body p-2" style="font-size: 14px">

        <img src="{{ $drop->dropType->url }}" alt="{{ $drop->dropType->name }}" class="avatar avatar-sm mr-1" style="width:21px; height:21px; border-radius: 50%">
        <b class="h6"><a class="text-primary" href="{{ request()->segment(1) == 'en' || app()->isLocale('en') ? '/en' : '' }}/item/{{ $drop->id }}">{{ $drop->name }} ({{ $drop->name_en }})</a></b>

			<div class="d-block">
				{{ toHtml(translate(optional($drop->note)['monster'])) }}
			</div>

			<hr class="my-2" />

			<div wire:loading>
				<div class="alert alert-success"> Updating . . .</div>
			</div>
			<div class="form-group">
				<label class="form-label">Max Level</label>
				<input type="number" class="form-control" wire:model="maxlv" />
			</div>

			<div class="form-group">
				<label class="form-label">Recomended Level</label>


            <div class="selectgroup selectgroup-pills {{  $errors->has('tags') ? 'is-invalid': '' }}">
				@foreach([10,30,50,70,90,110,130,150,170] as $lv)
                          <label class="selectgroup-item">
                            <input type="checkbox" wire:model="rLv.{{ $lv }}" name="rLv.{{ $lv }}" class="selectgroup-input">
                            <span class="selectgroup-button">{{ $lv }}</span>
                          </label>
          @endforeach
        </div>
			</div>

			<div class="form-group">
				<label class="form-label">Chest</label>
				<br />
				<div class="selectgroup selectgroup-pills {{  $errors->has('tags') ? 'is-invalid': '' }}">
				@foreach([1,2,3,4,5] as $box)
                          <label class="selectgroup-item">
                            <input type="checkbox"  wire:model="chest.{{ $box }}" name="chest.{{ $box }}" class="selectgroup-input">
                           <span class="selectgroup-button"> <img src="/img/drop/{{ $box }}.jpg" class="avatar avatar-sm" style="width:21px; height:21px; border-radius: 50%"/>
							  </span>
                          </label>
          @endforeach
        </div>
			</div>
		</div>
	</div>
</div>