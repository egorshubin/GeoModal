<?php

namespace AbleCanyon\GeoModal\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_SRS = 'web/seo/';
    const DEFAULT_COUNTRY_CODE = "US";
    const XML_PATH_IS_AUTOREDIRECT_URL_DE = "web/seo/autoredirect_to_locale_url_de";
    const XML_PATH_IS_AUTOREDIRECT_URL_GLOBAL = "web/seo/autoredirect_to_locale_url_global";
    const XML_PATH_IS_AUTOREDIRECT_URL_ISRAEL = "web/seo/autoredirect_to_locale_url_il";
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    protected	$_context;

	public function __construct(        
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_storeManager = $storeManager;
        $this->_context = $context;
		parent::__construct($context);
    }

    /**
     * @param $field
     * @param null $storeId
     * @return bool
     */
    public function isEnabled($field, $storeId = null) {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_SRS . $field, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * @param $field
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null) {
        return $this->scopeConfig->getValue(self::XML_PATH_SRS . $field, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * @return string
     */
    public function defineCurrentSite() {
        $website = $this->_storeManager->getWebsite();

        $german_code = $this->getConfigValue('code_de');
        $global_code = $this->getConfigValue('code_global');
        $il_code = $this->getConfigValue('code_il');

        $current_website = 'us';
        $website_code = $website->getCode();
        if ($website_code == $german_code) {
            $current_website = 'german';
        }
        else if ($website_code == $global_code) {
            $current_website = 'global';
        }
        else if ($website_code == $il_code) {
            $current_website = 'israel';
        }

        return $current_website;
    }

    public function getStoreRedirectUrl($type){
        $_url = false;
        switch ($type)
        {
            case 'germany': $_url = $this->_context->getScopeConfig()->getValue(
                self::XML_PATH_IS_AUTOREDIRECT_URL_DE,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            ); break;
            case 'global':$_url = $this->_context->getScopeConfig()->getValue(
                self::XML_PATH_IS_AUTOREDIRECT_URL_GLOBAL,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            ); break;
            case 'israel':$_url = $this->_context->getScopeConfig()->getValue(
                self::XML_PATH_IS_AUTOREDIRECT_URL_ISRAEL,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            ); break;
        }
        return $_url;
    }
}