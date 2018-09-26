#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';

use Acme\Command\NextMeetupCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new NextMeetupCommand($config));

try {
    $application->run();
} catch (Exception $e) {
    print $e->getMessage();
}