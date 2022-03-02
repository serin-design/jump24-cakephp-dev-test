<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Exception\CakeException;
use Cake\Http\Client;

class RequestBinDataApiComponent extends Component
{
    /**
     * Helper method to fetch the geo data for a given postal code.
     *
     * @param string $postalCode
     * @return array
     * @throws CakeException
     */
    public function getPaginatedData(): array
    {
        $data = [];

        $nextPage = '/echo/get/json/page/1';

        do {

            $currentPage = $nextPage;

            $result = $this->fetchResult($currentPage);

            $data = array_merge($data, $result['items']);

            var_dump(compact('currentPage', 'nextPage'));
            #exit;

            $nextPage = $result['links']['next'];

        } while ($currentPage !== $nextPage);

        //var_dump(compact('data')); exit;

        return $data;
    }

    private function fetchResult(string $currentPage): array
    {
        // prepare the http client
        $http = new Client();

        // fetch the data from the api
        $response = $http->get('https://reqbin.com' . $currentPage);

        // convert response json into array
        return $response->getJson();
    }
}
