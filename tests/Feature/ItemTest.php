<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;


class ItemTest extends TestCase
{
    /**
     * test create item.
     *
     * @return void
     */
    public function test_create_item()
    {
        
        $response = $this->json('POST','api/item',[
            'param' => "s=Matrix&apikey=720c3666",
        ]);

        //Write the response in laravel.log
        Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test get all items.
     *
     * @return void
     */
    public function test_get_all_items()
    {
        $response = $this->json('GET','api/item');

        //Write the response in laravel.log
        Log::info(2, [$response->getContent()]);

        $response->assertStatus(200);
    }
}
