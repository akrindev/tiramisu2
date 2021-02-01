<div class="container-fluid">
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Registled</h1>
      </div>

	<div class="row">
	@foreach($drops as $drop)
		@livewire('registled-card', ['drop' => $drop], key($drop->id))
	@endforeach

		<div class="col-12">
			<div wire:loading>
				<div class="alert alert-success">Loading . . .</div>
			</div>

			{{ $drops->onEachSide(1)->links() }}
		</div>
	</div>
</div>