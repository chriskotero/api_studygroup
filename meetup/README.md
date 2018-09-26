# Meetup Bot

# Getting an API key

[Create an API account on meetup](https://secure.meetup.com/meetup_api/key/)
and generate a key.  **Protect this key FOREVER.**  

How will we use it:
- [Postman](https://www.getpostman.com/apps) or [Insomnia](https://insomnia.rest/)query to look up information
- Add it to your config.php and use it in the script
- host that script on a web site and slack slash command

# Postman

** remember that key **

add your url:

    https://api.meetup.com/2/events

parameters:

    'key' => your secret key
    'group_urlname' => Women-Who-Code-Raleigh-Durham
        
When you add these into the parameters section on Postman, you will see them added onto the URL.  Save this if you want to remember it later.

# Easy Script

Inside our Meetup class is this awesome function.  It asks the same thing that we asked for in our Postman query.

    public function getEvents(array $parameters = array()) {
        return $this->get('/2/events', $parameters)->results;
    } 

Our `next-meetup.php` script accesses this meetup class and helps us make the query in code:

    $meetup = new Meetup(array(
        'key' => $config['key']
    ));


    $response = $meetup->getEvents(array(
        'group_urlname' => 'Women-Who-Code-Raleigh-Durham'
    ));

And we should see this lovely data:
<collapsed-data>

    {
        "results": [
            {
                "utc_offset": -14400000,
                "venue": {
                    "country": "us",
                    "localized_country_name": "USA",
                    "city": "Durham",
                    "address_1": "733 Foster Street",
                    "name": "Spreedly",
                    "lon": -78.90175,
                    "id": 24612482,
                    "state": "NC",
                    "lat": 36.004963,
                    "repinned": true
                },
                "headcount": 0,
                "visibility": "public",
                "waitlist_count": 0,
                "created": 1530191998000,
                "maybe_rsvp_count": 0,
                "description": "<p>Do you want to understand APIs better? We will put ourselves in small groups and explore how APIs work. We can query an API with Postman to examine how the request and response works. Members who are more comfortable with APIs could explore the Meetup APIs to write a script or even a slack bot. We would love for you to share your experience, whether beginner or advanced API user, and learn with us!</p> <p>*All WWCode events are governed by our Code of Conduct (<a href=\"https://github.com/WomenWhoCode/guidelines-resources/blob/master/code_of_conduct.md\" class=\"linkified\">https://github.com/WomenWhoCode/guidelines-resources/blob/master/code_of_conduct.md</a>). We are committed to our mission statement and equally committed to providing a harassment-free experience for everyone regardless of gender, gender identity and expression, sexual orientation, ability, physical appearance, body size, race, ethnicity, age, religion, or socioeconomic status. We do not tolerate harassment of event participants in any form. Event participants violating these rules may be sanctioned or expelled permanently, at the discretion of the event organizers, which in most cases are members of the WWCode leadership team.</p>",
                "how_to_find_us": "The entrance is on the left side of the building, through the gate.  There is on-street parking nearby, some is free.  Avoid parking in the grocery parking lot.",
                "event_url": "https://www.meetup.com/Women-Who-Code-Raleigh-Durham/events/252230029/",
                "yes_rsvp_count": 35,
                "duration": 7200000,
                "announced": true,
                "name": "API Study Night ",
                "id": "252230029",
                "photo_url": "https://secure.meetupstatic.com/photos/event/d/8/9/e/global_472435454.jpeg",
                "time": 1538002800000,
                "updated": 1537475554000,
                "group": {
                    "join_mode": "approval",
                    "created": 1430765912000,
                    "name": "Women Who Code Raleigh Durham",
                    "group_lon": -78.63999938964844,
                    "id": 18576115,
                    "urlname": "Women-Who-Code-Raleigh-Durham",
                    "group_lat": 35.77000045776367,
                    "who": "Members"
                },
                "status": "upcoming"
            },
            {
                "utc_offset": -14400000,
                "venue": {
                    "country": "US",
                    "localized_country_name": "USA",
                    "city": "Raleigh",
                    "address_1": "411 West Morgan Street",
                    "name": "Morgan Street Food Hall & Market",
                    "lon": -78.645706,
                    "id": 25883447,
                    "lat": 35.77931,
                    "repinned": true
                },
                "headcount": 0,
                "visibility": "public",
                "waitlist_count": 0,
                "created": 1535308819000,
                "maybe_rsvp_count": 0,
                "description": "<p>Let's brunch in advance of All Things Open! There will be no set topic for this event - it will be a way to meet and mingle with other local Women Who Code. Everyone will pay their own way and we'll smush together as many tables as we need. Please RSVP so we can get a rough idea of who's coming. See you soon! [SWAG WILL ALSO BE PRESENT]</p> <p>*All WWCode events are governed by our Code of Conduct (<a href=\"https://github.com/WomenWhoCode/guidelines-resources/blob/master/code_of_conduct.md\" class=\"linkified\">https://github.com/WomenWhoCode/guidelines-resources/blob/master/code_of_conduct.md</a>). We are committed to our mission statement and equally committed to providing a harassment-free experience for everyone regardless of gender, gender identity and expression, sexual orientation, ability, physical appearance, body size, race, ethnicity, age, religion, or socioeconomic status. We do not tolerate harassment of event participants in any form. Event participants violating these rules may be sanctioned or expelled permanently, at the discretion of the event organizers, which in most cases are members of the WWCode leadership team.</p>",
                "how_to_find_us": "Look for the women in the bright teal Women Who Code shirt!",
                "event_url": "https://www.meetup.com/Women-Who-Code-Raleigh-Durham/events/254124359/",
                "yes_rsvp_count": 20,
                "duration": 7200000,
                "announced": false,
                "name": "WWCode ATO Brunch",
                "id": "254124359",
                "time": 1540135800000,
                "updated": 1535397796000,
                "group": {
                    "join_mode": "approval",
                    "created": 1430765912000,
                    "name": "Women Who Code Raleigh Durham",
                    "group_lon": -78.63999938964844,
                    "id": 18576115,
                    "urlname": "Women-Who-Code-Raleigh-Durham",
                    "group_lat": 35.77000045776367,
                    "who": "Members"
                },
                "status": "upcoming"
            },
            {
                "utc_offset": -18000000,
                "venue": {
                    "country": "us",
                    "localized_country_name": "USA",
                    "city": "Cary",
                    "address_1": "Preston Corners, 4248 NW Cary Parkway, Cary, NC 27513",
                    "name": "La Farm Bakery",
                    "lon": -78.781624,
                    "id": 24202393,
                    "state": "NC",
                    "lat": 35.812904,
                    "repinned": false
                },
                "headcount": 0,
                "visibility": "public",
                "waitlist_count": 0,
                "created": 1535376931000,
                "maybe_rsvp_count": 0,
                "description": "<p>Let's brunch! There will be no set topic for this event - it will be a way to meet and mingle with other local Women Who Code. Everyone will pay their own way and we'll smush together as many tables as we need. Please RSVP so we can get a rough idea of who's coming. See you soon! [SWAG WILL ALSO BE PRESENT]</p> <p>*All WWCode events are governed by our Code of Conduct (<a href=\"https://github.com/WomenWhoCode/guidelines-resources/blob/master/code_of_conduct.md\" class=\"linkified\">https://github.com/WomenWhoCode/guidelines-resources/blob/master/code_of_conduct.md</a>). We are committed to our mission statement and equally committed to providing a harassment-free experience for everyone regardless of gender, gender identity and expression, sexual orientation, ability, physical appearance, body size, race, ethnicity, age, religion, or socioeconomic status. We do not tolerate harassment of event participants in any form. Event participants violating these rules may be sanctioned or expelled permanently, at the discretion of the event organizers, which in most cases are members of the WWCode leadership team.</p>",
                "how_to_find_us": "Look for the woman in the bright teal Women Who Code shirt!",
                "event_url": "https://www.meetup.com/Women-Who-Code-Raleigh-Durham/events/254142055/",
                "yes_rsvp_count": 8,
                "duration": 7200000,
                "announced": false,
                "name": "WWCode Brunch",
                "id": "254142055",
                "photo_url": "https://secure.meetupstatic.com/photos/event/d/3/f/9/global_472434265.jpeg",
                "time": 1541867400000,
                "updated": 1535376931000,
                "group": {
                    "join_mode": "approval",
                    "created": 1430765912000,
                    "name": "Women Who Code Raleigh Durham",
                    "group_lon": -78.63999938964844,
                    "id": 18576115,
                    "urlname": "Women-Who-Code-Raleigh-Durham",
                    "group_lat": 35.77000045776367,
                    "who": "Members"
                },
                "status": "upcoming"
            },
            {
                "utc_offset": -18000000,
                "venue": {
                    "country": "US",
                    "localized_country_name": "USA",
                    "city": "Durham",
                    "address_1": "5420 Durham-Chapel Hill Boulevard",
                    "name": "Namu",
                    "lon": -78.99661,
                    "id": 25471731,
                    "lat": 35.952812,
                    "repinned": true
                },
                "headcount": 0,
                "visibility": "public",
                "waitlist_count": 0,
                "created": 1535396836000,
                "maybe_rsvp_count": 0,
                "description": "<p>Let's brunch and kick off the Advent of Code (<a href=\"https://adventofcode.com/\" class=\"linkified\">https://adventofcode.com/</a>) together! Everyone will pay their own way and we'll smush together as many tables as we need. Please RSVP so we can get a rough idea of who's coming. See you soon! [SWAG WILL ALSO BE PRESENT]</p> <p>Advent of Code is a yearly programming puzzle that presents a daily problem that you must solve by writing code. You don't submit your code, but you submit the correct answer and receive a star. These are really fun puzzles and sometimes quite tricky. It's more fun to solve with friends, so let's get started together on Day One. If you'd like, you can check out last years' puzzles at the link above.</p> <p>*All WWCode events are governed by our Code of Conduct (<a href=\"https://github.com/WomenWhoCode/guidelines-resources/blob/master/code_of_conduct.md\" class=\"linkified\">https://github.com/WomenWhoCode/guidelines-resources/blob/master/code_of_conduct.md</a>). We are committed to our mission statement and equally committed to providing a harassment-free experience for everyone regardless of gender, gender identity and expression, sexual orientation, ability, physical appearance, body size, race, ethnicity, age, religion, or socioeconomic status. We do not tolerate harassment of event participants in any form. Event participants violating these rules may be sanctioned or expelled permanently, at the discretion of the event organizers, which in most cases are members of the WWCode leadership team.</p>",
                "how_to_find_us": "Look for the woman in the bright teal Women Who Code shirt!",
                "event_url": "https://www.meetup.com/Women-Who-Code-Raleigh-Durham/events/254152408/",
                "yes_rsvp_count": 28,
                "duration": 10800000,
                "announced": true,
                "name": "WWCode Brunch for Advent of Code",
                "id": "254152408",
                "photo_url": "https://secure.meetupstatic.com/photos/event/d/3/f/9/global_472434265.jpeg",
                "time": 1543676400000,
                "updated": 1535397607000,
                "group": {
                    "join_mode": "approval",
                    "created": 1430765912000,
                    "name": "Women Who Code Raleigh Durham",
                    "group_lon": -78.63999938964844,
                    "id": 18576115,
                    "urlname": "Women-Who-Code-Raleigh-Durham",
                    "group_lat": 35.77000045776367,
                    "who": "Members"
                },
                "status": "upcoming"
            }
        ],
        "meta": {
            "next": "",
            "method": "Events",
            "total_count": 4,
            "link": "https://api.meetup.com/2/events",
            "count": 4,
            "description": "Access Meetup events using a group, member, or event id. Events in private groups are available only to authenticated members of those groups. To search events by topic or location, see [Open Events](/meetup_api/docs/2/open_events).",
            "lon": "",
            "title": "Meetup Events v2",
            "url": "https://api.meetup.com/2/events?offset=0&format=json&limited_events=False&group_urlname=Women-Who-Code-Raleigh-Durham&page=200&fields=&key=3b58705e11164e606c4d3574604d5c70&order=time&desc=false&status=upcoming",
            "id": "",
            "updated": 1537475554000,
            "lat": ""
        }
    }


</collapsed-data>

# Test it by running a local php webserver

Execute this command in the project

>  php -S localhost:8000

Then open [this link](http://localhost:8000/next-meetup.php?text=wwcrd)