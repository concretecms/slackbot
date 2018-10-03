<?php

use PortlandLabs\Slackbot\Bot;
use PortlandLabs\Slackbot\Command\DefaultProvider;
use PortlandLabs\Slackbot\ContainerFactory;
use PortlandLabs\Slackbot\Command;

require 'vendor/autoload.php';

// Load env stuff
(new Dotenv\Dotenv(__DIR__))->load();

// Load error handling
(new NunoMaduro\Collision\Provider())->register();

// Get a container implementation
$container = ContainerFactory::illuminate();

/** @var Bot $bot */
$bot = $container->get(Bot::class);

// Add default commands to the bot
/** @var Command\Provider $provider */
$provider = $container->get(DefaultProvider::class);
$provider->register($bot);

$bot->commands()->addCommand(\Concrete5\Slackbot\Command\HornsCommand::class);

// Connect and run the bot
$bot->run();