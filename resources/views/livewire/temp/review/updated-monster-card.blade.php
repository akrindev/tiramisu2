<div>
    <div class="card mb-3">
    <div class="card-body p-3">
        <form enctype="multipart/form-data" wire:submit.prevent="accept" method="post">

            <div class="form-group">
                <label class="form-label d-block">Di tambahkan oleh</label>
                <span>{{ $monster->user->name ?? 'guest' }}</span>
            </div>

            <div class="form-group">
              <label class="form-label">Name (indo) <i class="text-danger">*</i></label>
              <input type="text" class="form-control" name="name" placeholder="Nama monster dalam bahasa indonesia" wire:model.defer='name' required>
              <input type="text" class="form-control" value="{{ $monster->name }}" disabled>
            </div>

            <div class="form-group">
              <label class="form-label">Name (english) <i class="text-muted">(optional)</i></label>
              <input type="text" class="form-control" name="name_en"  wire:model.defer='name_en' placeholder="Nama monster dalam bahasa inggris">
              <input type="text" class="form-control" value="{{ $monster->name_en }}" disabled>
            </div>

            <div class="form-group">
                <label class="form-label">Type <i class="text-danger">*</i></label>
                <div class="selectgroup selectgroup-pills">
                    <label class="selectgroup-item">
                        <input type="radio" name="type" class="selectgroup-input" value="1"  wire:model.defer='type'>
                        <span class="selectgroup-button">Normal monster</span>
                    </label>

                    <label class="selectgroup-item">
                        <input type="radio" name="type"  wire:model.defer='type' class="selectgroup-input" value="2">
                        <span class="selectgroup-button">Mini Boss</span>
                    </label>

                    <label class="selectgroup-item">
                        <input type="radio" name="type" wire:model.defer='type' class="selectgroup-input" value="3">
                        <span class="selectgroup-button">Boss</span>
                    </label>
                </div>
                <br>
                before:
                <input type="text" class="form-control" value="{{ $monster->type == 1 ? 'normal monster' : ($monster->type == 2 ? 'Mini Boss' : 'Boss') }}" disabled>
            </div>

            <div class="form-group">
              <label class="form-label">Map <i class="text-danger">*</i></label>
              <select name="map" id="map" class="form-control custom-select" required>
                <option value="">~ Select map ~</option>
              @foreach ($maps as $map)
                <option value="{{ $map->id }}" {{ $mapid == $map->id ? 'selected' : ''}}> {{ $map->name }} </option>
              @endforeach
              </select>
            </div>

            <div class="row">
              <div class="col-4">

                <div class="form-group">
                    <label class="form-label">level <i class="text-danger">*</i></label>
                    <input type="number" class="form-control" name="level" placeholder="level" wire:model.defer='level' required>
                    <input type="text" class="form-control" value="{{ $monster->level }}" disabled>
                </div>

              </div>

              <div class="col-4">

                <div class="form-group">
                    <label class="form-label">HP</label>
                    <input type="number" class="form-control" name="hp" placeholder="hp" wire:model.defer='hp'>
                    <input type="text" class="form-control" value="{{ $monster->hp }}" disabled>
                </div>

              </div>

              <div class="col-4">

                <div class="form-group">
                    <label class="form-label">XP</label>
                    <input type="number" class="form-control" name="xp" placeholder="xp" wire:model.defer='xp'>
                    <input type="text" class="form-control" value="{{ $monster->xp }}" disabled>
                </div>

              </div>

            </div>

            <div class="form-group">
                <label class="form-label d-block">Drop items <i class="text-danger">*</i></label>
                @forelse ($drops as $drop)
                <span class="d-inline"> <img src="{{ $drop->dropType->url }}" alt="" style="width:18px;height:15px"> {{ $drop->name }} </span>
                @empty
                none
                @endforelse
                <label class="form-label d-block">Drop items before <i class="text-danger">*</i></label>
                @forelse ($monster->drops as $drop)
                    <span class="d-inline"> <img src="{{ $drop->dropType->url }}" alt="" style="width:18px;height:15px"> {{ $drop->name }} </span>
                @empty
                    none
                @endforelse

            </div>

            <div class="form-group">
                <label class="form-label">Element <i class="text-danger">*</i></label>
                <div class="selectgroup selectgroup-pills">
                @foreach ($elements as $el)
                    <label class="selectgroup-item">
                        <input type="radio" name="element" class="selectgroup-input" value="{{ $el->id }}" {{ $element == $el->id ? 'checked':'' }}>
                        <span class="selectgroup-button">{{ $el->name }}</span>
                    </label>
                @endforeach
                </div>

            </div>

            @if ($picture)
            <div class="form-group">
              <label class="form-label">Screenshot <i class="text-muted">(optional)</i></label>
              <div id="preview">
                      <img src="{{ $picture }}" style="width: 100%" alt="">
                    </div>
                </div>
            @endif

            @if ($monster->picture)
            <div class="form-group">
              <label class="form-label">Screenshot before <i class="text-muted">(optional)</i></label>
              <div id="preview">
                      <img src="/{{ $pmonster->picture }}" style="width: 100%" alt="">
                    </div>
                </div>
            @endif

            <div class="form-group">
              <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Terima +1 point</button>

              <span wire:click.prevent="declined" class="btn btn-outline-danger btn-pills">Tolak</span>

              <span wire:loading wire:target='declined'> Wait ...</span>
            </div>

        </form>
    </div>
</div>

</div>
