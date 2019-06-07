<?php

// Auto flush sent content
ob_implicit_flush(true);

require __DIR__.'/../vendor/autoload.php';

use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;
use Composer\Console\HtmlOutputFormatter;
use Symfony\Component\Console\Output\Output;

class MyOutput extends Output
{
    protected function doWrite($message, $newline)
    {
        if ($newline) {
            $message .= '<br>';
        }

        echo $message;
    }
}
function composerInstall($packages)
{
    putenv('COMPOSER_HOME='.__DIR__.'/../../vendor/bin/composer');
    createComposerJson($packages);

    // You can change the resource to different type
    // $resource = fopen('output.log', 'rw+b', false);

    // You can change stream output to different type
    $output = new MyOutput();

    // stop execution and memory limiting
    ini_set('max_execution_time', 300); 
    ini_set('memory_limit', '-1');

    // Stop buffering
    ob_end_flush();
    ob_implicit_flush();

    // This is the core process, don't change
    $application = new Application();
    $application->setAutoExit(false);
    $application->run(new ArrayInput(['command' => 'install']), $output);
    die('Done!');
}

function createComposerJson($packages)
{
    $composer_json = str_replace("\/", '/', json_encode([
        'require' => (object) $packages,
    ]));

    return file_put_contents('composer.json', $composer_json);
}

composerInstall(['laravel/framework' => '^5.8.0']);
