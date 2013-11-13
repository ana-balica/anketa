<?php
namespace Poll\PollBundle\Service\ServiceImpl;

use Poll\PollBundle\Common\IdentifiedClass;
use Poll\PollBundle\Entity\Respondent;

/**
 * Instantiable implementation of Respondent
 * FOR TESTING PURPOSES ONLY! 
 * @author jirkovoj
 */
final class DummyRespondentImpl extends IdentifiedClass implements Respondent {

	public function getImplementation() {
		return $this;
	}

}