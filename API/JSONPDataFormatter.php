<?php
/*
 * Author: Kadir Özdemir
 * email: admin@skorp.eu
 * 
 * So you can send also jsonp requests to the the RestfulServer
 * 
 * @example:
 * domain.com/api/v1/Licence.jsonp/?Licence=123456
 */
class JSONPDataFormatter extends JSONDataFormatter {
	protected $outputContentType = 'application/json';

	public function supportedExtensions() {
		return array(
			'jsonp'
		);
	}
	public function convertDataObjectSet(SS_List $set, $fields = null) {
		$fromparent = parent::convertDataObjectSet($set,$fields);
		$json = (isset($_REQUEST["callback"])?$_REQUEST["callback"]:'callback'." (".$fromparent.");\n";
		return $json;
	}
}
