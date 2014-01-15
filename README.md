anketa
======

Simple web app to create and fill out surveys.


## Testing

In order to run all test type run from the project directory `php phpunit.phar`.

FYI the initial project hierarchy was changed: from a very long namespace (`\Cvut\Fit\BiWt1\PollBundle`) I changed it 
to a more compact and reasonalble namespace (`Poll\PollBundle`). So it is important to run the tests from project directory. In order to check if the tests were not tampered, you can run a linux `diff` command and identify that the only changes occured to the namespaces.
