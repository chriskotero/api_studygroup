# CURL
Curl is a great commandline utility that allows you to interact with an API quickly and efficiently.
* Documentation: [https://curl.haxx.se/docs/manpage.html](https://curl.haxx.se/docs/manpage.html)
* Installation: [https://curl.haxx.se/download.html](https://curl.haxx.se/download.html)


## Sample Request
GET:
```
curl -H "content-type:application/json" https://5b97f29429cbd70014a8fe75.mockapi.io/users
```

POST:
```
curl -d '{ "name": "ruby doomsday" }' -H "content-type:application" https://5b97f29429cbd70014a8fe75.mockapi.io/users
```

# JQ
JQ is another commandline utility that "prettifies" JSON output and allows for introspection of the data sent in
* Documentation: [https://stedolan.github.io/jq/manual/](https://stedolan.github.io/jq/manual/)
* Tutorial: [https://stedolan.github.io/jq/tutorial/](https://stedolan.github.io/jq/tutorial/)

## Sample
Without JQ
```
curl -H "content-type:application/json" https://5b97f29429cbd70014a8fe75.mockapi.io/users

[{"id":"1","createdAt":"2018-09-11T00:01:44.651Z","name":"Kade Treutel","avatar":"https://s3.amazonaws.com/uifaces/faces/twitter/vc27/128.jpg"},{"id":"2","createdAt":"2018-09-11T12:29:51.237Z","name":"Rachel Ebert","avatar":"https://s3.amazonaws.com/uifaces/faces/twitter/okseanjay/128.jpg"},{"id":"3","createdAt":"2018-09-11T04:39:08.531Z","name":"Mr. Lucius Harvey","avatar":"https://s3.amazonaws.com/uifaces/faces/twitter/victorerixon/128.jpg"}]%
```

With JQ
```
curl -H "content-type:application/json" https://5b97f29429cbd70014a8fe75.mockapi.io/users | jq

[
  {
    "id": "1",
    "createdAt": "2018-09-11T00:01:44.651Z",
    "name": "Kade Treutel",
    "avatar": "https://s3.amazonaws.com/uifaces/faces/twitter/vc27/128.jpg"
  },
  {
    "id": "2",
    "createdAt": "2018-09-11T12:29:51.237Z",
    "name": "Rachel Ebert",
    "avatar": "https://s3.amazonaws.com/uifaces/faces/twitter/okseanjay/128.jpg"
  },
  {
    "id": "3",
    "createdAt": "2018-09-11T04:39:08.531Z",
    "name": "Mr. Lucius Harvey",
    "avatar": "https://s3.amazonaws.com/uifaces/faces/twitter/victorerixon/128.jpg"
  }
]
```

These utilities are great for interfacing with an API quickly and with very little effort. However, if you work with multiple APIs often it could be helpful to save requests and record responses to be retrieved so they can be reviewed, compared or repeated. To do this we simply need a mechanism to save each part of the curl request and its resulting response. In addition we need a way to recall a stored request/response. This is where the curly script comes in.


# Curly
Designed to be a intuitive stateful wrapper for building, saving and recalling curl requests by providing a series of "helper" commands. Supports GET, POST, PUT and DELETE requests to a server.

## Requirements
JQ: All curl responses make use of JQ parser to pretty print JSON to the console.
```
> brew install jq
```
For other OSes check: [https://stedolan.github.io/jq/download/](https://stedolan.github.io/jq/download/)

## Quick Start
Curly is a bash shell script and will require a (*)nix OS in order to run. In order to run a shell script on a Windows based machine you will need to install powershell. [Get powershell for Windows](https://www.howtogeek.com/261591/how-to-create-and-run-bash-shell-scripts-on-windows-10/)

Load up the shell script with the following command. (This will install a set of commands for the terminal you are in and will not interfere with or be accessible in any other terminals.)
```
> source ./curly.sh
```

Building a request is done by setting the various parts of a request individually to support making multiple and varying calls to the same server. Active requests can be edited with various helper commands (Setting Params).
```
> setHost https://myapi.com
> get /path/to/endpoint
```

Each request is automatically saved into a datestamp folder and can be recalled using the following command.
```
loadRequest history/[date]/[request]
```

### Setting Params
Setting up RESTful calls may require editing one or all of the following settings.

| Setting          | Helper           | Use                                                           |
| ---------------- | ---------------- | ------------------------------------------------------------- |
| HOST             | `setHost [host]` | Stores the host domain of the server                          |
| PATH             | `setPath [path]` | Stores the URL path along with any URL params                 |

### Making Calls
* `post (path)` will build/send a curl request to the provided host/path
* `get (path)` will build/send a curl request to the provided host/path
* `put (path)` will build/send a curl request to the provided host/path
* `get (path)` will build/send a curl request to the provided host/path
