<?php

namespace Database\Seeders;

use App\Models\Post as PostModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Post extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostModel::factory(20)->create();
    }
}
