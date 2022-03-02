<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Exception\CakeException;
use Cake\Http\Client;

class PostalCodeDataApiComponent extends Component
{
    /**
     * Helper method to fetch the geo data for a given postal code.
     *
     * @param string $postalCode
     * @return array
     * @throws CakeException
     */
    public function getData(string $postalCode): array
    {
        // validate the postal code before we make the api call
        $this->validate($postalCode);

        // prepare the http client
        $http = new Client();

        // fetch the data from the api
        $response = $http->get('https://api.getthedata.com/postcode/' . rawurlencode($postalCode));

        // convert response json into array
        $json = $response->getJson();

        // check that we have a status value and that is set to 'match'.
        if (empty($json['status'] || $json['status'] !== 'match')) {
            throw new CakeException('Could not find postcode: ' . $postalCode);
        }

        // check that we have any data to return
        if (empty($json['data'])) {
            throw new CakeException('No data found for postcode: ' . $postalCode);
        }

        // return the result data
        return $json['data'];
    }

    /**
     * @param string $postalCode
     * @return void
     * @throws CakeException
     */
    private function validate(string $postalCode)
    {
        // TODO. Here I would do some validation that we have been given a valid postal code before executing the api call.

        if (empty($postalCode)) {
            throw new CakeException('Postcode must contain a value');
        }
    }
}
