<?php
namespace AbleCanyon\GeoModal\Controller\Geoip;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use AbleCanyon\GeoModal\Helper\Data;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class GeoipAbstract extends Action
{
    /**
     * @var RemoteAddress
     */
    protected $remoteAddress;
    protected $helper;
    /**
     * @param Context     $context
     */
    public function __construct(
        Context $context,
        Data $helper,
        RemoteAddress $remoteAddress
    ) {
        $this->remoteAddress = $remoteAddress;
        $this->helper = $helper;
        parent::__construct($context);
    }

    public function execute() {

    }
}