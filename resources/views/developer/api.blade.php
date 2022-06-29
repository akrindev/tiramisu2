@extends('layouts.tabler')

@section('title', 'Developer API')


@section('description', 'Dokumentasi penggunaan API untuk developer')

@section('image',to_img())

@section('content')
<div class="my-5">
  <div class="container">
  <div class="page-header">
    <h3 class="page-title">Developer API</h3>
  </div>

    <div class="row">
      <div class="col-md-8">
      <div class="card">
        <div class="card-body body-text p-3">
            <p>
                API merupakan kepanjangan dari Application Programming Interface (Antarmuka Pemrograman Aplikasi). Kata Antarmuka dapat diartikan sebagai komunikasi layanan antara dua aplikasi. Dimana biasanya terdapat dua arah komunikasi antar server dengan client atau bahasa lainnya adalah response dan request.
            </p>
            <p>
                Bearer authentication (autentikasi dengan token) merupakan skema autentikasi HTTP dengan menggunakan keamanan token yang disebut bearer token. Bearer token berbentuk string yang terenkripsi dari sisi server yang mana akan digunakan sebagai metode autentikasi. kemudian client menyimpan token tersebut. Client wajib menyertakan bearer token untuk mengakses API sebagaimana diperlukan untuk mengidentifikasi client.
            </p>
            <p>
                Untuk itu kamu dapat mendapatkan token melalui menu edit user, kemudian klik generate token. <br>
                <img src="https://cloudflare-ipfs.com/ipfs/QmP7uVsgXAVGxgjbZJmZBHxuiXrr3fWedjFyfMZfTwz1Sq" alt="generate token" class="">
            </p>
            <p>
                Jika akses token berhasil dibuat, maka kamu dapat mengakses API dengan menggunakan method GET. <br>
                <img src="https://cloudflare-ipfs.com/ipfs/QmbdmhnpxwCSBMWNXVEowiMZMsB4oAZBf5SP4BQc17181t" alt="generate token" class="">
            </p>
            <p>
                Berikut ini adalah contoh menggunakan bearer token.
                <pre>
                    <code class="language-javascript">const token = '{{ str()->random(40) }}';

