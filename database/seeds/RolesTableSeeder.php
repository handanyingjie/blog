<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $admin = \App\Models\Role::create([
//            'name' => '管理员',
//            'slug' => 'admin',
//            'permissions' => [
//                'create-post' => true,
//                'update-post' => true,
//                'publish-post' => true,
//                'delete-post' => true
//            ]
//        ]);
        $author = \App\Models\Role::create([
            'name' => '作家',
            'slug' => 'author',
            'permissions' => [
                'create-post' => true
            ]
        ]);

        $editor = \App\Models\Role::create([
            'name' => '编辑',
            'slug' => 'editor',
            'permissions' => [
                'update-post' => true,
                'publish-post' => true,
                'delete-post' => true
            ]
        ]);
    }
}
