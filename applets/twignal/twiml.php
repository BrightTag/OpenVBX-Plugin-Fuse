<?php
$account = AppletInstance::getValue('account');
$event = AppletInstance::getValue('event');
$next = AppletInstance::getDropZoneUrl('next');

$normalizePhoneParameters = array('From', 'To', 'ForwardedFrom');

$parameters = array(
  'CallSid', 'CallStatus', 'Direction',
  'FromCity', 'FromState', 'FromZip', 'FromCountry',
  'ToCity', 'ToState', 'ToZip', 'ToCountry',
  'CallerName');

if(!empty($_REQUEST['From'])) {
    $from = normalize_phone_to_E164($_REQUEST['From']);
    $to = normalize_phone_to_E164($_REQUEST['To']);
    $event = str_replace(array('%caller%', '%number%'), array($from, $to), $event);

    $ch = curl_init('http://tagserve.stage.thebrighttag.com/api');
    $fields = array(
      'site'     => $account,
      'referrer' => $event
    );

    foreach ($normalizePhoneParameters as $parameter) {
      $fields[$parameter] = normalize_phone_to_E164($_REQUEST[$parameter]);
    }

    foreach ($parameters as $parameter) { 
      $fields[$parameter] = $_REQUEST[$parameter];
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_exec($ch);
    curl_close($ch);
}

$response = new TwimlResponse;

if(!empty($next)) {
    $response->redirect($next);
}

$response->respond();
