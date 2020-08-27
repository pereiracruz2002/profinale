<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MGS\Mpanel\Helper;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;

/**
 * Contact base helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	protected $_storeManager;
	
	protected $_date;
	
	protected $_url;
	
	protected $_filesystem;
	
	protected $_request;
	
	protected $_acceptToUsePanel = false;
	
	protected $_useBuilder = false;
	
	protected $_customer;
	
	/**
     * Asset service
     *
     * @var \Magento\Framework\View\Asset\Repository
     */
    protected $_assetRepo;
	
    protected $filterManager;
	
	/**
     * Block factory
     *
     * @var \Magento\Cms\Model\BlockFactory
     */
    protected $_blockFactory;
	
	/**
     * Page factory
     *
     * @var \Magento\Cms\Model\PageFactory
     */
    protected $_pageFactory;
	
	protected $_file;
	
	/**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;
	
    protected $_fullActionName;
	
    protected $_currentCategory;
	
    protected $_currentProduct;
	
    protected $_category;
	
    protected $scopeConfig;
	
	public function __construct(
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Framework\Stdlib\DateTime\DateTime $date,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Framework\Url $url,
		\Magento\Framework\Filesystem $filesystem,
		\Magento\Framework\App\Request\Http $request,
		\Magento\Framework\View\Element\Context $context,
		\Magento\Cms\Model\BlockFactory $blockFactory,
		\Magento\Catalog\Model\Category $category,
		\Magento\Cms\Model\PageFactory $pageFactory,
		\Magento\Framework\Filesystem\Driver\File $file,
		CustomerSession $customerSession
	) {
		$this->scopeConfig = $context->getScopeConfig();
		$this->_storeManager = $storeManager;
		$this->_date = $date;
		$this->_url = $url;
		$this->_filesystem = $filesystem;
		$this->customerSession = $customerSession;
		$this->_objectManager = $objectManager;
		$this->_category = $category;
		$this->_request = $request;
		$this->filterManager = $context->getFilterManager();
		$this->_assetRepo = $context->getAssetRepository();
		$this->_blockFactory = $blockFactory;
		$this->_pageFactory = $pageFactory;
		$this->_file = $file;
		
		$this->_fullActionName = $this->_request->getFullActionName();
		
		if($this->_fullActionName == 'catalog_category_view'){
			$this->_currentCategory = $this->getCurrentCategory();
		}
		
		if($this->_fullActionName == 'catalog_product_view'){
			$this->_currentProduct = $this->getCurrentProduct();
		}
	}
	
	public function getModel($model){
		return $this->_objectManager->create($model);
	}
	
	/**
     * Retrieve current url in base64 encoding
     *
     * @return string
     */
	public function getCurrentBase64Url()
    {
		return strtr(base64_encode($this->_url->getCurrentUrl()), '+/=', '-_,');
    }
	
	/**
     * base64_decode() for URLs decoding
     *
     * @param    string $url
     * @return   string
     */
    public function decode($url)
    {
        $url = base64_decode(strtr($url, '-_,', '+/='));
        return $this->_url->sessionUrlVar($url);
    }

    /**
     * Returns customer id from session
     *
     * @return int|null
     */
    public function getCustomerId()
    {
		$customerInSession = $this->_objectManager->create('Magento\Customer\Model\Session');
        return $customerInSession->getCustomerId();
    }
	
	/* Get current customer */
	public function getCustomer(){
		if(!$this->_customer){
			$this->_customer = $this->getModel('Magento\Customer\Model\Customer')->load($this->getCustomerId());
		}
		return $this->_customer;
	}
	
	public function getStore(){
		return $this->_storeManager->getStore();
	}
	
	/* Get system store config */
	public function getStoreConfig($node, $storeId = NULL){
		if($storeId != NULL){
			return $this->scopeConfig->getValue($node, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
		}
		return $this->scopeConfig->getValue($node, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $this->getStore()->getId());
	}
	
	// Check to accept to use builder panel
    public function acceptToUsePanel() {
		if($this->_acceptToUsePanel){
			return true;
		}else{
			if ($this->showButton() && ($this->customerSession->getUsePanel() == 1)) {
				$this->_acceptToUsePanel = true;
				return true;
			}
			$this->_acceptToUsePanel = false;
			return false;
		}
        
    }

	/* Check to visible panel button */
    public function showButton() {

        if ($this->getStoreConfig('mpanel/general/is_enabled')) {
            $customer = $this->getCustomer();
			if($customer->getIsBuilderAccount() == 1){
				return true;
			}
			return false;
        }

        return false;
    }
	
	/* Get all settings of the theme */
	public function getThemeSettings(){
		return [
			'catalog'=> 
			[
				'per_row' => $this->getStoreConfig('mpanel/catalog/product_per_row'),
				'featured' => $this->getStoreConfig('mpanel/catalog/featured'),
				'hot' => $this->getStoreConfig('mpanel/catalog/hot'),
				'ratio' => $this->getStoreConfig('mpanel/catalog/picture_ratio'),
				'new_label' => $this->getStoreConfig('mpanel/catalog/new_label'),
				'sale_label' => $this->getStoreConfig('mpanel/catalog/sale_label'),
				'preload' => $this->getStoreConfig('mpanel/catalog/preload'),
				'ajaxscroll' => $this->getStoreConfig('mpanel/catalog/ajaxscroll'),
				'wishlist_button' => $this->getStoreConfig('mpanel/catalog/wishlist_button'),
				'compare_button' => $this->getStoreConfig('mpanel/catalog/compare_button')
			],
			'catalogsearch'=> 
			[
				'per_row' => $this->getStoreConfig('mpanel/catalogsearch/product_per_row')
			],
			'product_details'=> 
			[
				'sku' => $this->getStoreConfig('mpanel/product_details/sku'),
				'reviews_summary' => $this->getStoreConfig('mpanel/product_details/reviews_summary'),
				'wishlist' => $this->getStoreConfig('mpanel/product_details/wishlist'),
				'compare' => $this->getStoreConfig('mpanel/product_details/compare'),
				'preload' => $this->getStoreConfig('mpanel/product_details/preload'),
				'short_description' => $this->getStoreConfig('mpanel/product_details/short_description'),
				'upsell_products' => $this->getStoreConfig('mpanel/product_details/upsell_products')
			],
			'product_tabs'=> 
			[
				'show_description' => $this->getStoreConfig('mpanel/product_tabs/show_description'),
				'show_additional' => $this->getStoreConfig('mpanel/product_tabs/show_additional'),
				'show_reviews' => $this->getStoreConfig('mpanel/product_tabs/show_reviews'),
				'show_product_tag_list' => $this->getStoreConfig('mpanel/product_tabs/show_product_tag_list')
			],
			'contact_google_map'=> 
			[
				'display_google_map' => $this->getStoreConfig('mpanel/contact_google_map/display_google_map'),
				'api_key' => $this->getStoreConfig('mpanel/contact_google_map/api_key'),
				'address_google_map' => $this->getStoreConfig('mpanel/contact_google_map/address_google_map'),
				'html_google_map' => $this->getStoreConfig('mpanel/contact_google_map/html_google_map'),
				'pin_google_map' => $this->getStoreConfig('mpanel/contact_google_map/pin_google_map')
			],
			'banner_slider'=> 
			[
				'slider_tyle' => $this->getStoreConfig('mgstheme/banner_slider/slider_tyle'),
				'id_reslider' => $this->getStoreConfig('mgstheme/banner_slider/id_reslider'),
				'identifier_block' => $this->getStoreConfig('mgstheme/banner_slider/identifier_block'),
				'banner_owl_auto' => $this->getStoreConfig('mgstheme/banner_slider/banner_owl_auto'),
				'banner_owl_speed' => $this->getStoreConfig('mgstheme/banner_slider/banner_owl_speed'),
				'banner_owl_loop' => $this->getStoreConfig('mgstheme/banner_slider/banner_owl_loop'),
				'banner_owl_nav' => $this->getStoreConfig('mgstheme/banner_slider/banner_owl_nav'),
				'banner_owl_dot' => $this->getStoreConfig('mgstheme/banner_slider/banner_owl_dot')
			]
		];
	}
	
	/* Get col for responsive */
	public function getColClass($perrow = NULL){
		if(!$perrow){
			$settings = $this->getThemeSettings();
			$perrow = $settings['catalog']['per_row'];
			
			if($this->_fullActionName == 'catalog_category_view'){
				$category = $this->_currentCategory;
				$categoryPerrow = $category->getPerRow();
				if($categoryPerrow!=''){
					$perrow = $categoryPerrow;
				}
			}
			
			if($this->_fullActionName == 'catalogsearch_result_index'){
				$perrow = $settings['catalogsearch']['per_row'];
			}
			
		}
		
		switch($perrow){
			case 2:
				return 'col-lg-6 col-md-6 col-sm-6 col-xs-6';
				break;
			case 3:
				return 'col-lg-4 col-md-4 col-sm-4 col-xs-6';
				break;
			case 4:
				return 'col-lg-3 col-md-3 col-sm-6 col-xs-6';
				break;
			case 5:
				return 'col-lg-custom-5 col-md-custom-5 col-sm-6 col-xs-6';
				break;
			case 6:
				return 'col-lg-2 col-md-2 col-sm-3 col-xs-6';
				break;
			case 7:
				return 'col-lg-custom-7 col-md-custom-7 col-sm-6 col-xs-6';
				break;
			case 8:
				return 'col-lg-custom-8 col-md-custom-8 col-sm-6 col-xs-6';
				break;
		}
		return;
	}
	/* Get product image size */
	public function getImageSize($ratio = NULL){
		if(!$ratio){
			$ratio = $this->getStoreConfig('mpanel/catalog/picture_ratio');
			if($this->_fullActionName == 'catalog_category_view'){
				$category = $this->_currentCategory;
				$categoryRatio = $category->getPictureRatio();
				if($categoryRatio!=''){
					$ratio = $categoryRatio;
				}
			}
		}
		
		$maxWidth = $this->getStoreConfig('mpanel/catalog/max_width_image');
		$result = [];
        switch ($ratio) {
            // 1/1 Square
            case 1:
                $result = array('width' => round($maxWidth), 'height' => round($maxWidth));
                break;
            // 1/2 Portrait
            case 2:
                $result = array('width' => round($maxWidth), 'height' => round($maxWidth*2));
                break;
            // 2/3 Portrait
            case 3:
                $result = array('width' => round($maxWidth), 'height' => round(($maxWidth * 1.5)));
                break;
            // 3/4 Portrait
            case 4:
                $result = array('width' => round($maxWidth), 'height' => round(($maxWidth * 4) / 3));
                break;
            // 2/1 Landscape
            case 5:
                $result = array('width' => round($maxWidth), 'height' => round($maxWidth/2));
                break;
            // 3/2 Landscape
            case 6:
                $result = array('width' => round($maxWidth), 'height' => round(($maxWidth*2) / 3));
                break;
            // 4/3 Landscape
            case 7:
                $result = array('width' => round($maxWidth), 'height' => round(($maxWidth*3) / 4));
                break;
        }

        return $result;
	}
	
	/* Get product image size for product details page*/
	public function getImageSizeForDetails() {
		$ratio = $this->getStoreConfig('mpanel/catalog/picture_ratio');
		$maxWidth = $this->getStoreConfig('mpanel/catalog/max_width_image_detail');
        $result = [];
        switch ($ratio) {
            // 1/1 Square
            case 1:
                $result = array('width' => round($maxWidth), 'height' => round($maxWidth));
                break;
            // 1/2 Portrait
            case 2:
                $result = array('width' => round($maxWidth), 'height' => round($maxWidth*2));
                break;
            // 2/3 Portrait
            case 3:
                $result = array('width' => round($maxWidth), 'height' => round(($maxWidth * 1.5)));
                break;
            // 3/4 Portrait
            case 4:
                $result = array('width' => round($maxWidth), 'height' => round(($maxWidth * 4) / 3));
                break;
            // 2/1 Landscape
            case 5:
                $result = array('width' => round($maxWidth), 'height' => round($maxWidth/2));
                break;
            // 3/2 Landscape
            case 6:
                $result = array('width' => round($maxWidth), 'height' => round(($maxWidth*2) / 3));
                break;
            // 4/3 Landscape
            case 7:
                $result = array('width' => round($maxWidth), 'height' => round(($maxWidth*3) / 4));
                break;
        }

        return $result;
    }
	
	public function getImageMinSize() {
        $ratio = $this->getStoreConfig('mpanel/catalog/picture_ratio');
        $result = [];
        switch ($ratio) {
            // 1/1 Square
            case 1:
                $result = array('width' => 80, 'height' => 80);
                break;
            // 1/2 Portrait
            case 2:
                $result = array('width' => 80, 'height' => 160);
                break;
            // 2/3 Portrait
            case 3:
                $result = array('width' => 80, 'height' => 120);
                break;
            // 3/4 Portrait
            case 4:
                $result = array('width' => 80, 'height' => 107);
                break;
            // 2/1 Landscape
            case 5:
                $result = array('width' => 80, 'height' => 40);
                break;
            // 3/2 Landscape
            case 6:
                $result = array('width' => 80, 'height' => 53);
                break;
            // 4/3 Landscape
            case 7:
                $result = array('width' => 80, 'height' => 60);
                break;
        }

        return $result;
    }
	
	public function getProductLabel($product){
		$html = '';
		$newLabel = $this->getStoreConfig('mpanel/catalog/new_label');
        $saleLabel = $this->getStoreConfig('mpanel/catalog/sale_label');
		
		// Sale label
		$price = $product->getPrice();
		$finalPrice = $product->getFinalPrice();
		if($this->getStoreConfig('mpanel/catalog/sale_label_discount') == 1){
			if(($finalPrice<$price)){
				$save = $price - $finalPrice;
				$percent = round(($save * 100) / $price);
				$html .= '<span class="product-label sale-label"><span>-'.$percent.'%</span></span>';
			}
		}else {
			if(($finalPrice<$price) && ($saleLabel!='')){
				$html .= '<span class="product-label sale-label"><span>'.$saleLabel.'</span></span>';
			}
		}
		// New label
		$now = $this->_date->gmtDate();
		$dateTimeFormat = \Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT;
		$newFromDate = $product->getNewsFromDate();
		if($newFromDate) {
			$newFromDate = date($dateTimeFormat, strtotime($newFromDate));
		}
        $newToDate = $product->getNewsToDate();
		if($newToDate) {
			$newToDate = date($dateTimeFormat, strtotime($newToDate));
		}
		if($newLabel != ''){
			if(!(empty($newToDate))){
				if(!(empty($newFromDate)) && ($newFromDate < $now) && ($newToDate > $now)){
					$html.='<span class="product-label new-label"><span>'.$newLabel.'</span></span>';
				}
			}else {
				if(!(empty($newFromDate)) && ($newFromDate < $now)){
					$html.='<span class="product-label new-label"><span>'.$newLabel.'</span></span>';
				}
			}	
		}
		return $html;
	}
	
	public function getUrlBuilder(){
		return $this->_url;
	}
	
	public function getCssUrl(){
		return $this->_url->getUrl('mpanel/index/css',['store'=>$this->getStore()->getId()]);
	}
	
	public function getPanelCssUrl(){
		return $this->_url->getUrl('mpanel/index/panelstyle');
	}
	
	public function getFonts() {
        return [
            ['css-name' => 'Lato', 'font-name' => __('Lato')],
            ['css-name' => 'Open+Sans', 'font-name' => __('Open Sans')],
            ['css-name' => 'Roboto', 'font-name' => __('Roboto')],
            ['css-name' => 'Roboto Slab', 'font-name' => __('Roboto Slab')],
            ['css-name' => 'Oswald', 'font-name' => __('Oswald')],
            ['css-name' => 'Source+Sans+Pro', 'font-name' => __('Source Sans Pro')],
            ['css-name' => 'PT+Sans', 'font-name' => __('PT Sans')],
            ['css-name' => 'PT+Serif', 'font-name' => __('PT Serif')],
            ['css-name' => 'Droid+Serif', 'font-name' => __('Droid Serif')],
            ['css-name' => 'Josefin+Slab', 'font-name' => __('Josefin Slab')],
            ['css-name' => 'Montserrat', 'font-name' => __('Montserrat')],
            ['css-name' => 'Ubuntu', 'font-name' => __('Ubuntu')],
            ['css-name' => 'Titillium+Web', 'font-name' => __('Titillium Web')],
            ['css-name' => 'Noto+Sans', 'font-name' => __('Noto Sans')],
            ['css-name' => 'Lora', 'font-name' => __('Lora')],
            ['css-name' => 'Playfair+Display', 'font-name' => __('Playfair Display')],
            ['css-name' => 'Bree+Serif', 'font-name' => __('Bree Serif')],
            ['css-name' => 'Vollkorn', 'font-name' => __('Vollkorn')],
            ['css-name' => 'Alegreya', 'font-name' => __('Alegreya')],
            ['css-name' => 'Noto+Serif', 'font-name' => __('Noto Serif')]
        ];
    }
	
	public function getLinksFont() {
        $setting = [
			'default_font' => $this->getStoreConfig('mgstheme/fonts/default_font'),
			'h1' => $this->getStoreConfig('mgstheme/fonts/h1'),
			'h2' => $this->getStoreConfig('mgstheme/fonts/h2'),
			'h3' => $this->getStoreConfig('mgstheme/fonts/h3'),
			'h4' => $this->getStoreConfig('mgstheme/fonts/h4'),
			'h5' => $this->getStoreConfig('mgstheme/fonts/h5'),
			'h6' => $this->getStoreConfig('mgstheme/fonts/h6'),
			'price' => $this->getStoreConfig('mgstheme/fonts/price'),
			'menu' => $this->getStoreConfig('mgstheme/fonts/menu'),
		];
        $fonts = [];
        $fonts[] = $setting['default_font'];

        if (!in_array($setting['h1'], $fonts)) {
            $fonts[] = $setting['h1'];
        }

        if (!in_array($setting['h2'], $fonts)) {
            $fonts[] = $setting['h2'];
        }

        if (!in_array($setting['h3'], $fonts)) {
            $fonts[] = $setting['h3'];
        }

        if (!in_array($setting['price'], $fonts)) {
            $fonts[] = $setting['price'];
        }

        if (!in_array($setting['menu'], $fonts)) {
            $fonts[] = $setting['menu'];
        }

        $fonts = array_filter($fonts);
        $links = '';

        foreach ($fonts as $_font) {
			$links .= '<link href="//fonts.googleapis.com/css?family=' . $_font . ':300,300italic,400,400italic,600,600italic,700,700italic,900,900italic" rel="stylesheet" type="text/css"/>';
        }

        return $links;
    }
	
	// get theme color
    public function getThemecolorSetting($storeId) {
        $setting = [];
        $setting = array_filter($setting);
        return $setting;
    }
	
	// get header custom color
    public function getHeaderColorSetting($storeId) {
        $setting = [
            /* Header Top Section */
			'.header .top-header-content' => [
                'color' => $this->getStoreConfig('color/header/text_color', $storeId),
                'background-color' => $this->getStoreConfig('color/header/background_color', $storeId)
            ],
			'.top-header-content a,.header .top-header-content .switcher-toggle' => [
                'color' => $this->getStoreConfig('color/header/link_color', $storeId)
            ],
			'.top-header-content a:hover, .header .top-header-content .switcher-toggle:hover, .header .top-header-content dropdown-switcher.open .switcher-toggle' => [
                'color' => $this->getStoreConfig('color/header/link_hover_color', $storeId)
            ],
			/* Header Middle Section */
			'.middle-header-content' => [
                'background-color' => $this->getStoreConfig('color/header/middle_background', $storeId)
            ],
			/* Top Cart Section */
			'.minicart-wrapper .action.showcart:before' => [
                'color' => $this->getStoreConfig('color/header/cart_icon', $storeId)
            ],
			'.minicart-wrapper .action.showcart .counter.qty' => [
                'background-color' => $this->getStoreConfig('color/header/cart_number_background', $storeId),
                'color' => $this->getStoreConfig('color/header/cart_number', $storeId)
            ],
			/* Menu Section */
			'.megamenu-content' => [
                'background-color' => $this->getStoreConfig('color/header/menu_background', $storeId)
            ],
			'.nav-main-menu > li > a' => [
                'background-color' => $this->getStoreConfig('color/header/lv1_background', $storeId),
				'color' => $this->getStoreConfig('color/header/lv1_color', $storeId)
            ],
			'.nav-main-menu > li > a:hover' => [
                'background-color' => $this->getStoreConfig('color/header/lv1_background_hover', $storeId),
				'color' => $this->getStoreConfig('color/header/lv1_color_hover', $storeId)
            ],
        ];
        $setting = array_filter($setting);
        return $setting;
    }
	
	// get main content custom color
    public function getMainColorSetting($storeId) {
        $setting = [
            /* Text & Link color */
            '.page-main' => [
                'color' => $this->getStoreConfig('color/main/text_color', $storeId)
            ],
			'.page-main a' => [
                'color' => $this->getStoreConfig('color/main/link_color', $storeId)
            ],
			'.page-main a:hover' => [
                'color' => $this->getStoreConfig('color/main/link_color_hover', $storeId)
            ],
			'.page-main .price, .page-main .price-box .price' => [
                'color' => $this->getStoreConfig('color/main/price_color', $storeId)
            ],
			/* Default button color */
            'button, button.btn, button.btn-default' => [
                'color' => $this->getStoreConfig('color/main/button_text', $storeId),
                'background-color' => $this->getStoreConfig('color/main/button_background', $storeId),
                'border-color' => $this->getStoreConfig('color/main/button_border', $storeId)
            ],
			'button:hover, button.btn:hover, button.btn-default:hover' => [
                'color' => $this->getStoreConfig('color/main/button_text_hover', $storeId),
                'background-color' => $this->getStoreConfig('color/main/button_background_hover', $storeId),
                'border-color' => $this->getStoreConfig('color/main/button_border_hover', $storeId)
            ],
			/* Primary button color */
            'button.btn-primary' => [
                'color' => $this->getStoreConfig('color/main/primary_button_text'),
                'background-color' => $this->getStoreConfig('color/main/primary_button_background', $storeId),
                'border-color' => $this->getStoreConfig('color/main/primary_button_border', $storeId)
            ],
			'button.btn-primary:hover' => [
                'color' => $this->getStoreConfig('color/main/primary_button_text_hover', $storeId),
                'background-color' => $this->getStoreConfig('color/main/primary_button_background_hover', $storeId),
                'border-color' => $this->getStoreConfig('color/main/primary_button_border_hover', $storeId)
            ],
			/* Secondary button color */
            'button.btn-secondary' => [
                'color' => $this->getStoreConfig('color/main/secondary_button_text', $storeId),
                'background-color' => $this->getStoreConfig('color/main/secondary_button_background', $storeId),
                'border-color' => $this->getStoreConfig('color/main/secondary_button_border', $storeId)
            ],
			'button.btn-secondary:hover' => [
                'color' => $this->getStoreConfig('color/main/secondary_button_text_hover', $storeId),
                'background-color' => $this->getStoreConfig('color/main/secondary_button_background_hover', $storeId),
                'border-color' => $this->getStoreConfig('color/main/secondary_button_border_hover', $storeId)
            ],
        ];
        $setting = array_filter($setting);
        return $setting;
    }
	
	// get main content custom color
    public function getFooterColorSetting($storeId) {
        $setting = [
            /* Top Footer Section */
            'footer .top-footer' => [
                'background-color' => $this->getStoreConfig('color/footer/top_background_color', $storeId),
                'color' => $this->getStoreConfig('color/footer/top_text_color', $storeId),
                'border-color' => $this->getStoreConfig('color/footer/top_border_color', $storeId)
            ],
			'footer .top-footer h1,footer .top-footer h2,footer .top-footer h3,footer .top-footer h4,footer .top-footer h5,footer .top-footer h6,footer .top-footer .h1,footer .top-footer .h2,footer .top-footer .h3,footer .top-footer .h4,footer .top-footer .h5,footer .top-footer .h6' => [
                'color' => $this->getStoreConfig('color/footer/top_heading_color', $storeId),
            ],
			'footer .top-footer a' => [
                'color' => $this->getStoreConfig('color/footer/top_link_color', $storeId),
            ],
			'footer .top-footer a:hover' => [
                'color' => $this->getStoreConfig('color/footer/top_link_color_hover', $storeId),
            ],
			/* Middle Footer Section */
            'footer .middle-footer' => [
                'background-color' => $this->getStoreConfig('color/footer/middle_background_color', $storeId),
                'color' => $this->getStoreConfig('color/footer/middle_text_color', $storeId),
                'border-color' => $this->getStoreConfig('color/footer/middle_border_color', $storeId)
            ],
			'footer .middle-footer h1,footer .middle-footer h2,footer .middle-footer h3,footer .middle-footer h4,footer .middle-footer h5,footer .middle-footer h6,footer .middle-footer .h1,footer .middle-footer .h2,footer .middle-footer .h3,footer .middle-footer .h4,footer .middle-footer .h5,footer .middle-footer .h6' => [
                'color' => $this->getStoreConfig('color/footer/middle_heading_color', $storeId),
            ],
			'footer .middle-footer a' => [
                'color' => $this->getStoreConfig('color/footer/middle_link_color', $storeId),
            ],
			'footer .middle-footer a:hover' => [
                'color' => $this->getStoreConfig('color/footer/middle_link_color_hover', $storeId),
            ],
			/* Bottom Footer Section */
            'footer .bottom-footer' => [
                'background-color' => $this->getStoreConfig('color/footer/bottom_background_color', $storeId),
                'color' => $this->getStoreConfig('color/footer/bottom_text_color', $storeId),
                'border-color' => $this->getStoreConfig('color/footer/bottom_border_color', $storeId)
            ],
			'footer .bottom-footer h1,footer .bottom-footer h2,footer .bottom-footer h3,footer .bottom-footer h4,footer .bottom-footer h5,footer .bottom-footer h6,footer .bottom-footer .h1,footer .bottom-footer .h2,footer .bottom-footer .h3,footer .bottom-footer .h4,footer .bottom-footer .h5,footer .bottom-footer .h6' => [
                'color' => $this->getStoreConfig('color/footer/bottom_heading_color', $storeId),
            ],
			'footer .bottom-footer a' => [
                'color' => $this->getStoreConfig('color/footer/bottom_link_color', $storeId),
            ],
			'footer .bottom-footer a:hover' => [
                'color' => $this->getStoreConfig('color/footer/bottom_link_color_hover', $storeId),
            ],
        ];
        $setting = array_filter($setting);
        return $setting;
    }
	
	/* Get css content of panel */
	public function getPanelStyle(){
		$dir = $this->_filesystem->getDirectoryRead(DirectoryList::APP)->getAbsolutePath('code/MGS/Mpanel/view/frontend/web/css/panel.css');
		$content = file_get_contents($dir);
		return $content;
	}
	
	/* Check store view has use homepage builder or not */
	public function useBuilder(){
		if($this->_useBuilder){
			return true;
		}else{
			$storePanelCollection = $this->getModel('MGS\Mpanel\Model\Store')
				->getCollection()
				->addFieldToFilter('store_id', $this->getStore()->getId())
				->addFieldToFilter('status', 1);
			if(count($storePanelCollection)>0){
				$this->_useBuilder = true;
				return true;
			}
			$this->_useBuilder = false;
			return false;
		}
		
	}
	
	/* Check current page is homepage or not */
	public function isHomepage(){
		if ($this->_fullActionName == 'cms_index_index') {
			return true;
		}
		return false;
	}
	
	/* Get Animation Effect */
	public function getAnimationEffect(){
		return [
			'bounce' => 'Bounce',
			'flash' => 'Flash',
			'pulse' => 'Pulse',
			'rubberBand' => 'Rubber Band',
			'shake' => 'Shake',
			'swing' => 'Swing',
			'tada' => 'Tada',
			'wobble' => 'Wobble',
			'bounceIn' => 'Bounce In',
			'fadeIn' => 'Fade In',
			'fadeInDown' => 'Fade In Down',
			'fadeInDownBig' => 'Fade In Down Big',
			'fadeInLeft' => 'Fade In Left',
			'fadeInLeftBig' => 'Fade In Left Big',
			'fadeInRight' => 'Fade In Right',
			'fadeInRightBig' => 'Fade In Right Big',
			'fadeInUp' => 'Fade In Up',
			'fadeInUpBig' => 'Fade In Up Big',
			'flip' => 'Flip',
			'flipInX' => 'Flip In X',
			'flipInY' => 'Flip In Y',
			'lightSpeedIn' => 'Light Speed In',
			'rotateIn' => 'Rotate In',
			'rotateInDownLeft' => 'Rotate In Down Left',
			'rotateInDownRight' => 'Rotate In Down Right',
			'rotateInUpLeft' => 'Rotate In Up Left',
			'rotateInUpRight' => 'Rotate In Up Right',
			'rollIn' => 'Roll In',
			'zoomIn' => 'Zoom In',
			'zoomInDown' => 'Zoom In Down',
			'zoomInLeft' => 'Zoom In Left',
			'zoomInRight' => 'Zoom In Right',
			'zoomInUp' => 'Zoom In Up',
		];
	}
	
	public function getViewFileUrl($fileId, array $params = [])
    {
        try {
            $params = array_merge(['_secure' => $this->_request->isSecure()], $params);
            return $this->_assetRepo->getUrlWithParams($fileId, $params);
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->_logger->critical($e);
            return $this->_getNotFoundUrl();
        }
    }
	
	public function getColorAccept($type, $color = NULL) {
		$dir = $this->_filesystem->getDirectoryRead(DirectoryList::APP)->getAbsolutePath('code/MGS/Mpanel/view/frontend/web/images/panel/colour/');
        $html = '';
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                $html .= '<ul>';

                while ($files[] = readdir($dh));
                sort($files);
                foreach ($files as $file) {
                    $file_parts = pathinfo($dir . $file);
                    if (isset($file_parts['extension']) && $file_parts['extension'] == 'png') {
                        $colour = str_replace('.png', '', $file);
                        $wrapper = str_replace('_', '-', $type);
						$_color = explode('.', $colour);
                        $colour = $wrapper . '-' . strtolower(end($_color));
                        $html .= '<li>';
                        $html .= '<a href="#" onclick="changeInputColor(\'' . $colour . '\', \'' . $type . '\', this, \'' . $wrapper . '-content\'); return false"';
                        if ($color != NULL && $color == $colour) {
                            $html .= ' class="active"';
                        }
                        $html .= '>';
                         $html .= '<img src="' . $this->getViewFileUrl('MGS_Mpanel::images/panel/colour/'.$file) . '" alt=""/>';
                        $html .= '</a>';
                        $html .= '</li>';
                    }
                }
                $html .= '</ul>';
            }
        }
        return $html;
    }
	
	public function convertPerRowtoCol($perRow){
		switch ($perRow) {
            case 1:
                $result = 12;
                break;
            case 2:
                $result = 6;
                break;
            case 3:
                $result = 4;
                break;
            case 4:
                $result = 3;
                break;
            case 5:
                $result = 'custom-5';
                break;
            case 6:
                $result = 2;
				break;
			case 7:
                $result = 'custom-7';
				break;
			case 8:
                $result = 'custom-8';
                break;
        }
		
		return $result;
	}
	
	public function convertColClass($col, $type){
		if(($type=='row') && ($col=='custom-5' || $col=='custom-7' || $col=='custom-8')){
			return 'row-'.$col;
		}
		if($type=='col'){
			if(($col=='custom-5' || $col=='custom-7' || $col=='custom-8')){
				return 'col-md-'.$col. ' col-sm-3 col-xs-6';
			}else{
				$class = 'col-lg-'.$col.' col-md-'.$col;
				if($col==12){
					$class .= ' col-sm-12 col-xs-12';
				}
				if($col==6){
					$class .= ' col-sm-6 col-xs-6';
				}
				if(($col==4) || ($col==3)){
					$class .= ' col-sm-4 col-xs-6';
				}
				if($col==2){
					$class .= ' col-sm-3 col-xs-6';
				}
				
				return $class;
			}
		}
	}
	
	
	/* Get class clear left */
	public function getClearClass($perrow = NULL, $nb_item){
		if(!$perrow){
			$settings = $this->getThemeSettings();
			$perrow = $settings['catalog']['per_row'];
		}
		$clearClass = '';
		switch($perrow){
			case 2:
				if($nb_item % 2 == 1){
					$clearClass.= " first-row-item first-sm-item first-xs-item";
				}
				return $clearClass;
				break;
			case 3:
				if($nb_item % 3 == 1){
					$clearClass.= " first-row-item first-sm-item";
				}
				if($nb_item % 2 == 1){
					$clearClass.= " row-xs-first";
				}
				return $clearClass;
				break;
			case 4:
				if($nb_item % 4 == 1){
					$clearClass.= " first-row-item";
				}
				if($nb_item % 3 == 1){
					$clearClass.= " first-sm-item";
				}
				if($nb_item % 2 == 1){
					$clearClass.= " first-xs-item";
				}
				return $clearClass;
				break;
			case 5:
				if($nb_item % 5 == 1){
					$clearClass.= " first-row-item";
				}
				if($nb_item % 3 == 1){
					$clearClass.= " first-sm-item";
				}
				if($nb_item % 2 == 1){
					$clearClass.= " first-xs-item";
				}
				return $clearClass;
				break;
			case 6:
				if($nb_item % 6 == 1){
					$clearClass.= " first-row-item";
				}
				if($nb_item % 3 == 1){
					$clearClass.= " first-sm-item";
				}
				if($nb_item % 2 == 1){
					$clearClass.= " first-xs-item";
				}
				return $clearClass;
				break;
			case 7:
				if($nb_item % 7 == 1){
					$clearClass.= " first-row-item";
				}
				if($nb_item % 2 == 1){
					$clearClass.= " first-sm-item first-xs-item";
				}
				return $clearClass;
				break;
			case 8:
				if($nb_item % 8 == 1){
					$clearClass.= " first-row-item";
				}
				if($nb_item % 3 == 1){
					$clearClass.= " first-sm-item";
				}
				if($nb_item % 2 == 1){
					$clearClass.= " first-xs-item";
				}
				return $clearClass;
				break;
		}
		return $clearClass;
	}
	
	
	public function getRootCategory(){
		$store = $this->getStore();
		$categoryId = $store->getRootCategoryId();
		$category = $this->getModel('Magento\Catalog\Model\Category')->load($categoryId);
		return $category;
	}
	
	public function getTreeCategory($category, $parent, $ids = array(), $checkedCat){
		$rootCategoryId = $this->getRootCategory()->getId();
		$children = $category->getChildrenCategories();
		$childrenCount = count($children);
		//$checkedCat = explode(',',$checkedIds);
		$htmlLi = '<li lang="'.$category->getId().'">';
		$html[] = $htmlLi;
		//if($this->isCategoryActive($category)){
		$ids[] = $category->getId();
		//$this->_ids = implode(",", $ids);
		//}
		
		$html[] = '<a id="node'.$category->getId().'">';

		if($category->getId() != $rootCategoryId){
			$html[] = '<input lang="'.$category->getId().'" type="checkbox" id="radio'.$category->getId().'" name="setting[category_id][]" value="'.$category->getId().'" class="checkbox'.$parent.'"';
			if(in_array($category->getId(), $checkedCat)){
				$html[] = ' checked="checked"';
			}
			$html[] = '/>';
		}
		

		$html[] = '<label for="radio'.$category->getId().'">' . $category->getName() . '</label>';

		$html[] = '</a>';
		
		$htmlChildren = '';
		if($childrenCount>0){
			foreach ($children as $child) {
				$_child = $this->getModel('Magento\Catalog\Model\Category')->load($child->getId());
				$htmlChildren .= $this->getTreeCategory($_child, $category->getId(), $ids, $checkedCat);
			}
		}
		if (!empty($htmlChildren)) {
            $html[] = '<ul id="container'.$category->getId().'">';
            $html[] = $htmlChildren;
            $html[] = '</ul>';
        }

        $html[] = '</li>';
        $html = implode("\n", $html);
        return $html;
	}
	
	public function truncate($content, $length){
		return $this->filterManager->truncate($content, ['length' => $length, 'etc' => '']);
	}
	
	public function convertToLayoutUpdateXml($child){
		$settings = json_decode($child->getSetting(), true);
		$content = $child->getBlockContent();
		$content = preg_replace('/(mgs_panel_title="")/i', '', $content);
		$content = preg_replace('/(mgs_panel_title=".+?)+(")/i', '', $content);
		$content = preg_replace('/(mgs_panel_note="")/i', '', $content);
		$content = preg_replace('/(mgs_panel_note=".+?)+(")/i', '', $content);
		$content = preg_replace('/(labels=".+?)+(")/i', '', $content);
		$arrContent = explode(' ',$content);
		$arrContent = array_filter($arrContent);
		$class = $arrContent[1];
		$class = str_replace('type=','class=',$class);
		unset($arrContent[0], $arrContent[1]);
		
		$lastData = end($arrContent);
		//print_r($arrContent); die();
		array_pop($arrContent);
		
		$arrContent = array_values($arrContent);

		$argumentString = '&nbsp;&nbsp;&nbsp;&nbsp;&lt;arguments&gt;<br/>';
		
		if(isset($settings['title']) && ($settings['title']!='')){
			$argumentString .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;argument name="mgs_panel_title" xsi:type="string"&gt;'.htmlspecialchars($this->encodeHtml($settings['title'])).'&lt;/argument&gt;<br/>';
		}
		if(isset($settings['additional_content']) && ($settings['additional_content']!='')){
			$argumentString .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;argument name="mgs_panel_note" xsi:type="string"&gt;'.htmlspecialchars($this->encodeHtml($settings['additional_content'])).'&lt;/argument&gt;<br/>';
		}
		if(isset($settings['tabs']) && ($settings['tabs']!='')){
			usort($settings['tabs'], function ($item1, $item2) {
				if ($item1['position'] == $item2['position']) return 0;
				return $item1['position'] < $item2['position'] ? -1 : 1;
			});
			$tabType = $tabLabel = [];
			foreach($settings['tabs'] as $tab){
				$tabLabel[] = $tab['label'];
			}
			$labels = implode(',',$tabLabel);
			$argumentString .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;argument name="labels" xsi:type="string"&gt;'.$labels.'&lt;/argument&gt;<br/>';
		}
		$template = '';

		foreach($arrContent as $argument){
			$argumentData = explode('=',$argument);
			if($argumentData[0]!='template' && isset($argumentData[0]) && isset($argumentData[1])){
				$argumentString .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;argument name="'.$argumentData[0].'" xsi:type="string"&gt;'.str_replace('"','',$argumentData[1]).'&lt;/argument&gt;<br/>';
			}else{
				$template = $argumentData[1];
			}
			
		}
		
		
		$html = '&lt;block '.$class;
		
		$lastDataArr = explode('=',$lastData);
		if(isset($lastDataArr[0]) && isset($lastDataArr[1])){
			if($lastDataArr[0]=='template'){
				$template = str_replace('}}','',$lastDataArr[1]);
			}else{
				$argumentString .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;argument name="'.$lastDataArr[0].'" xsi:type="string"&gt;'.str_replace('"','',str_replace('}}','',$lastDataArr[1])).'&lt;/argument&gt;<br/>';
			}
		}
		
		
		$html .= ' template='.$template;
		
		$argumentString .= '&nbsp;&nbsp;&nbsp;&nbsp;&lt;/arguments&gt;';
		
		$html .= '&gt;<br/>';
		$html .= $argumentString;
		$html .= '<br/>&lt;/block&gt;';
		
		return $html;
	}
	
	/* Get all images from pub/media/wysiwyg/$type folder */
	public function getPanelUploadImages($type){
		$path = 'wysiwyg/'.$type.'/';
		$dir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath($path);
		$result = [];
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while ($files[] = readdir($dh));
                sort($files);
                foreach ($files as $file) {
                    $file_parts = pathinfo($dir . $file);
                    if (isset($file_parts['extension']) && in_array(strtolower($file_parts['extension']), ['jpg', 'jpeg', 'png', 'gif'])) {
                        $result[] = $file;
                    }
                }
            }
        }
        return $result;
	}
	
	/* Convert short code to insert image */
	public function convertImageWidgetCode($type, $image){
		return '&lt;img src="{{media url="wysiwyg/'.$type.'/'.$image.'"}}" alt=""/&gt;';
	}
	
	public function encodeHtml($html){
		$result = str_replace("<","&lt;",$html);
		$result = str_replace(">","&gt;",$result);
		$result = str_replace('"','&#34;',$result);
		$result = str_replace("'","&#39;",$result);
		return $result;
	}
	
	public function decodeHtmlTag($content){
		$result = str_replace("&lt;","<",$content);
		$result = str_replace("&gt;",">",$result);
		$result = str_replace('&#34;','"',$result);
		$result = str_replace("&#39;","'",$result);
		return $result;
	}
	
	public function getCmsBlockByIdentifier($identifier){
		$block = $this->_blockFactory->create();
		$block->setStoreId($this->getStore()->getId())->load($identifier);
		return $block;
	}
	
	public function getPageById($id){
		$page = $this->_pageFactory->create();
		$page->setStoreId($this->getStore()->getId())->load($id, 'identifier');
		return $page;
	}
	
	public function getHeaderClass(){
		$header = $this->getStoreConfig('mgstheme/general/header');
		$class = str_replace('.phtml', '', $header);
		$class = str_replace('_', '', $class);
		if($this->_acceptToUsePanel){
			$class .= ' builder-container header-builder';
		}
		return $class;
	}
	
	public function getFooterClass(){
		$footer = $this->getStoreConfig('mgstheme/general/footer');
		$class = str_replace('.phtml', '', $footer);
		$class = str_replace('_', '', $class);
		if($this->_acceptToUsePanel){
			$class .= ' builder-container footer-builder';
		}
		return $class;
	}
	
	public function getContentVersion($type, $themeId){
		$theme = $this->getModel('Magento\Theme\Model\Theme')->load($themeId);
		$themePath = $theme->getThemePath();
		$dir = $this->_filesystem->getDirectoryRead(DirectoryList::APP)->getAbsolutePath('design/frontend/'.$themePath.'/Magento_Theme/templates/html/'.$type);
		
		$result = [];
		$files = [];
		if(is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while ($files[] = readdir($dh));
				sort($files);
				foreach ($files as $file){
					$file_parts = pathinfo($dir . $file);
					if (isset($file_parts['extension']) && $file_parts['extension'] == 'phtml') {
                        $fileName = str_replace('.phtml', '', $file);
                        $result[] = array('value' => $fileName, 'label' => $this->convertFilename($fileName), 'path'=>$themePath);
                    }
				}
                closedir($dh);
            }
        }
		
		if(count($result)==0){
			$dir = $this->_filesystem->getDirectoryRead(DirectoryList::APP)->getAbsolutePath('design/frontend/Mgs/mgsblank/Magento_Theme/templates/html/'.$type);
			if(is_dir($dir)) {
				if ($dh = opendir($dir)) {
					while ($files[] = readdir($dh));
					sort($files);
					foreach ($files as $file){
						$file_parts = pathinfo($dir . $file);
						if (isset($file_parts['extension']) && $file_parts['extension'] == 'phtml') {
							$fileName = str_replace('.phtml', '', $file);
							$result[] = array('value' => $fileName, 'label' => $this->convertFilename($fileName), 'path'=>'mgsblank');
						}
					}
					closedir($dh);
				}
			}
		}
		return $result;
	}
	
	public function convertFilename($filename){
		$filename = str_replace('_',' ',$filename);
		$filename = ucfirst($filename);
		return $filename;
	}
	
	public function isFile($path, $type, $fileName){
		$path = str_replace('Mgs/','',$path);
		$filePath = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('mgs/'.$path.'/'.$type.'s/') . $fileName.'.png';
		if ($this->_file->isExists($filePath))  {
			return $this->_url->getBaseUrl(['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]).'mgs/'.$path.'/'.$type.'s/' . $fileName.'.png';
		}
		return false;
	}
	
	public function getCurrentCategory(){
		if($this->_currentCategory){
			return $this->_currentCategory;
		}else{
			$id = $this->_request->getParam('id');
			$this->_currentCategory = $this->getModel('Magento\Catalog\Model\Category')->load($id);
			return $this->_currentCategory;
		}
	}
	
	public function getCurrentProduct(){
		if($this->_currentProduct){
			return $this->_currentProduct;
		}else{
			$id = $this->_request->getParam('id');
			$this->_currentProduct = $this->getModel('Magento\Catalog\Model\Product')->load($id);
			return $this->_currentProduct;
		}
	}
	
	public function isCategoryPage(){
		if ($this->_fullActionName == 'catalog_category_view') {
			return true;
		}
		return false;
	}
	
	public function isSearchPage(){
		if ($this->_fullActionName == 'catalogsearch_result_index') {
			return true;
		}
		return false;
	}
	
	public function isProductPage(){
		if ($this->_fullActionName == 'catalog_product_view') {
			return true;
		}
		return false;
	}
	
	public function isPopup(){
		if (
			$this->_fullActionName == 'mgs_quickview_catalog_product_view' || 
			$this->_fullActionName == 'mpanel_edit_section' || 
			$this->_fullActionName == 'mpanel_create_block' || 
			$this->_fullActionName == 'mpanel_create_element' || 
			$this->_fullActionName == 'mpanel_edit_footer' || 
			$this->_fullActionName == 'mpanel_edit_header' || 
			$this->_fullActionName == 'mpanel_edit_staticblock'
		) {
			return true;
		}
		return false;
	}
	/* Search with categories */
	public function getCategories()
	{
		$rootCategoryId = $this->_storeManager->getStore()->getRootCategoryId();
		$categoriesArray = $this->_category
			->getCollection()
			->setStoreId($this->_storeManager->getStore()->getId())
			->addAttributeToSelect('*')
			->addAttributeToFilter('is_active', 1)
			->addAttributeToFilter('include_in_menu', 1)
			->addAttributeToFilter('path', array('like' => "1/{$rootCategoryId}/%"))
			->addAttributeToSort('path', 'asc')
			->load()
			->toArray();
		$categories = array();
		if(isset($categoriesArray['items'])){
			foreach ($categoriesArray['items'] as $categoryId => $category) {
				if (isset($category['name'])) {
					$categories[] = array(
						'label' => $category['name'],
						'level' => $category['level'],
						'value' => $category['entity_id']
					);
				}
			}
		}else {
			foreach ($categoriesArray as $categoryId => $category) {
				if (isset($category['name'])) {
					$categories[] = array(
						'label' => $category['name'],
						'level' => $category['level'],
						'value' => $category['entity_id']
					);
				}
			}
		}
		return $categories;
	}
	
	public function getCurrentlySelectedCategoryId()
	{
		$params = $this->getModel('Magento\Framework\App\Request\Http')->getParams();
		if (isset($params['cat'])) {
			return $params['cat'];
		}
		return '';
	}
}