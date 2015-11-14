<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PageTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('pages')->insert(array(

            array(
                'id' => 1,
                'name' => 'Home',
                'slug' => 'home',
                'heading' => 'Home',
                'title' => 'Home',
                'content' => 'Home Page',
                'keyword' => NULL,
                'description' => NULL,
                'images' => NULL,
                'abstract' => NULL,
                'order' => 0,
                'banner' => NULL,
                'view' => 'page',
                'compiler' => NULL,
                'status' => 1
            ),

            array(
                'id' => 2,
                'name' => 'About Us',
                'slug' => 'about-us',
                'heading' => 'About Us',
                'title' => 'About Us',
                'content' => 'About Us',
                'keyword' => NULL,
                'description' => NULL,
                'images' => NULL,
                'abstract' => NULL,
                'order' => 0,
                'banner' => NULL,
                'view' => 'page',
                'compiler' => NULL,
                'status' => 1
            ),

            array(
                'id' => 3,
                'name' => 'Contact Us',
                'heading' => 'Contact Us',
                'title' => 'Contact Us',
                'content' => '<p><br></p>',
                'keyword' => NULL,
                'description' => NULL,
                'images' => NULL,
                'abstract' => NULL,
                'slug' => 'contact',
                'order' => 0,
                'banner' => NULL,
                'view' => 'page',
                'compiler' => NULL,
                'status' => 1
            ),

            array(
                'id' => 4,
                'name' => 'Page Not found',
                'heading' => 'Page Not found',
                'title' => 'Page Not found',
                'content' => '<p><br></p>',
                'keyword' => NULL,
                'description' => NULL,
                'images' => NULL,
                'abstract' => NULL,
                'slug' => 404,
                'order' => 0,
                'banner' => NULL,
                'view' => 'page',
                'compiler' => NULL,
                'status' => 1
            ),

        ));

        DB::table('permissions')->insert(array(
            array(
                'name' => 'page.page.view',
                'readable_name' => 'View Page'
            ),
            array(
                'name' => 'page.page.create',
                'readable_name' => 'Create Page'
            ),
            array(
                'name' => 'page.page.edit',
                'readable_name' => 'Update Page'
            ),
            array(
                'name' => 'page.page.delete',
                'readable_name' => 'Delete Page'
            )
        ));

    }
}
