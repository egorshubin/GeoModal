<?php
namespace AbleCanyon\GeoModal\Controller\Config;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use AbleCanyon\GeoModal\Helper\Data;

class Autopopup extends Action
{
    protected $helper;

    /**
     * @param Context     $context
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        Data $helper
    ) {
        $this->helper = $helper;
        parent::__construct($context);
    }

    public function execute()
    {
        $output = $this->helper->isEnabled('enable_auto_popup');
        echo $output;
    }
}