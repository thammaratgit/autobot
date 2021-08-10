<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
$channel_token = 'QtISQCHKaGI3+yOaesnO0JBJB/ESKTXd8RPgrUs7RAYUU7X6ZuDxlDGHyauATc+4QDgBv4mpX6baq3ex9l1Oz15Uao6bgM8IIfFZBDY8YX+TN9dZSNBjqNqLonQWPuUtRahDUPEB8zK1ftH6D4nGWgdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'd66b6fd9ced99ca46a3b3fa2a15ab002';

// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);
if (!is_null($events['events'])) {

    // Loop through each event
    foreach ($events['events'] as $event) {

      // Line API send a lot of event type, we interested in message only.
      if ($event['type'] == 'message') {
          switch($event['message']['type']) {
              case 'text':
                   // Get replyToken
                   $replyToken = $event['replyToken'];

                   // Reply message
                   $respMessage = 'Hello, your message is '. $event['message']['text'];
                   $httpClient = new CurlHTTPClient($channel_token);
                   $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
                   $textMessageBuilder = new TextMessageBuilder($respMessage);
                   $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                  break;
              }
          }
      }
}
echo "OK";
