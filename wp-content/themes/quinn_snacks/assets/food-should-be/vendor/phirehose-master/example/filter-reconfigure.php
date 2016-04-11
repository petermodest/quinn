<?php
require_once('../lib/Phirehose.php');
require_once('../lib/OauthPhirehose.php');

/**
 * Example of how to update filter predicates using Phirehose
 */
class DynamicTrackConsumer extends OauthPhirehose
{

  /**
   * Subclass specific attribs
   */
  protected $myTrackWords = array('foodshouldbe');

  /**
   * Enqueue each status
   *
   * @param string $status
   */
  public function enqueueStatus($status)
  {

    $data = json_decode($status, true);
    echo date("Y-m-d H:i:s (").strlen($status)."):".print_r($data,true)."\n";

    // We won't actually do anything with statuses in this example, see updateFilterPredicates() for important stuff
  }

  /**
   * In this example, we just set the track words to a random 2 words. In a real example, you'd want to check some sort
   * of shared medium (ie: memcache, DB, filesystem) to determine if the filter has changed and set appropriately. The
   * speed of this method will affect how quickly you can update filters.
   */
  public function checkFilterPredicates()
  {
    // This is all that's required, Phirehose will detect the change and reconnect as soon as possible
    $randWord1 = $this->myTrackWords[rand(0, 3)];
    $randWord2 = $this->myTrackWords[rand(0, 3)];
    $this->setTrack(array($randWord1, $randWord2));
  }

}

// $consumerkey = "Cn1zMavxZPpho0XMt0BO07rOT"; //Noted keys from step 2
// $consumersecret = "kOoJnrUVVYkZPINj7xyN4GcsDkbD9Pp8SPDRWPZ72zdbD4meW5"; //Noted keys from step 2
// $accesstoken = "222355427-fiodHmGV4PWaNTIwhDqybUO1ixFYpAdlXTg6Q26h"; //Noted keys from step 2
// $accesstokensecret = "2AfOvv0lMbCdkzJy7wrgVEmNn1EIosOY2atFqPcF8zHOY"; //Noted keys from step 2


// The OAuth credentials you received when registering your app at Twitter
define("TWITTER_CONSUMER_KEY", "Cn1zMavxZPpho0XMt0BO07rOT");
define("TWITTER_CONSUMER_SECRET", "kOoJnrUVVYkZPINj7xyN4GcsDkbD9Pp8SPDRWPZ72zdbD4meW5");


// The OAuth data for the twitter account
define("OAUTH_TOKEN", "222355427-fiodHmGV4PWaNTIwhDqybUO1ixFYpAdlXTg6Q26h");
define("OAUTH_SECRET", "2AfOvv0lMbCdkzJy7wrgVEmNn1EIosOY2atFqPcF8zHOY");

// Start streaming
$sc = new DynamicTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
$sc->consume();
