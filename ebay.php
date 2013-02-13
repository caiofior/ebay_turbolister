<?php
/**
 * Encodes and decodes ShippingServiceOptions for Ebay Turbolister for importing products in
 * <a href="http://pages.ebay.it/turbo_lister/csvfaq.html">ebay shop</a>
 * Based on <a href="http://www.mikemarsbooks.co.uk/TurbolisterConvert/">mikemarsbooks.co.uk</a> script
 * @author Claudio Fior
 * @version 1.0
 */
class Ebay {
	/**
	 * Decodes a string to XML
	 * @param string $string String to be decoded
	 * @return string XML decoded
	 */
	public function decode($string) {
		$string = base64_decode(str_replace('%0d%0a', '', $string));
		$c = 0;
		$xml = '';
		while (isset($string[$c])) {
			if ($c % 2 == 0)
				$xml .= $string[$c];
			$c++;
		}
		return $xml;
	}
	/**
	 * Decodes an XML to string
	 * @param string $xml
	 * @return string
	 */
	public function encode($xml) {
        $string = base64_encode($this->xorstring($xml));
		$string = substr($string,0,4) . "\r\n" . substr(chunk_split(substr($string,4)),0,-2);
		$string = str_replace(array("\r","\n"),array('%0d','%0a'),$string);
		return $string;
	}
	/**
	 * Enodex contro character
	 * @param string $str
	 * @return string
	 */
	private function xorstring($str) {
		 $str = $this->convert_string($str);
         $x = 0;
         $n=strlen($str);
         for ($i=0;$i<$n;$i++) {
                 $x = $x ^ ord($str{$i});
         }
         return $str . chr($x) . chr(0);
	}
	/**
	 * Adds a control char
	 * @param string $str
	 * @return string
	 */
	private function convert_string($str) {
         $str16 = '';
         $n=strlen($str);
         for ($i=0;$i<$n;$i++) {
                 $str16 .= $str{$i} . chr(0);
         }
         return $str16;
	}
}