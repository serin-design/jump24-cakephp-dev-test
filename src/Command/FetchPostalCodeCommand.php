<?php

namespace App\Command;

use App\Controller\Component\PostalCodeDataApiComponent;
use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Exception\CakeException;

class FetchPostalCodeCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        try {

            $postalCodeDataApi = new PostalCodeDataApiComponent(new ComponentRegistry());

            $postalCode = 'RG1 4QU';
            $result = $postalCodeDataApi->getData($postalCode);

            var_dump($result);

            $io->success('Success: Data for postal code fetched');

        } catch (CakeException $e) {

            $io->error('Fatal Error: ' . $e->getMessage());

        }
    }
}
