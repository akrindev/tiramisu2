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
        <div class="col-md-4" wire:key="{{ $food->buff }}">
            <div class="card">
                <div class="p-3 card-body">
                    <table style="border-collapse: collapse;" width="100%">
                        <tr>
                            <th width="20%">By</th>
                            <td> {{ $food->name }} </td>
                        </tr>
                        <tr>
                            <th width="20%">IGN</th>
                            <td> {{ $food->ign }} </td>
                        </tr>
                        <tr>
                            <th width="20%">Food</th>
                            <td> {{ $food->buff }} </td>
                        </tr>
                        <tr>
                            <th width="20%">Contact</th>
                            <td> {{ $food->hubungi }} </td>
                        </tr>
                        <tr>
                            <th width="20%">Bio</th>
                            <td> {{ $food->biodata }} </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    @endforeach

    <div class="col-12">
        {{ $foods->onEachSide(3)->links() }}
    </div>
<style>
th, td {
  padding: 8px;
  text-align: left;
  border: 1px solid #dddddd;
}
</style>
</div>
