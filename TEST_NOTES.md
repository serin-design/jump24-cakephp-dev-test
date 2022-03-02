# Jump24 CakePHP Dev Test Notes

In this application I have created a reusable component to fetch geo data for a given postcode, i.e. to get the lat lon
for a distance comparison via an [open source government api](https://www.getthedata.com/open-postcode-geo).

## Show us how you test the app using PHPUnit.

I have written some tests on the component to demonstrate my use of phpunit testing, with more time I would expand
this further to further mock the http->get response to give me better control of the result data.

## Don't always write everything yourself.

In this case I am using CakePHP's http client to serve this purpose rather than using pure php such as cURL or Guzzle.

## Build a console command that pulls data from an API and stores it against the User model.

First, I wrote a very basic api callback to fetch geo data for a given postal code.

Second, I wrote a command to download the given users from the reqres.in users api to demonstrate processing of
pagination.

## Further comments

Unfortunately I did not get time to complete test coverage of the users import component however the same princible
would have been applied here with needing validation before inserting into the db and applying tests.
