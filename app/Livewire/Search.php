<?php

namespace App\Livewire;

use App\Drop;
use App\Formula;
use App\Forum;
use App\LogSearch;
use App\Map;
use App\Monster;
use App\Setting;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $q;

    public $type;

    public $locale;

    protected $queryString = ['q', 'type'];

    protected $listeners = [
        'getResult',
    ];

    public function mount($q)
    {
        $this->q = $q;
        $this->locale = request()->segment(1) == 'en' ? 'en' : 'id';
    }

    public function render()
    {
        $q = trim($this->q);

        // Validation: minimum length
        if (strlen($q) < 2) {
            return redirect('/')->with('gagal', 'Mencari harus memiliki 2 karakter atau lebih');
        }

        // Block word based validation - check for bad words anywhere in the query
        $badword = Setting::first();
        if ($badword && isset($badword->body['badword'])) {
            $badwords = explode(',', $badword->body['badword']);
            $badwords = array_map('trim', array_map('strtolower', $badwords));

            foreach ($badwords as $word) {
                if ($word && stripos(strtolower($q), $word) !== false) {
                    return redirect('/')->with('gagal', 'Pencarian mengandung kata yang tidak pantas');
                }
            }
        }

        // delete log search older than 7 days
        LogSearch::where('created_at', '<', now()->subDays(7))->delete();

        // dont write log if it bot
        if (! $this->isBot()) {
            LogSearch::create([
                'user_id' => auth()->id() ?? null,
                'q' => $q,
            ]);
        }

        $type = $this->type == 'status_only' ? 'note' : 'name';

        $this->setLocale($this->locale);

        $drops = Drop::search($type, $q)
            ->when($type == 'name', function ($query) use ($q) {
                return $query->orWhere('name_en', 'like', '%' . $q . '%');
            })
            ->when($type == 'note', function ($query) use ($q) {
                $term = translate($q, true);

                return $query->orWhere('note', 'like', '%' . $term . '%');
            })
            ->with([
                'monsters' => function ($query) {
                    $query->with(['map', 'element']);
                },
                'dropType',
            ])
            ->orderBy('drop_type_id')
            ->paginate(50);

        $monsters = Monster::search('name', $q)
            ->when($type == 'name', function ($query) use ($q) {
                return $query->orWhere('name_en', 'like', '%' . $q . '%');
            })
            ->with([
                'drops' => function ($query) {
                    $query->with('dropType');
                },
                'map',
                'element',
            ])
            ->orderBy('name')->get();

        $maps = Map::search('name', $q)
            ->orderBy('name')
            ->get();

        $forums = Forum::search('judul', $q)
            ->orderBy('judul')
            ->get();

        $formulas = Formula::search('note', $q)
            ->latest()->take(50)
            ->get();

        return view('livewire.search', compact('drops', 'monsters', 'maps', 'forums', 'formulas'));
    }

    public function getResult($q)
    {
        $this->q = $q[0];
        $this->type = $q[1];
    }

    public function switchLocalization($locale)
    {
        $this->locale = $locale;
    }

    public function setLocale($locale)
    {
        if (in_array($locale, ['en', 'id'])) {
            App::setLocale($locale);
        }
    }

    // check if it a bot
    private function isBot()
    {
        if (preg_match('/mediapartners|googlebot|bingbot|bot/i', request()->server('HTTP_USER_AGENT'))) {
            return true;
        }
    }
}
