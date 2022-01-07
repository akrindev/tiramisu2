<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Drop;

class AppearanceController extends Controller
{
    /**
     * items
     *
     * @var array
     */
    protected $items = [
        26, 27, 28, 29,
        13, 14, 30, 15,
        25, 31, 33, 43
    ];

    /**
     * show items that has image
     *
     * @return void
     */
    public function show()
    {
        $apps = Drop::select(['id', 'name', 'name_en', 'drop_type_id', 'picture', 'fullimage'])
            ->whereIn('drop_type_id', $this->items)
            ->whereNotNull('picture')
            ->orderByDesc('id')
            ->paginate();

        return view('appearance.show', compact('apps'));
    }

    /**
     * show items that has image by type
     *
     * @param  mixed $type
     * @return void
     */
    public function type($type)
    {
        $apps = Drop::select(['id', 'name', 'name_en', 'drop_type_id', 'picture', 'fullimage'])
            ->where('drop_type_id', $type)
            ->whereNotNull('picture')
            ->orderByDesc('id')
            ->paginate();

        $type = Str::title($apps->first()->dropType->name);

        return view('appearance.show', compact('apps', 'type'));
    }
}
