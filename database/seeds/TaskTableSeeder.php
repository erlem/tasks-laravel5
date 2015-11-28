<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        DB::table('tasks')->insert(
            [
                'title' => 'Task 1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lacinia ante metus, ut congue sem facilisis et. Sed convallis leo malesuada, lobortis nulla eu, scelerisque ipsum. Pellentesque vel sapien justo. Sed in augue mollis, sagittis urna non, tincidunt lectus. Interdum et malesuada fames ac ante ipsum primis in faucibus. In sed diam vitae lectus tempus dictum non nec est. Aliquam dignissim nibh vel fringilla finibus. Sed rhoncus tempus ante nec interdum. Proin ac nibh euismod, molestie arcu sit amet, sagittis ante. Aliquam a vestibulum leo.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
        DB::table('tasks')->insert(
            [
                'title' => 'Task 2',
                'description' => 'Duis faucibus tellus nec odio auctor, quis pulvinar lorem gravida. Aliquam sed turpis volutpat, aliquam nisl sed, maximus leo. Ut sollicitudin tincidunt augue, a pulvinar nunc porta vitae. Nunc molestie auctor magna, eleifend imperdiet turpis laoreet maximus. Vestibulum dapibus tortor nec lorem euismod, ut ultrices tortor tristique. Morbi eget dolor malesuada, tincidunt diam eget, dictum tellus. Donec eget tellus sem. Donec volutpat est dignissim pharetra accumsan. Donec condimentum massa massa, ac imperdiet sapien accumsan at. Sed posuere odio in magna sodales egestas. Ut mauris massa, luctus ut lacus et, fermentum volutpat velit.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
        DB::table('tasks')->insert(
            [
                'title' => 'Task 3',
                'description' => 'Integer ultricies semper nisl, ut consectetur nunc consectetur sed. Nunc sodales ac lectus pulvinar volutpat. Integer vestibulum tristique leo. Cras pellentesque gravida dolor iaculis tincidunt. Pellentesque vehicula mi at volutpat varius. Duis ultricies congue nulla, in vulputate neque gravida non. Donec justo diam, euismod ac gravida quis, varius at eros. Morbi ornare orci nec ligula tempus scelerisque. Cras convallis pharetra sollicitudin. Phasellus iaculis risus id risus blandit fermentum. Donec felis diam, facilisis vel accumsan non, eleifend nec nisi. Sed felis lorem, condimentum eu venenatis at, lacinia a elit. Donec condimentum tellus felis, non rhoncus est pellentesque non. Nam nec metus quis leo tempor sodales non eget metus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean varius magna sed mattis posuere.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }
}
