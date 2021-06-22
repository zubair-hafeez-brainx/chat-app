<?php

namespace Database\Seeders;

use App\Models\Lookup;
use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupOwner = User::where('email', 'zubairhafeez56@gmail.com')->first();
        $members = User::whereIn('email', ['zubairhafeez56@gmail.com', 'umair@gmail.com', 'faizan@gmail.com', 'ali@gmail.com', 'shoaib@gmail.com'])->pluck('id')->toArray();

        $groupPhp = Group::firstOrCreate(['name' => 'php_group'], [
            'user_id' => $groupOwner->id,
            'name' => 'php_group',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        $groupPhp->members()->attach($members);

        $groupPython = Group::firstOrCreate(['name' => 'python_group'], [
            'user_id' => $groupOwner->id,
            'name' => 'python_group',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        $groupPython->members()->attach($members);
    }
}
