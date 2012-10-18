<?php
/*
 * Author: Kadir Özdemir
 * email: admin@skorp.eu
 * 
 * LimitSentences method from Silverstripe is only cutting sentences which ends only with a '.'
 * This method cuts also sentences which ends with '.?!'
 * 
 * it's free to use
 */


class LimitSentencesExtension extends Extension {
	public function LimitSen($sentCount=2){
		if(!is_numeric($sentCount)) user_error("Text::LimitSen() expects one numeric argument", E_USER_NOTICE);
		$data = trim(Convert::xml2raw($this->owner->value));
		
		$nakedBody = preg_replace('/\s+/',' ',strip_tags($data));
		$sentences = preg_split('/(\.|\?|\!)/',$nakedBody,0,PREG_SPLIT_DELIM_CAPTURE);

		// because preg_split splits also patterns into an array
		$makeSentCountDouble = $sentCount *2;
		if (count($sentences) <= $makeSentCountDouble)
			return $nakedBody;
		$returnText = "";
		for ($i=0; $i<$makeSentCountDouble;$i++) {
			$returnText .= $sentences[$i];
		}
		return $returnText;
	}
}