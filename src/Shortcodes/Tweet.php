<?php

namespace Jvelo\Datatext\Shortcodes;

use Jvelo\Datatext\Support\Assets;
use Jvelo\Datatext\Assets\Asset;
use Log;

class Tweet implements Shortcode {

    public function name()
    {
        return "tweet";
    }

    public function handler()
    {
        return function($shortcode) {
            $id = $shortcode->getParameter('id');
            $theme = $shortcode->getParameter('theme') || 'dark';

            Assets::request(new Asset('script', '//platform.twitter.com/widgets.js', [
                'charset' => 'utf-8'
            ]));

            $script = <<< 'SCRIPT'
<script type='text/javascript'>
  twttr.widgets.createTweet('%s', document.getElementById('tweet-%s'), { theme: '%s'});
</script>
SCRIPT;
            return sprintf("<div id=\"tweet-%s\"></div>\n" . $script, $id, $id, $id, $theme);
        };
    }

    public function listeners()
    {
        return [];
    }
}