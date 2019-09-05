<?php
namespace AbleCanyon\GeoModal\Controller\Geoip;

use AbleCanyon\GeoModal\Helper\Data;
use Magento\Framework\App\Action\Context;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\App\RequestInterface;

class Geoip extends GeoipAbstract
{
    const CF_IP_COUNTRY_VAR = 'HTTP_CF_IPCOUNTRY';

    protected $request;

    public function __construct(
        Context $context,
        Data $helper,
        RemoteAddress $remoteAddress,
        RequestInterface $httpRequest
    ) {
        $this->request = $httpRequest;
        parent::__construct($context, $helper, $remoteAddress);
    }


    public function execute()
    {
        $code = $this->request->getServer(self::CF_IP_COUNTRY_VAR);
        $storeres = $code . '/';
        $storeres .= $this->helper->defineCurrentSite();
        echo $storeres;
    }
}