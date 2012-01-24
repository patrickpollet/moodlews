<?php


$function = "moodle_user_get_users_by_id";

$server_url="prope.insa-lyon.fr/moodle20";

// simpleserver marche par login/pwd et server.php par token
$serverurl = "http://{$server_url}/webservice/rest/simpleserver.php";

$params = array(
 'userids' => array(1,2,3,4),
 'wsfunction' => $function,
// 'wstoken' => '157ca217b09caffee3e9719b96698386'
  'wsusername'=>'astrid',
  'wspassword'=>'bpitt1',
);

$postdata = http_build_query($params);

print_r($postdata);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $serverurl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_VERBOSE, true);
$data = curl_exec($ch);
curl_close($ch);
print "<pre>";
var_dump($data);
print "</pre>";

?>
