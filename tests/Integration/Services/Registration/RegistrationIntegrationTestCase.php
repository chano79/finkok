<?php

declare(strict_types=1);

namespace PhpCfdi\Finkok\Tests\Integration\Services\Registration;

use PhpCfdi\Finkok\Services\Registration\Customer;
use PhpCfdi\Finkok\Services\Registration\ObtainCommand;
use PhpCfdi\Finkok\Services\Registration\ObtainService;
use PhpCfdi\Finkok\Tests\Integration\IntegrationTestCase;

abstract class RegistrationIntegrationTestCase extends IntegrationTestCase
{
    protected const CUSTOMER_RFC = 'XDEL000101XX1';

    protected const CUSTOMER_NON_EXISTENT = 'ABCD010101AAA';

    public function findCustomer(string $rfc): ?Customer
    {
        $command = new ObtainCommand($rfc);
        $obtain = new ObtainService($this->createSettingsFromEnvironment());
        return $obtain->obtain($command)->customers()->findByRfc($rfc);
    }

    public function findCustomerOrFail(string $rfc): Customer
    {
        $command = new ObtainCommand($rfc);
        $obtain = new ObtainService($this->createSettingsFromEnvironment());
        return $obtain->obtain($command)->customers()->getByRfc($rfc);
    }
}
