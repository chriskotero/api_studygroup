mkdir -p headers history hosts paths payloads responses
touch _headers.list
touch _payload.json
clear
cat .manpage

PAYLOAD=@_payload.json
host_default="http://localhost:3000"
path_default="/"
CURLY_HOST=$host_default
CURLY_PATH=$path_default

setHost() { CURLY_HOST=$1 }
setPath() { CURLY_PATH=$1 }

# inspects current or a saved request
showRequest() {
  if [ -z "$1" ]
  then
    echo "\nHOST: $CURLY_HOST"
    echo "PATH: $CURLY_PATH"
    echo "HEADERS:"
    cat _headers.list

    if [ -s _payload.json ]
    then
      echo "\nPAYLOAD:"
      cat _payload.json
    else
      echo ""
    fi
  else
    FILENAME="${1#history/}"
    echo "\nHOST:"
    cat hosts/$FILENAME'.string'
    echo "PATH:"
    cat paths/$FILENAME'.string'

    echo "HEADERS:"
    cat headers/$FILENAME'.list'

    if [ -s payloads/$FILENAME'.json' ]
    then
      echo "\nPAYLOAD:"
      cat payloads/$FILENAME'.json'
    else
      echo ""
    fi
  fi
}

# saves request
saveRequest() {
  today=`date '+%Y-%m-%d'`
  mkdir -p history/$today
  mkdir -p headers/$today
  mkdir -p payloads/$today
  mkdir -p paths/$today
  mkdir -p hosts/$today
  mkdir -p responses/$today

  if [ -z "$1" ]
  then
    host=$(echo $CURLY_HOST | sed -e 's/http[s]*\:\/.*\///g')
    FILENAME="$CURLY_ACTION--$host--${CURLY_PATH//\//.}"
  else
    FILENAME=$1
  fi
  touch history/$today/$FILENAME
  cp _headers.list headers/$today/$FILENAME'.list'
  cp _payload.json payloads/$today/$FILENAME'.json'
  cp _response.json responses/$today/$FILENAME'.json'
  echo $CURLY_HOST > hosts/$today/$FILENAME'.string'
  echo $CURLY_PATH > paths/$today/$FILENAME'.string'
  echo "\nSaved Request: $today/$FILENAME"
}

# load request
loadRequest() {
  FILENAME="${1#history/}"
  cp headers/$FILENAME'.list' _headers.list
  cp payloads/$FILENAME'.json' _payload.json
  cp responses/$FILENAME'.json' _response.json
  CURLY_HOST=$(cat hosts/$FILENAME'.string')
  CURLY_PATH=$(cat paths/$FILENAME'.string')
  echo "\nLOADED: $FILENAME"
  showRequest
}

# makes a post call with headers and payload to the supplied url
post() {
  CURLY_ACTION="POST"
  headers=""
  while read line ; do
    headers=("${headers[@]} -H '$line'")
  done < _headers.list

  POST_PATH=${1:-$CURLY_PATH}
  CURLY_PATH=$POST_PATH
  POST_URL=$CURLY_HOST$CURLY_PATH

  cmd="curl -d $PAYLOAD $headers -X POST '$POST_URL'"

  echo "\n"$cmd"\n"
  eval $cmd | jq . > _response.json
  saveRequest

  showRequest && cat _response.json
}

# makes a get call with headers to the supplied url
get() {
  CURLY_ACTION="GET"
  headers=""
  while read line ; do
    headers=("${headers[@]} -H '$line'")
  done < _headers.list

  GET_PATH=${1:-$CURLY_PATH}
  CURLY_PATH=$GET_PATH
  GET_URL=$CURLY_HOST$CURLY_PATH

  cmd="curl $headers -X GET '$GET_URL'"

  echo "\n"$cmd"\n"
  eval $cmd | jq . > _response.json
  saveRequest

  showRequest && cat _response.json
}

# makes a put call with headers and payload to the supplied url
put() {
  CURLY_ACTION="PUT"
  headers=""
  while read line ; do
    headers=("${headers[@]} -H '$line'")
  done < _headers.list

  PUT_PATH=${1:-$CURLY_PATH}
  CURLY_PATH=$PUT_PATH
  PUT_URL=$CURLY_HOST$CURLY_PATH

  cmd="curl -d $PAYLOAD $headers -X PUT '$PUT_URL'"

  echo "\n"$cmd"\n"
  eval $cmd | jq . > _response.json
  saveRequest

  showRequest && cat _response.json
}

# makes a delete call with headers and payload to the supplied url
delete() {
  CURLY_ACTION="DELETE"
  headers=""
  while read line ; do
    headers=("${headers[@]} -H '$line'")
  done < _headers.list

  DELETE_PATH=${1:-$CURLY_PATH}
  CURLY_PATH=$DELETE_PATH
  DELETE_URL=$CURLY_HOST$CURLY_PATH

  cmd="curl $headers -X DELETE '$DELETE_URL'"

  echo "\n"$cmd"\n"
  eval $cmd | jq . > _response.json
  saveRequest

  showRequest && cat _response.json
}

