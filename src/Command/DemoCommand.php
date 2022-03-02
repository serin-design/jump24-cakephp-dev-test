<?php

namespace App\Command;

use App\Controller\Component\RequestBinDataApiComponent;
use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Exception\CakeException;

class DemoCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        try {

            $postalCodeDataApi = new RequestBinDataApiComponent(new ComponentRegistry());

            $results = $postalCodeDataApi->getPaginatedData();

            //var_dump($results);

            $io->success('Success');

        } catch (CakeException $e) {

            $io->error('Fatal Error: ' . $e->getMessage());

        }
    }
}
