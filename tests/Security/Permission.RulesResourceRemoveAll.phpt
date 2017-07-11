<?php

/**
 * Test: Nette\Security\Permission Ensures that removal of all Resources results in Resource-specific rules being removed.
 */

use Nette\Security\Permission;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$acl = new Permission;
$acl->addResource('area');
$acl->allow(null, 'area');
Assert::true($acl->isAllowed(null, 'area'));
$acl->removeAllResources();
Assert::exception(function () use ($acl) {
	$acl->isAllowed(null, 'area');
}, Nette\InvalidStateException::class, "Resource 'area' does not exist.");

$acl->addResource('area');
Assert::false($acl->isAllowed(null, 'area'));
