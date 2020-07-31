@extends('layouts.tabler')

@section('title', 'Toram Online Refine Guide')
@section('description', 'Toram guide refine, toram refine success rate, toram table success rate refine, refine guide toram, toram refine simulator')
@section('image', '/img/refine.png')


@push('canonical')
	@canonical
@endpush

@section('content')
<div class="my-5">
  <div class="container">
    <div class="page-header">
      <h3 class="page-title">Toram refine guide</h3>
    </div>


    <div class="row">
      <div class="col-md-8">
      <div class="card">
        <div class="card-body p-3">

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')

          <h3>Tentang Refine</h3>
          Gunanya refine yaitu untuk meningkatkan atk / resis perlengkapan. bonus dari refine bergantung pada apa yang kita refine. <br><br>

jika refine weapon maka weapon tersebut mendapat bonus ATK. <br>
jika refine armor maka armor tersebut mendapat bonus 1% reduce damage untuk setiap +1. <br>
dari beberapa info, refine armor tidak menambah DEF dan MDEF
<br><br>
          <img src="https://lh3.googleusercontent.com/kg8jqdnq4i2m2Rs9RyDapxlM6zlCkixgDG2ieux3YUb3jlp5-hEfywV-uJ4Wz2w_zlT9nxtTLOCW_pFAe6-pqB3Hdyk-iTxw3LeMelUdxwgg9E6cljG8Mq6RRUW_1pkGdvpfr0jDgw" width="false" height="EfywV-uJ4Wz2w_zlT9nxtTLOCW_pFAe6" />
<br><br>
<b>Formula bonus weapon ATK</b>
<pre><code>X = nilai refine (1,2,3 ... E,D,C)
Y = Base Stat
N = tambahan status

Y + N = Y*(1+(X^2/100)) + X</code></pre>

<b>contoh</b> <br>
Busur Dirga ATK 130+S
<pre><code>130 + N = 130*(1+(15^2/100))+15
130 + N = 130*3.25+15
130 + N = 437.5
N = 435.5 - 130
N = 307.5 &lt;-- bonus ATK</code></pre> <br>
<br>
<br>

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_article')

        <h3>Succes rate refine</h3>

Sukses rate refine paling rendah adalah 1%.
disini akan merangkum tentang refine dari skill smith (skill pandai besi).
<br><br>
<b>kondisi saat penjelasan</b><br>
- status TEC diisi 255 <br>
- skill smith (pandai besi): <br>
-- Tempa perlengkapan Lv10 <br>
-- Tempaan sedang Lv10 <br>
-- Tempaan tinggi Lv10 <br>
-- Tempaan Mahir Lv10
<br>
<h3>Resiko kegagalan</h3>
 <table class="table table-sm table-striped">
 <tr>
   <th>Risiko</th>
   <th>Rate gagal</th>
   <th>Rate sukses</th>
 </tr>
   <tr>
     <td>0</td>
     <td>0%</td>
     <td>100%</td>
   </tr>
   <tr>
<td>1</td>
<td>1 s/d 10%</td>
<td>90 s/d 99%</td>
</tr>
<tr>
<td>2</td>
<td>11 s/d 20%</td>
<td>80 s/d 89%</td>
</tr>
<tr>
<td>3</td>
<td>21 s/d 30%</td>
<td>70 s/d 79%</td>
</tr>
<tr>
<td>4</td>
<td>31 s/d 40%</td>
<td>60 s/d 69%</td>
</tr>
<tr>
<td>5</td>
<td>41 s/d 50%</td>
<td>50 s/d 59%</td>
</tr>
<tr>
<td>6</td>
<td>51 s/d 60%</td>
<td>40 s/d 49%</td>
</tr>
<tr>
<td>7</td>
<td>61 s/d 70%</td>
<td>30 s/d 39%</td>
</tr>
<tr>
<td>8</td>
<td>71 s/d 80%</td>
<td>20 s/d 29%</td>
</tr>
<tr>
<td>9</td>
<td>81 s/d 90%</td>
<td>10 s/d 19%</td>
</tr>
<tr>
<td>10</td>
<td>91 s/d 99%</td>
<td>1 s/d 9%</td>
</tr>
 </table>
<br><br>
<h3>Tingkat Kesulitan Refine</h3>
Sukses rate dari refine bergantung pada nilai dari refine dan bahan yang di gunakan.
<br><br>
Tingkat kesulitan refine ditentukan sebagai berikut berikut
<pre>
<code>tingkat_kesulitan_refine = nilai_refine*3 - nilai_bahan_yang_digunakan</code>
</pre>
          <br><br>

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_article')
          <br><br>

<h3>Nilai bahan yang di gunakan</h3>
 <table class="table table-sm table-striped">
