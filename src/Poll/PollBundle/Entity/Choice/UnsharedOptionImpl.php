<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Service\ObjectFactory;

class UnsharedOptionImpl extends OptionImpl implements UnsharedOption {

    public function __construct() {
        parent::__construct();
        $this->isShared = ObjectFactory::UNSHARED_OPTION;
    }
}
