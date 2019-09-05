<?php
/**
 * Copyright (c) 2018. AbleCanyon. All rights reserved.
 */

namespace AbleCanyon\GeoModal\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package AbleCanyon\GeoModal\Controller\Index
 */
class Index extends Action {

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;
    /**
     * @var Context
     */
    protected $context;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var \Magento\Store\Model\StoreRepository
     */
    protected $storeRepository;

    protected $_geoipHelper;

    /**
     * Index constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Store\Model\StoreRepository $storeRepository,
        \AbleCanyon\GeoModal\Helper\Data $geoipHelper
    )
    {
        parent::__construct($context);
        $this->context = $context;
        $this->request = $context->getRequest();
        $this->storeManager = $storeManager;
        $this->storeRepository = $storeRepository;
        $this->_geoipHelper = $geoipHelper;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $country = $this->request->getParam('selection', null);
        $_stores = $this->storeRepository->getList();

        if ( $country == 'us_ca' ){
            $redirectUrl = $this->storeRepository->getActiveStoreByCode('default')->getBaseUrl();
        }else{
            if (isset($_stores[$country]))
            {
                $redirectUrl = $_stores[$country]->getBaseUrl();
            }else{
                $redirectUrl = $this->_geoipHelper->getStoreRedirectUrl($country);
            }
        }

        if (!$redirectUrl)
            $redirectUrl = $this->storeRepository->getActiveStoreByCode('default')->getBaseUrl();

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($redirectUrl);

        return $resultRedirect;
    }
}