<thead>
<tr>
<th>bahan</th>
<th>nilai</th>
</tr>
</thead>
<tbody>
<tr>
<td>hematite</td>
<td>1</td>
</tr>
<tr>
<td>iron</td>
<td>2</td>
</tr>
<tr>
<td>High purity iron</td>
<td>3</td>
</tr>
<tr>
<td>Damascus ore</td>
<td>4</td>
</tr>
<tr>
<td>Damascus steel</td>
<td>5</td>
</tr>
<tr>
<td>Hugh purity damascus</td>
<td>6</td>
</tr>
<tr>
<td>Mythril ore</td>
<td>7</td>
</tr>
<tr>
<td>Mythril</td>
<td>8</td>
</tr>
<tr>
<td>High purity mythril</td>
<td>9</td>
</tr>
<tr>
<td>Orichalcum ore</td>
<td>10</td>
</tr>
<tr>
<td>Orichalcum</td>
<td>11</td>
</tr>
<tr>
<td>High purity orichalcum</td>
<td>12</td>
</tr>
</tbody>
</table>
<br><br>
contoh weapon dengan refine 8, menggunakan hematite dimana hematite mempunyai nilai 1
<br><br>
 <pre><code>
tingkat kesulitan refine = 8 x 3 - 1 = 23</code>
</pre>
<br><br>
jika menggunakan Mythril dimana nilai mythril adalah 8
<br><br>
tingkat kesultian refine = 8 x 3 - 8 = 16
<br><br>
sedang kan base sukses rate sebagai berikut: <br><br>
   <table class="table table-sm table-striped">
<thead>
<tr>
<th>tingkat kesultian</th>
<th>sukses rate</th>
</tr>
</thead>
<tbody>
<tr>
<td>≤0</td>
<td>100</td>
</tr>
<tr>
<td>1-3</td>
<td>90</td>
</tr>
<tr>
<td>4</td>
<td>80</td>
</tr>
<tr>
<td>5-6</td>
<td>70</td>
</tr>
<tr>
<td>7</td>
<td>60</td>
</tr>
<tr>
<td>8</td>
<td>50</td>
</tr>
<tr>
<td>9</td>
<td>40</td>
</tr>
<tr>
<td>10</td>
<td>30</td>
</tr>
<tr>
<td>11-12</td>
<td>20</td>
</tr>
<tr>
<td>13</td>
<td>10</td>
</tr>
<tr>
<td>14-15</td>
<td>0</td>
</tr>
<tr>
<td>16</td>
<td>-10</td>
</tr>
<tr>
<td>17-18</td>
<td>-20</td>
</tr>
<tr>
<td>19</td>
<td>-30</td>
</tr>
<tr>
<td>20-21</td>
<td>-40</td>
</tr>
<tr>
<td>22</td>
<td>-50</td>
</tr>
<tr>
<td>23-24</td>
<td>-60</td>
</tr>
<tr>
<td>25</td>
<td>-70</td>
</tr>
<tr>
<td>26-27</td>
<td>-80</td>
</tr>
<tr>
<td>28</td>
<td>-90</td>
</tr>
<tr>
<td>29-31</td>
<td>-100</td>
</tr>
<tr>
<td>≥32</td>
<td>-110 </td>
</tr>
</tbody>
</table>
          <br><br>
<pre><code>final sukses rate = (base sukses rate + TEC/4  + Y ) * X
</code></pre>
<br><br>
karena disini kondisi penjelasan TEC diisi 255 dan all skill tempa lv 10 maka
<br><br>
          <pre><code>final sukses rate = (base sukses rate + 63.75 + 30 ) * 85%</code></pre>
<br><br>
<b>Note:</b> <br>
<b>Y</b> = Lv skill tempa sedang(Lv10 = +5) + Lv skill tempa tinggi(Lv10 = +10) + lv skill tempa mahir (lv10 = +15) = +30 <br>
<b>X</b> = base 50% + skill tempa Lv10(20%) + skill tempa sedang Lv10(5%) + skill tempa tinggi Lv10(5%) + wkill tempa mahir Lv10(5%) = 85%
<br><br>

  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_article')
<br><br/>
Sukses rate yang sudah kita hitung sebelumnya adalah 16, sedangkan base sukses dari 16 adalah -10 maka <br><br>
<pre><code>final sukses rate = (-10 + 63.75 +30) * 85%
final sukses rate = 83.75*85%
final sukses rate = 71 %
</code></pre> <br><br>

ingat jika hasilnya negatif (-) karena tingkat sukses paling rendah adalah 1% maka final sukses rate 1%.

<br><br>
          <h3>Degrasi</h3>
ketika gagal saat refine, nilai refine terkadang akan turun. <br>
penurunan pada non slot turun 1 nilai. <br>
penurunan pada 1 slot bisa turun 2 nilai. <br>
penurunan pada 2 slot bisa turun 3 nilai. <br>
<br>
rate penurunan bisa di kurangi dengan stats LUK dan item lainnya. contoh item yang bisa mengurangi rate penurunan adl andeg(anti degration) mengurangi rate penurunan sebesar 75%. ini cuma mengurangi rate penurunan nilai refine, tidak menambah keberhasilan refine.


  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
        </div>
      </div>
      </div>
      <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Refine</h3>
        </div>
        <div class="card-body p-3">
  @includeWhen(env('APP_ENV') == 'production', 'inc.ads_mobile')
        - <a href="/refine">Tentang Refine</a> <br>
        - <a href="/refine/simulasi">Simulasi Refine</a>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection