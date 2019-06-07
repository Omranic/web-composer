# Preface
This is attempt to run composer in the browser, it's working, but;

# Problem
But, the output is buffered and then printed to the browser after the whole process finishes execution, not like what happens on console!

# Expectation
Stream the output as it gets available, in real time!
So yeah, as the command executes and send output to the stream resource, 
we need to print it out instantly to the browser. Any resource type could be used.

# Notes
Make sure your PHP & nginx settings are set up correctly, with buffering turned off, so you can stream content to the browser.

# Steps
1. In your console, run `composer install`
2. In your browser, access http://localhost/lab/index.php
3. Do your magic, and make it happen! Enjoy, and good luck in the process.

# Deliverable
The deliverable should be fully working code, utilizing PHP v7.2+, Composer v1.8+, symfony/console v4.3+ .. with clear instructions on installation and usage. It's ok to utilize additional technologies, but preferred to do it the native way  (without radical changes, you can NOT refactor the task in another programing languages, or require launching Python server for example!).
