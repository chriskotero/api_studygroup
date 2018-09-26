<?php
// Place this on your webserver at domain.com/bots/next-meetup.php as noted in the Slack settings
// from  https://github.com/FokkeZB/Meetup
require 'meetup.php';
require '../config.php';

$meetup = new Meetup(array(
    'key' => $config['key']
));

//
$groups = [
    'tp' => 'trianglephp',
    'wwcrd' => 'Women-Who-Code-Raleigh-Durham',
];

/**
 * User can request a group in the URL like domain.com/bots/next-meetup.php?text=wwcrd
**/
if (empty($_GET['text'])){
    $url = 'trianglephp';
} else {
    $url = !empty($groups[$_GET['text']]) ? $groups[$_GET['text']] : null;
}

if (!empty($url)) {
    $count = isset($_GET['count']) ? $_GET['count'] : 1;

    $response = $meetup->getEvents(array(
        'group_urlname' => $url
    ));

//$response = $meetup->getV3Events(array(
//    'urlname' => $url
//));

// If response is empty, send back some little message. I didn't bother.

    for ($i=0; $i<$count; $i++) {

        //   var_dump($response[$i]);

        $date =  new DateTime('@' . $response[$i]->time / 1000);
        $date->setTimezone(new \DateTimezone('America/New_York'));

        $group = $response[$i]->group->name;
        $place =  $response[$i]->venue->name;
        $url =  $response[$i]->event_url;
        $title = $response[$i]->name;

        if (($_GET['text'] === 'wwcrd') && ($_POST['channel_name'] === 'raleigh-durham')) {
            print  'The next event is ' . $title . ' on ' . $date->format("D, M j H:i") . ' at ' . $place . '   '  . $url .
                "\n";
            print "\n";
            print "\n";
        } elseif ($title != "PHP") {
            print  'The next event is ' . $title . ' on ' . $date->format("D, M j H:i") . ' at ' . $place . '   '  . $url . "\n";
            print "\n";
            print "\n";
        } else {
            $i = $count;
        }
    }

    print "\n";
} else {
    print("No valid group provided");
}

