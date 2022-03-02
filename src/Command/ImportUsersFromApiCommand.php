<?php

namespace App\Command;

use App\Controller\Component\UserDataApiComponent;
use App\Model\Entity\User;
use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Exception\CakeException;
use Cake\Validation\Validator;

class ImportUsersFromApiCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        try {

            // load the component
            $component = new UserDataApiComponent(new ComponentRegistry());

            // register the users
            foreach ($component->getAllUserData() as $userData) {
                $this->registerUser($userData);
            }

            $io->success('Success');

        } catch (CakeException $e) {

            $io->error('Fatal Error: ' . $e->getMessage());

        }
    }

    /**
     * @param array $userData
     * @return void
     */
    private function registerUser(array $userData): void
    {
        $this->validateUser($userData);

        $userTable = $this->getTableLocator()->get('User');

        $userTable->save(new User([
            'id' => $userData['id'],
            'email' => $userData['email'],
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'avatar' => $userData['avatar'],
        ]));
    }

    /**
     * @param array $userData
     * @return void
     */
    private function validateUser(array $userData): void
    {
        $validator = new Validator();

        // TODO write validation rules here.

        $validator->validate($userData);
    }
}
