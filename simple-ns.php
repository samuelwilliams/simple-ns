#!/bin/bash php
<?php

require_once __DIR__.'/vendor/autoload.php';

// Create the eventDispatcher and add the event subscribers. This is not necessary, but it will log events to the terminal.
$eventDispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
$eventDispatcher->addSubscriber(new \yswery\DNS\Event\Subscriber\EchoLogger());

// Instantiate your custom resolver.
$resolver = new \SimpleNs\CustomResolver();

// Create a new instance of Server class
$server = new yswery\DNS\Server($resolver, $eventDispatcher);

// Start DNS server
$server->start();

