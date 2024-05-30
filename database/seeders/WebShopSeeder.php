<?php

namespace Database\Seeders;

use App\Models\Webshop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Throwable;

class WebShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webshops = $this->getDataToSeed();
        foreach ($webshops as $webshop) {
            try{
                Webshop::updateOrCreate(
                    [
                        'name'  =>  $webshop['name']
                    ]
                    ,
                    $webshop);
            }catch(Throwable $e)
            {
                dd($e->getMessage() , $e->getLine());
            }
        }
    }

    protected function getDataToSeed(): array
    {
        return [
            //1
            [
                'name' => 'Bol.com',
                'icon' => 'webshops/bol-logo.jpg',
                'api_url' => 'localhost:8000',
            ]
        ];
    }
}
