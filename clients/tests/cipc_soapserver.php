<?php
/**
 * cipc_soapserver class file
 * 
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */

/**
 * table3 class
 */
require_once 'table3.php';

/**
 * cipc_soapserver class
 * 
 *  
 * 
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */
class cipc_soapserver {

  public $client;

  private $uri = 'http://schema.example.com';

  public function cipc_soapserver($wsdl = "http://cipcnet/moodle/wspp/wshelper/service.php?class=cipc_soapserver&wsdl", $uri=null, $options = array()) {
    if($uri != null) {
      $this->uri = $uri;
    };
    $this->client = new SoapClient($wsdl, $options);
  }

  /**
   *  
   *
   * @param int $n
   * @return int
   */
  public function retour_double($n) {
    return $this->client->__call('retour_double', array(
            new SoapParam($n, 'n')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param int $n
   * @return table3
   */
  public function retour_objet($n) {
    return $this->client->__call('retour_objet', array(
            new SoapParam($n, 'n')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param int $n
   * @return intArray
   */
  public function retour_table($n) {
    return $this->client->__call('retour_table', array(
            new SoapParam($n, 'n')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  }

}

?>
