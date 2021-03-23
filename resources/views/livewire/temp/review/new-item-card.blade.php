<div class="card mb-5">
    <div class="card-body p-3">

        <form wire:submit.prevent='accept' enctype="multipart/form-data" method="post">

        <div class="form-group">
            <label class="form-label d-block">Di tambahkan oleh</label>
            {{ $item->user->name ?? 'guest' }} pada {{ $item->created_at }}
        </div>
        <div class="form-group">
            <label class="form-label">Nama indo</label>
            <input type="text" wire:model.defer="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Nama english</label>
            <input type="text" wire:model.defer="name_en" class="form-control" required>
        </div>


        <div class="form-group" wire:ignore>
            <label class="form-label d-block">Type</label>
            <img src="{{ $item->dropType->url }}" alt="" class="avatar rounded" style="width:20px;height:20px"> {{ $item->dropType->name }}
        </div>

        <div class="form-group">
            <label class="form-label">Tambahan / Note (Monster) <small class="text-muted">boleh kosong</small></label>
            <textarea name="monster" wire:model.defer='monster' rows="5" class="form-control" placeholder="Status Monster . . ."></textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Tambahan / Note (NPC) <small class="text-muted">boleh kosong</small></label>
            <textarea name="npc" wire:model.defer='npc' rows="5" class="form-control" placeholder="Status NPC . . ."></textarea>
        </div>

        <div class="form-group">
                <label class="form-label">Screenshot</label>

                <div id="oldpic">
                    @if ($picture)
                        <img src="{{ $picture }}" style="max-width: 100%" class="d-block"/>
                    @else
                    tanpa gambar
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

            <button class="btn btn-outline-danger btn-pill" wire:click.prevent='cancel'>Tolak</button>
          </div>

        </form>
    </div>
</div>
