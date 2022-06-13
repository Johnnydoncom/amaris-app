<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            'Ninja Power system' => "
            <p>Brand new ninja power system backup will solve all your erratic power problem and finally bid goodbye to all the embarrassment you get from power distribution companies</p>
            <p>Now you don't need to break the bank to own your own in-house power system backup
Worry no more, because the much sought after power solutions are finally here!</p>
<p>With the rapid increasing cost of power supply and the unreliable power system, you would agree that having your own economic power solution Backup is the best you can do for yourself.</p>
<p class='mt-4'>Introducing The Ninja Power System Backups</p>",
            'Electronics',
            'Gift Cards'
        ];

        foreach ($categories as $cat => $desc){
            $category = new Category();
            if(is_integer($cat)){
                $category->name = $desc;
            }else{
                $category->name = $cat;
                $category->description = nl2br($desc);
            }
            $category->save();
        }
    }
}
