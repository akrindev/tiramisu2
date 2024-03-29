<div class="card mb-3">
    <div class="card-body p-3">

        <form wire:submit.prevent='accept' enctype="multipart/form-data" method="post">

        <div class="form-group">
            <label class="form-label d-block">Di tambahkan oleh</label>
            {{ $item->user->name ?? 'guest' }} pada {{ $item->created_at }}
        </div>
        <div class="form-group">
            <label class="form-label">Nama indo</label>
            <input type="text" wire:model.defer="name" class="form-control" required>
            <label class="form-label">before</label>
            <input type="text" class="form-control" value="{{ $item->drop->name }}" disabled>
        </div>

        <div class="form-group">
            <label class="form-label">Nama english</label>
            <input type="text" wire:model.defer="name_en" class="form-control" required>
            <label class="form-label">before</label>
            <input type="text" class="form-control" value="{{ $item->drop->name_en }}" disabled>
        </div>


        <div class="form-group" wire:ignore>
            <label class="form-label d-block">Type</label>
            <img src="{{ $item->dropType->url }}" alt="" class="avatar rounded" style="width:20px;height:20px"> {{ $item->dropType->name }}
            <label class="form-label mt-2 d-block">before</label>
            <img src="{{ $item->drop->dropType->url }}" alt="" class="avatar rounded" style="width:20px;height:20px"> {{ $item->drop->dropType->name }}
        </div>

        <div class="form-group">
            <label class="form-label">Tambahan / Note (Monster) <small class="text-muted">boleh kosong</small></label>
            <textarea name="monster" wire:model.defer='monster' rows="5" class="form-control" placeholder="Status Monster . . ."></textarea>
            <label class="form-label">before</label>
            <textarea name="monster" rows="5" class="form-control" placeholder="Status Monster . . ." disabled>{{ optional($item->drop->note)['monster'] }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Tambahan / Note (NPC) <small class="text-muted">boleh kosong</small></label>
            <textarea name="npc" wire:model.defer='npc' rows="5" class="form-control" placeholder="Status NPC . . ."></textarea>
            <label class="form-label">before</label>
            <textarea name="monster" rows="5" class="form-control" placeholder="Status npc . . ." disabled>{{ optional($item->drop->note)['npc'] }}</textarea>
        </div>

        <div class="form-group">
                <label class="form-label">Screenshot</label>

                <div id="oldpic">
                    @if ($picture)
                        <img src="{{ $picture }}" style="max-width: 100%" class="d-block"/>
                    @else
                        tanpa gambar
                    @endif

                    @if ($item->drop->picture)

                        <label class='form-label'>before</label>
                        <img src="{{ $item->drop->picture }}" style="max-width: 100%" class="d-block"/>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Full Screenshot</label>

                <div id="oldpic">
                    @if ($fullimage)
                    <img src="{{ $fullimage }}" style="max-width: 100%" class="d-block"/>
                    @else
                    tanpa gambar
                    @endif
                    @if ($item->drop->fullimage)

                        <label class='form-label'>before</label>
                        <img src="/{{ $item->drop->fullimage }}" style="max-width: 100%" class="d-block"/>
                    @endif
                </div>
            </div>

        @if ($picture || $fullimage)

        <div class="form-group">
            <label class="form-label d-block"> tambahkan beserta gambar ? </label>
            <label for="true">
                <input type="radio" name="withpic" wire:model="withpic" value="true" id="true" checked> yes
            </label>
            <label for="false">
                <input type="radio" id="false" name="withpic" wire:model="withpic" value="false"> no
            </label>
        </div>

        @endif

          <div class="form-group">
            <button class="btn btn-outline-primary btn-pill" type="submit" id="simpan">Terima +1 point</button>

            <button class="btn btn-outline-danger btn-pill" wire:click.prevent='declined'>Tolak</button>

            <span wire:loading wire:target='declined'>wait . . .</span>
          </div>

        </form>
    </div>
</div>
