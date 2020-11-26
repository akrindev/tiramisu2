<div class="row">

    <div class="col-md-4">
        <div class="form-group">
            <select name="buff" wire:model="buff" id="" class="form-control">
                <option value="all">All</option>
                @foreach (\App\Cooking::get() as $buff)
                    <option value="{{ $buff->id }}"> {{ $buff->buff }} </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12"></div>
    @foreach ($foods as $food)
        @livewire('food-card', ['food' => $food], key($food->id))
    @endforeach

    <div class="col-12">
        {{ $foods->onEachSide(1)->links() }}
    </div>
<style>
th, td {
  padding: 8px;
  text-align: left;
  border: 1px solid #dddddd;
}
</style>
</div>
