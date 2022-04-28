<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d');
        $req_url = "https://api.exchangerate.host/{$date}?base=USD";
        $response_json = file_get_contents($req_url);
        if (false !== $response_json) {
            try {
                $response = json_decode($response_json);
                if ($response->success === true) {
                    foreach ($response->rates as $coin => $value) {
                        \App\Models\Coin::create([
                                'name' => $coin,
                                'price' => $value,
                                'time' => date('H:i:s'),
                            ]
                        );
                    }
                }
            } catch (\Exception $e) {
                // Handle JSON parse error...
            }
        }
    }
}
