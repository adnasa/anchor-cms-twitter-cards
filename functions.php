<?php

/**
 * @author Adnan Asani <konjuku@gmail.com>
 */

function twitter_card() {
    $internals = array(
        'site', 'title', 
        'description', 'domain',
    );
    
    $output = "";
    foreach ($internals as $internal) {
        $function = 'twitter_card_' . $internal;
        if(function_exists($function)) {
            $result = call_user_func($function);
            if (strlen($result)) {
                $output .= Html::element('meta', null, array('name' =>"twitter:{$internal}", 'content' => $result));
            }
        }
    }
    return $output;
}

/**
 * twitter @usename of the site.
 */
function twitter_card_site() {
    return Config::meta('twitter_card_site_username');
}

function twitter_card_creator() {
    return Config::meta('twitter_card_creator_username');
}

/**
 * description of the site.
 */
function twitter_card_description() {
    if (Config::meta('twitter_card_description') !== null) {
        return Config::meta('twitter_card_description');
    } else {
        return Config::meta('description');
    }
}

/**
 * @TODO: override check
 * title of the site.
 */
function twitter_card_title() {
    return page_title();
}
