# Last Tweets

The script used for fetching Twitter statuses of a selected used, formatting them via provided template and saving them to a text file to be included in the website. 
Due to Twitter limit of 150 API calls per hour, the script was designed to be run periodically by cron.

With deprectation of Twitter REST API v1 it is no longer usable.

# How to use

1. Fill config/settings.php with selected username, number of tweets
   to be saved, timestamp format and the name of the file where tweets
   should be saved.

2. Edit config/template.inc, if you wish to change the way how tweets
   are formatted. You may use template variables for username, tweet
   content, timestamp and tweet URL as well as add CSS classes for styling.

3. In the place you wish to display fetched tweets, just include the file
   where the tweets were saved by the script, e.g.

   <?php include("last_tweets/tweets.inc"); ?>

4. All done!

# License

Licensed under MIT. See [LICENSE](#) for more info.
