<div class="col-md-4">
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
                    <td> {{ $food->buff }} (Lv {{ $food->cooking_level}}) </td>
                </tr>
                <tr>
                    <th width="20%">Second Food</th>
                    <td> {{ $food->second_buff }} {{ $food->second_cooking_level != null ? "(Lv {$food->second_cooking_level})" : '' }} </td>
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