<?php

/*
 * Last Tweets
 * created by Lukasz Wojcik (http://lukaszwojcik.net/)
 *
 * Licensed under CC BY-3.0
 * http://creativecommons.org/licenses/by/3.0/
 *
 *-----------------------------------
 *
 * Set this file to be executed via cron.
 * Be careful not to exceed Twitter API limit of 150 calls per hour.
 * That's why we do the magic perodically via cron instead of executing
 * the script each time.
 */

require_once('config/settings.php');
include("classes/template.class.php");

function save_tweet($username, $tweets, $tweet_file, $feed_url, $date_format)
{

    // getting the feed

    $timeline_obj = @file_get_contents($feed_url) or die("<b>ERROR:</b> <i>$feed_url</i> " .
                    "is not " . "a valid Twitter feed.<br/> Make sure it's " .
                    "configured correctly in <b>config/settings.php</b>.");

    $timeline = @simplexml_load_string($timeline_obj)->channel;

    // parsing elements

    $i = 0;

    foreach ($timeline->item as $item)
    {
        // Some preprocessing:
        // - styling retweets (be sure to change tthe path to retweet icon)
        // - making @nicknames clickable
        // - making URLs clickable
        
        if (substr($content,0,3) == 'RT ')
            $content = str_replace('RT ','<img src="/img/rt.png" alt="RT" /> ',$content);
        
        $pattern = array('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@',
                         '/@([A-Za-z0-9_]+)/');

        $replace = array('<a href="$1" rel="nofollow">$1</a>',
                         '<a href="http://twitter.com/$1" rel="nofollow">@$1</a>');

        // processing timestamps against provided dateformat

        $date = date($date_format, strtotime($item->pubDate));

        // preparing a template

        $tweet = new template("config/template.tpl");
        $tweet->set("username",$username);
        $tweet->set("date",$date);
        $tweet->set("content",$content);
        $tweet->set("link",$item->link);

        // saving into the file

        if ($i == 0): // first, we reset the content of $tweet_file
            $pointer = 'w';
        else: // from now on, we add new content to the existing one
            $pointer = 'a';
        endif;

        $tweets_src = fopen($tweet_file, $pointer)
        or die('Error opening <b>$tweet_file</b>. Does it actually exist?');

        fwrite($tweets_src, $tweet->display());
        fclose($tweets_src);


        if (++$i == $tweets) : break; endif;
    }

    // use this on your page to display the file:

    // include($tweet_file);
}

/* let's do the magic... */

save_tweet($username, $tweets, $tweet_file, $feed_url, $date_format);
