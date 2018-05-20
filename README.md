# Last Tweets

PHP script used for fetching tweets of a selected user, formatting them with provided template and saving them to a text file to be included in PHP-powered website. I used it for one of past iterations of my homepage around 2012.

Due to Twitter limit of 150 API calls per hour, the script was designed to be run periodically by cron.

With deprecation of Twitter REST API v1 it is no longer usable.

## How to use

1. Fill config/settings.php with selected username, number of tweets
   to be saved, timestamp format and the name of the file where tweets
   should be saved.

2. Edit config/template.inc, if you wish to change the way how tweets
   are formatted. You may use template variables for username, tweet
   content, timestamp and tweet URL as well as add CSS classes for styling.

3. In the place you wish to display fetched tweets, just include the file
   where the tweets were saved by the script, e.g.

   `<?php include("last_tweets/tweets.inc"); ?>`

4. All done!

## License

Licensed under MIT. See [LICENSE](https://raw.githubusercontent.com/lwojcik/last_tweets/master/LICENSE) for more info.
