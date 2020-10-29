<?php

namespace App\Helpers;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

use App;

class TranslateText
{
    protected $replace = [
        "stronger against Water" => "luka ke Air",
        "stronger against Wind" => "luka ke Angin",
        "stronger against Fire" => "luka ke Api",
        "stronger against Earth" => "luka ke Bumi",
        "stronger against Light" => "luka ke Cahaya",
        "stronger against Dark" => "luka ke Gelap",
        "stronger against Neutral" => "luka ke Normal",
        "Absolute Accuracy" => "Absolute Accuracy",
        "Absolute Dodge" => "Absolute Dodge",
        "Aggro" => "Aggro",
        "AGI" => "AGI",
        "Anticipate" => "Antisipasi",
        "ATK" => "ATK",
        "Base ATK" => "ATK Dasar",
      "ATK DOWN (AGI)" => "ATK DOWN (AGI)",
      "ATK DOWN (DEX)" => "ATK DOWN (DEX)",
      "ATK DOWN (INT)" => "ATK DOWN (INT)",
      "ATK DOWN (STR)" => "ATK DOWN (STR)",
      "ATK DOWN (VIT)" => "ATK DOWN (VIT)",
      "ATK UP (AGI)" => "ATK UP (AGI)",
      "ATK UP (DEX)" => "ATK UP (DEX)",
      "ATK UP (INT)" => "ATK UP (INT)",
      "ATK UP (STR)" => "ATK UP (STR)",
      "ATK UP (VIT)" => "ATK UP (VIT)",
      "Attack MP Recovery" => "Attack MP Recovery",
      "Barrier Cooldown" => "Barrier Cooldown",
      "Tumble Unavailable" => "Berhenti Jatuh",
      "Flinch Unavailable" => "Berhenti Bergidik",
      "Stun Unavailable" => "Berhenti Pingsan",
      "Critical Damage" => "Critical Damage",
      "Critical Rate" => "Critical Rate",
      "Damage from Boss" => "Damage dari Boss",
      "Damage to Boss" => "Damage ke Boss",
      "Short Range Damage" => "Daya Jarak Dekat",
      "Long Range Damage" => "Daya Jarak Jauh",
      "DEF" => "DEF",
      "Base DEF" => "DEF Dasar",
      "DEX" => "DEX",
      "Dodge" => "Dodge",
      "Drop Rate" => "Drop Rate",
      "Base Drop Rate" => "Drop Rate",
      "Evasion Recharge" => "Evasion Recharge",
      "EXP Gain" => "EXP Gain",
      "Guard Power" => "Guard Power",
      "Guard Recharge" => "Guard Recharge",
      "HP" => "HP",
      "INT" => "INT",
      "Invicible Aid (sec)" => "Invicible Aid (sec)",
      "Item Cooldown" => "Item Cooldown",
      "Water resistance" => "Kebal Air",
      "Wind resistance" => "Kebal Angin",
      "Fire resistance" => "Kebal Api",
      "Earth resistance" => "Kebal Bumi",
      "Light resistance" => "Kebal Cahaya",
      "Dark resistance" => "Kebal Gelap",
      "Neutral Resistance" => "Kebal Normal",
      "Motion Speed" => "Kecepatan Gerak",
      "CSPD" => "Kecepatan Merapal",
      "ASPD" => "Kecepatan Serangan",
      "ASPD" => "Kecepatan Serangan",
      "Physical Resistance" => "Kekebalan Fisik",
      "Magical Resistance" => "Kekebalan Sihir",
      "MATK" => "MATK",
      "MATK DOWN (AGI)" => "MATK DOWN (AGI)",
      "MATK DOWN (DEX)" => "MATK DOWN (DEX)",
      "MATK DOWN (INT)" => "MATK DOWN (INT)",
      "MATK DOWN (STR)" => "MATK DOWN (STR)",
      "MATK DOWN (VIT)" => "MATK DOWN (VIT)",
      "MATK UP (AGI)" => "MATK UP (AGI)",
      "MATK UP (DEX)" => "MATK UP (DEX)",
      "MATK UP (INT)" => "MATK UP (INT)",
      "MATK UP (STR)" => "MATK UP (STR)",
      "MATK UP (VIT)" => "MATK UP (VIT)",
      "MaxHP" => "MaxHP",
      "MaxMP" => "MaxMP",
      "MDEF" => "MDEF",
      "Physical Barrier" => "Pelindung Fisik",
      "Fractional Barrier" => "Pelindung Fraksional",
      "Magic Barrier" => "Pelindung Sihir",
      "Physical Pierce" => "Penetrasi Fisik",
      "Magic Pierce" => "Penetrasi Sihir",
        "Guard Break" => "Pertahanan Hancur",
      "Reduce Dmg (Straight Line)" => "Reduce Dmg (Straight Line)",
      "Reduce Dmg (Bowling)" => "Reduksi Dmg (Bowling)",
      "Reduce Dmg (Charge)" => "Reduksi Dmg (Charge)",
      "Reduce Dmg (Floor)" => "Reduksi Dmg (Floor)",
      "Reduce Dmg (Meteor)" => "Reduksi Dmg (Meteor)",
      "Reduce Dmg (Bullet)" => "Reduksi Dmg (Peluru)",
      "Reduce Dmg (Foe Epicenter)" => "Reduksi Dmg (Sekitar Musuh)",
      "Reduce Dmg (Player Epicenter)" => "Reduksi Dmg (Sekitar Pemain)",
      "Refine Success Rate (flat)" => "Refine Success Rate (flat)",
      "Reflect" => "Refleks",
      "Ailment Resistance" => "Resistensi Status Buruk",
      "Unsheathe Attack" => "Serangan Menghunus",
      "Stability" => "Stability",
      "Base Stability" => "Stability Dasar",
      "STR" => "STR",
      "Additional Melee" => "Tambahan Fisik",
      "Additional Magic" => "Tambahan Sihir",
      "Thrust Resistance" => "Thrust Resistance",
      "Water Element" => "Unsur Air",
      "Wind Element" => "Unsur Angin",
      "Fire Element" => "Unsur Api",
      "Earth Element" => "Unsur Bumi",
      "Light Element" => "Unsur Cahaya",
      "Dark Element" => "Unsur Gelap",
      "Upgrade for" => "Upgrade for",
      "VIT" => "VIT",
      "Revive Time" => "Waktu Bangkit",
      "Weapon ATK" => "Weapon ATK",
      "Untradable" => "Nonbarter"
];

    public function translate($text, $reverse = false)
    {
        if(App::isLocale('en')) {
            $text = $this->replace($text);
        }

        if($reverse) {
            $text = $this->reverse($text);
        }

        return new HtmlString($text);
    }

    protected function replace($text)
    {
        foreach($this->replace as $en => $id)
        {
      		$text = Str::replaceFirst($id, $en, $text);
        }

        return $text;
    }

    protected function reverse($text)
    {
        foreach($this->replace as $en => $id)
        {
      		$text = Str::replaceFirst($en, $id, $text);
        }

        return $text;
    }
}