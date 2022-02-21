<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Poster;
use App\Repositories\ItemRepository;
use App\Repositories\PosterRepository;
use GuzzleHttp\Client;

class ItemService
{
    protected $itemRepo;
    protected $posterRepo;

    protected $api_url = 'http://www.omdbapi.com/';

    public function __construct( ItemRepository $itemRepo, PosterRepository $posterRepo)
    {
        $this->itemRepo = $itemRepo;
        $this->posterRepo = $posterRepo;
    } 

    public function store($request) {

        $params = $request->param;

        $client = new Client;
        $response = $client->get($this->api_url . '?' . $params);
        $response = json_decode($response->getBody(), true);
        $items = [];

        foreach ($response['Search'] as $data) 
        {
            $this->itemRepo->destroyByImdbId($data['imdbID']);

            $poster_id = $this->posterRepo->store(
                [
                    'link' => $data['Poster']
                ]
            );
            $payload = [
                'imdb_id' => $data['imdbID'],
                'title' => $data['Title'],
                'year' => $data['Year'],
                'type' => $data['Type'],
                'poster_id' => $poster_id,
            ];

            $items[] = $this->itemRepo->store($payload);
        }

        return $items;
    }
}
