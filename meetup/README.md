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

# Let's get events in the code

Inside our Meetup class is this awesome function.  It asks the same thing that we asked for in our Postman query.

    public function getEvents(array $parameters = array()) {
        return $this->get('/2/events', $parameters)->results;
    } 

    $meetup = new Meetup(array(
        'key' => $config['key']
    ));


    $response = $meetup->getEvents(array(
        'group_urlname' => 'Women-Who-Code-Raleigh-Durham'
    ));

# Run a local php webserver

Execute this command in the project

>  php -S localhost:8000

Then open [this link](http://localhost:8000/next-meetup.php?text=wwcrd)