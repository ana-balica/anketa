<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Service\ObjectFactory;

class SharedOptionImpl extends OptionImpl implements SharedOption {

    public function __construct() {
        parent::__construct();
        $this->isShared = ObjectFactory::SHARED_OPTION;
    }
}
