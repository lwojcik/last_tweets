<?php

/* Twitter username for use */

$username= 'LukaszWojcik';

/* Number of tweets to be processed */

$tweets = 10;

/* File for tweets to be stored */

$tweet_file = 'tweets.inc';

/* Date format used in tweet timestamps
 * see http://pl.php.net/manual/en/function.date.php for details */

$date_format = 'd.m.Y G:i';

/* URL for Twitter timeline RSS feed - 99,9% chance you don't need to edit that'*/

$feed_url = 'http://api.twitter.com/1/statuses/user_timeline.rss?screen_name='.$username;

/* URL for template */

$template = 'template.tpl';
