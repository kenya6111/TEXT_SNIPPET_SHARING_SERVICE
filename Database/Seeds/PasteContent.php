<?php
    
namespace Database\Seeds;
use Carbon\Carbon;
use Database\AbstractSeeder;
use Faker;
require_once 'vendor/autoload.php';

class PasteContent extends AbstractSeeder {

    // TODO: tableName文字列を割り当ててください。
    protected ?string $tableName = "PasteContent";

    // TODO: tableColumns配列を割り当ててください。
    protected array $tableColumns = [
        [
            'data_type' => 'int',
            'column_name' => 'snippet_id'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'title'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'content'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'url'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'syntax'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'expired_limit'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'created_at'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'updated_at'
        ]
    ];

    public function createRowData(): array
    {$faker = Faker\Factory::create('ja_JP');
        $data = [];
        for($i=0; $i<10; $i++){
            $data[]=[
                $i+1,
                $faker->name,
                $faker->name,
                $faker->name,
                $faker->name,
                $faker->date(),
                $faker->date(),
                $faker->date()

            ];

        }

        return $data;
        // TODO: createRowData()メソッドを実装してください。
        return [];
    }
}
