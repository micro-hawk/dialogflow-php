<?php                                                             /*                                                                                                 Apache License
                           Version 2.0, January 2004
                        http://www.apache.org/licenses/

   Copyright 2021 sumithemmadi

   Licensed under the Apache License, Version 2.0 (the "License");   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
*/

namespace Google\Cloud\Samples\Dialogflow;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;
require __DIR__ . '/vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Save Google Account Credentials json file as 'service-account-file.json'
//make sure that Google Account Credentials JSON file and this file are in same directory.

$data = json_decode(file_get_contents("php://input"));

$google_application_credentials = "service-account-file.json";

$get_json_data    = file_get_contents($google_application_credentials);
$decode_json_data = json_decode($get_json_data, TRUE);
$projectId        = $decode_json_data['project_id'];

// Session ID, can be any string for this purpose. However, if you are going to be using the client library to manage an entire conversation, your session_ID must be the same across an entire
// Generate Random Session ID  if `sid` not present in json post request.
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($data->sid)) {
    $sessionId = $data->sid;
} else {
    $sessionId = uniqid('sid-');
}

function  get_response($projectId,$google_application_credentials, $text, $sessionId) {
    // new session
    $test           = array(
        'credentials' => $google_application_credentials
    );
    $sessionsClient = $sessionId;
    $sessionsClient = new SessionsClient($test);
    $session        = $sessionsClient->sessionName($projectId, $sessionId ?: uniqid());

    // create text input
    $textInput      = new TextInput();
    $textInput->setText($text);
    // set language
    $textInput->setLanguageCode('en-US');

    // create query input
    $queryInput = new QueryInput();
    $queryInput->setText($textInput);

    // Response
    $response       = $sessionsClient->detectIntent($session, $queryInput);
    $json_resp      = $response->serializeToJsonString();
    $json_response  = json_encode(json_decode($json_resp),JSON_PRETTY_PRINT);
    return $json_response;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($data->message)) {
     $text   = $data->message;
     http_response_code(200);
     echo get_response($projectId,$google_application_credentials, $text, $sessionId);
     echo $sessionId;
} else {
    http_response_code(400);
    // Error
    echo "Error ❌";
}

?>
