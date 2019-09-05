<?php

namespace AbleCanyon\GeoModal\Block;
use \Magento\Framework\View\Element\Template;
use AbleCanyon\GeoModal\Helper\Data as Helper;

class Modal extends Template
{
    protected $_geomodalHelper;
	
    public function __construct(
        Helper $geomodalHelper,
        Template\Context $context,
		array $data
    )
    {
        $this->_geomodalHelper = $geomodalHelper;
		
        parent::__construct($context, $data);
    }

    public function isAllowed()
    {
        return $this->_geomodalHelper->isAllowed();
    }
	
	public function isGermanLink(){
		return true;
	}
}