<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlatformTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platforms = [
            'iTunes',
            'Google Play',
            'Microsoft'
        ];

        foreach ($platforms as $platform){
            $pf = Platform::create(['name' => $platform]);
            $pf
                ->addMediaFromUrl(Storage::disk('public')->url(Str::slug($platform).'.webp'))
                ->toMediaCollection('featured_image');
        }
    }
}
