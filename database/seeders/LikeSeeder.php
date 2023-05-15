<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Like;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('likes')->truncate();
        $j = 50;
        $arr = [];
        $now = Carbon::now();
        for ($i=1; $i <= 50 ; $i++) {
            $arr[] = [
                'user_id' => $i,
                'comment_id' => $j,
                'created_at' => $now,
                'updated_at' => $now
            ];
            $j--;
        }
        Like::insert($arr);
    }
}
