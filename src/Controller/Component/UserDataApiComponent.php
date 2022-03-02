<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\Client;
use Generator;

class UserDataApiComponent extends Component
{
    public function getAllUserData(): Generator
    {
        $currentPage = 1;

        do {

            $response = $this->fetchResponseFromApi($currentPage);

            // set the total number of pages
            $totalPages = $response['total_pages'];

            // merge users
            foreach($response['data'] as $userData) {
                yield $userData['id'] => $userData;
            }

            $currentPage++;

        } while ($totalPages > $currentPage);
    }

    /**
     * @param int $currentPage
     * @return array
     */
    private function fetchResponseFromApi(int $currentPage): array
    {
        // prepare the http client
        $http = new Client();

        // fetch the data from the api
        $response = $http->get('https://reqres.in/api/users', ['page' => $currentPage]);

        // convert response json into array
        return $response->getJson();
    }
}
