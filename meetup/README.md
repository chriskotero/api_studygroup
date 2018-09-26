# Meetup Bot

# Getting an API key

[Create an API account on meetup](https://secure.meetup.com/meetup_api/key/)
and generate a key.  **Protect this key FOREVER.**  

How will we use it:
- Postman query to look up information
- Add it to your config.php and use it in the script
- host that script on a web site and slack slash command

# Postman

** remember that key **

query:

    /2/events

parameters:

    ['group_urlname' => $group]
        
# Let's get events in the code

    public function getEvents(array $parameters = array()) {
        return $this->get('/2/events', $parameters)->results;
    } 

# Run a local php webserver

Execute this command in the project

>  php -S localhost:8000

Then open [this link](http://localhost:8000/next-meetup.php?text=wwcrd)