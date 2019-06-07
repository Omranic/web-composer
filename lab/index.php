<?php

// Auto flush sent content
ob_implicit_flush(true);

require __DIR__.'/../vendor/autoload.php';

use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;

function composerInstall($packages)
{
    putenv('COMPOSER_HOME='.__DIR__.'/../../vendor/bin/composer');
    createComposerJson($packages);

    // You can change the resource to different type
    $resource = fopen('output.log', 'rw+b', false);

    // You can change stream output to different type
    $output = new StreamOutput($resource, StreamOutput::VERBOSITY_VERBOSE);

    // This is the core process, don't change
    $application = new Application();
    $application->setAutoExit(false);
    $application->run(new ArrayInput(['command' => 'install']), $output);

    // @TODO: Print out the output in realtime as it happens
    // ... That's your task, stream output from the above command
    // ... as it gets available, until it's finished execution!

    // ... while (true) {
    // ... ... print $output line, then iterate
    // ... ... print next line, and so on
    // ... }

    // This poor example, that doesn't work as expected!
    //$newResource = fopen('output.log', 'rw+b', false);
    //
    //while (true) {
    //    // Read a line
    //    $buffer = fgets($newResource);
    //
    //    // Return false when there aren't any bytes left
    //    if (! $buffer) {
    //        break;
    //    }
    //
    //    echo $buffer.'<br />';
    //}
    //
    //fclose($newResource);
    //die('Done!');
}

function createComposerJson($packages)
{
    $composer_json = str_replace("\/", '/', json_encode([
        'require' => (object) $packages,
    ]));

    return file_put_contents('composer.json', $composer_json);
}

composerInstall(['laravel/framework' => '^5.8.0']);