axios.get('https://toram-id.info/api/v1/items', {
    headers: {
        'Content-Type': 'application/json',
        Authorization: 'Bearer ' + token
    }
})
.then((response) => console.log(response))
.catch((err) => console.error(err));</code></pre>

            </p>

            <br><br>
            <p>
                <strong>Berikut ini adalah list route API yang dapat kamu gunakan</strong>
                <ul>
                    <li>
                        <strong>Menampilkan items yang terakhir ditambahkan</strong> <br>
                        <code>GET https://toram-id.info/api/v1/items</code> <br>
                        <strong>Contoh response</strong> <br>
                        <pre><code class="language-json">[
	{
		"id": 3762,
		"drop_type_id": 32,
		"name": "Cincin Mulia (pedang sihir)",
		"name_en": "Cincin Mulia (pedang sihir)",
		"proses": null,
		"sell": null,
		"note": {
			"monster": "Base DEF : 0\r\n\r\nMaxMP +500 ATK +3%\r\nMATK +3%\r\nDengan Pesawat Sihir\r\nKecepatan Serangan +25%\r\nKecepatan Merapal +25%",
			"npc": null
		},
		"picture": null,
		"fullimage": null,
		"released": null,
		"drop_type": {
			"id": 32,
			"name": "Perkakas Special",
			"url": "https:\/\/toram-id.info\/img\/drop\/tambahan.jpg"
		},
		"monsters": []
	},
    ...
]</code></pre>
                    </li>
                    <li>
                        <strong>Menampilkan jenis items atau kategori items. contoh: pedang, staff, zirah, etc</strong> <br>
                        <code>GET https://toram-id.info/api/v1/items/type</code> <br>
                        <strong>Contoh response</strong> <br>
                        <pre><code class="language-json">[
	{
		"id": 1,
		"name": "logam",
		"url": "https:\/\/toram-id.info\/img\/drop\/logam.png"
	},
	{
		"id": 2,
		"name": "kain",
		"url": "https:\/\/toram-id.info\/img\/drop\/kain.png"
	},
	{
		"id": 3,
		"name": "fauna",
		"url": "https:\/\/toram-id.info\/img\/drop\/fauna.png"
	},
    ...
]</code></pre>
                    </li>
                    <li>
                        <strong>Menampilkan items berdasarkan jenisnya.</strong> <br>
                        <code>GET https://toram-id.info/api/v1/items/{items_type}</code> <br>
                        <code>GET https://toram-id.info/api/v1/items/31</code> <br>
                        <strong>Contoh response</strong> <br>
                        <pre><code class="language-json">{
	"current_page": 1,
	"data": [
		{
			"id": 3648,
			"drop_type_id": 31,
			"name": "Ocean Dancer",
			"name_en": "Ocean Dancer",
			"proses": null,
			"sell": null,
			"note": {
				"monster": null,
				"npc": "Base DEF: 94\n\nUntradable\nAttack MP Recovery +10\nAttack Speed +1000\nEvasion Recharge +30%\nDodge +20%\nAbsolute Dodge +10%\nWind Resistance -70%"
			},
			"picture": null,
			"fullimage": null,
			"released": null,
			"drop_type": {
				"id": 31,
				"name": "zirah",
				"url": "https:\/\/toram-id.info\/img\/drop\/zirah.jpg"
			},
			"monsters": []
		},
        ...
]</code></pre>
                    </li>
                    <li>
                        <strong>Menampilkan item yang dipilih.</strong> <br>
                        <code>GET https://toram-id.info/api/v1/item/{item_id}</code> <br>
                        <code>GET https://toram-id.info/api/v1/item/2000</code> <br>
                        <strong>Contoh response</strong> <br>
                        <pre><code class="language-json">{
	"id": 2000,
	"drop_type_id": 4,
	"name": "Shide Merah Putih",
	"name_en": "Red and White Shide",
	"proses": null,
	"sell": null,
	"note": null,
	"picture": null,
	"fullimage": null,
	"released": null,
	"drop_type": {
		"id": 4,
		"name": "kayu",
		"url": "https:\/\/toram-id.info\/img\/drop\/kayu.png"
	},
	"monsters": [],
}</code></pre>
                    </li>
                    <li>
                        <strong>Menampilkan monster yang terakhir ditambahkan.</strong> <br>
                        <code>GET https://toram-id.info/api/v1/monsters</code> <br>
                        <strong>Contoh response</strong> <br>
                        <pre><code class="language-json">[
	{
		"id": 1430,
		"map_id": 52,
		"element_id": 7,
		"name": "Velum",
		"name_en": "Velum",
		"level": 223,
		"type": 3,
		"hp": "4,260,000",
		"xp": 20600,
		"pet": "y",
		"picture": "https:\/\/toram-id.info\/imgs\/mobs\/velum13Grypng",
		"element": {
			"id": 7,
			"name": "netral"
		}
	},
	{
		"id": 1429,
		"map_id": 386,
		"element_id": 1,
		"name": "Kadal Obsidian",
		"name_en": "Obsidian Lizard",
		"level": 180,
		"type": 1,
		"hp": "15,000",
		"xp": 252,
		"pet": "y",
		"picture": null,
		"element": {
			"id": 1,
			"name": "air"
		}
	},
    ...
]</code></pre>
                </li>
                <li>
                    <strong>Menampilkan monster berdasarkan jenisnya.</strong>
                    <p>jenis_id:
                        <ul>
                            <li>1 = Normal Monster</li>
                            <li>2 = Mini Boss Monster</li>
                            <li>3 = Boss Monster</li>
                        </ul>
                    </p>
                    <br>
                    <code>GET https://toram-id.info/api/v1/monsters/{jenis_id}</code> <br>
                    <code>GET https://toram-id.info/api/v1/monsters/3</code>
                    <strong>Contoh response</strong> <br>
                    <pre><code class="language-json">{
	"current_page": 1,
	"data": [
		{
			"id": 16,
			"map_id": 116,
			"element_id": 7,
			"name": "Mozto Machina (Easy)",
			"name_en": "Mozto Machina (Easy)",
			"level": 114,
			"type": 3,
			"hp": "111,000",
			"xp": 1224,
			"pet": "n",
			"picture": null,
			"element": {
				"id": 7,
				"name": "netral"
			},
			"drops": [
				{
					"id": 976,
					"drop_type_id": 3,
					"name": "Sisik Chimera",
					"name_en": "Chimera Scale",
					"proses": null,
					"sell": null,
					"note": null,
					"picture": null,
					"fullimage": null,
					"released": null,
					"pivot": {
						"monster_id": 16,
						"drop_id": 976
					},
					"drop_type": {
						"id": 3,
						"name": "fauna",
						"url": "https:\/\/toram-id.info\/img\/drop\/fauna.png"
					}
				},
				{
					"id": 977,
					"drop_type_id": 3,
					"name": "Cakar Chimera",
					"name_en": "Chimera Claw",
					"proses": null,
					"sell": null,
					"note": null,
					"picture": null,
					"fullimage": null,
					"released": null,
					"pivot": {
						"monster_id": 16,
						"drop_id": 977
					},
					"drop_type": {
						"id": 3,
						"name": "fauna",
						"url": "https:\/\/toram-id.info\/img\/drop\/fauna.png"
					}
				},
                ...
			]
		},
    ]
}</code></pre>
                    </li>
                    <li>
                        <strong>Menampilkan monster yang dipilih.</strong> <br>
                        <code>GET https://toram-id.info/api/v1/monster/{monster_id}</code> <br>
                        <strong>Contoh response</strong> <br>
                        <pre><code class="language-json">{
	"id": 500,
	"map_id": 37,
	"element_id": 7,
	"name": "Memecoleous (Nightmare)",
	"name_en": "Memecoleous (Nightmare)",
	"level": 120,
	"type": 3,
	"hp": "6,450,000",
	"xp": null,
	"pet": "n",
	"picture": null,
	"element": {
		"id": 7,
		"name": "netral"
	},
	"drops": [
		{
			"id": 450,
			"drop_type_id": 46,
			"name": "Evil Beast Arrow",
			"name_en": "Evil Beast Arrow",
			"proses": null,
			"sell": null,
			"note": {
				"monster": "Base ATK: 100 (20%)\r\n\r\nJika busur digunakan\r\nAttack MP Recovery +3\r\nDaya Jarak Dekat -10%\r\n\r\n**",
				"npc": "**\r\nBase ATK: 100 (20%)\r\n        Critical Rate +3\r\nCritical Damage +1"
			},
			"picture": null,
			"fullimage": null,
			"released": null,
			"pivot": {
				"monster_id": 500,
				"drop_id": 450
			},
			"drop_type": {
				"id": 46,
				"name": "panah",
				"url": "https:\/\/toram-id.info\/img\/drop\/panah.jpg"
			}
		},
		{
			"id": 647,
			"drop_type_id": 33,
			"name": "Topi Gotik",
			"name_en": "Gothic Hat",
			"proses": null,
			"sell": null,
			"note": {
				"monster": "Base DEF: 35\r\n\r\nCritical Rate +14\r\nDaya Jarak Dekat +1%\r\nDaya Jarak Jauh -1%",
				"npc": null
			},
			"picture": "https:\/\/toram-id.info\/imgs\/mobs\/topi-gotik-54721.png",
			"fullimage": null,
			"released": null,
			"pivot": {
				"monster_id": 500,
				"drop_id": 647
			},
			"drop_type": {
				"id": 33,
				"name": "Perkakas Tambahan",
				"url": "https:\/\/toram-id.info\/img\/drop\/pelengkap.jpg"
			}
		},
        ...
	],
	"map": {
		"id": 37,
		"name": "Istana Gelap: Area 2",
		"name_en": "Dark Castle: Area 2"
	}
}</code></pre>
                    </li>
                </ul>
            </p>
        </div>
      </div>
      </div>

      {{-- trakteer --}}
      <div class="col-md-4">
          <div class="card">
              <div class="card-header">
                  <h2 class="card-title">Merasa terbantu dengan website ini?</h2>
              </div>
              <div class="card-body">
                  <script type='text/javascript' src='https://cdn.trakteer.id/js/embed/trbtn.min.js'></script><script type='text/javascript'>(function(){var trbtnId=trbtn.init('Dukung Saya di Trakteer','#be1e2d','https://trakteer.id/akrindev/tip','https://cdn.trakteer.id/images/embed/trbtn-icon.png','40');trbtn.draw(trbtnId);})();</script>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('head')
<link href="/assets/css/read.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://unpkg.com/@highlightjs/cdn-assets@11.5.1/styles/github.min.css">
@endsection

@section('footer')
<script src="https://unpkg.com/@highlightjs/cdn-assets@11.5.1/highlight.min.js"></script>
<!-- and it's easy to individually load additional languages -->
<script src="https://unpkg.com/@highlightjs/cdn-assets@11.5.1/languages/javascript.min.js"></script>
<script src="https://unpkg.com/@highlightjs/cdn-assets@11.5.1/languages/json.min.js"></script>
<script>hljs.highlightAll();</script>
@endsection
