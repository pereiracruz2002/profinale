<?php
namespace MGS\Mpanel\Block\Framework\Page;

/**
 * Interceptor class for @see \MGS\Mpanel\Block\Framework\Page
 */
class Interceptor extends \MGS\Mpanel\Block\Framework\Page implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\View\LayoutFactory $layoutFactory, \Magento\Framework\View\Layout\ReaderPool $layoutReaderPool, \Magento\Framework\Translate\InlineInterface $translateInline, \Magento\Framework\View\Layout\BuilderFactory $layoutBuilderFactory, \Magento\Framework\View\Layout\GeneratorPool $generatorPool, \Magento\Framework\View\Page\Config\RendererFactory $pageConfigRendererFactory, \Magento\Framework\View\Page\Layout\Reader $pageLayoutReader, $template, $isIsolated = false)
    {
        $this->___init();
        parent::__construct($context, $layoutFactory, $layoutReaderPool, $translateInline, $layoutBuilderFactory, $generatorPool, $pageConfigRendererFactory, $pageLayoutReader, $template, $isIsolated);
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreConfig($node)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getStoreConfig');
        if (!$pluginInfo) {
            return parent::getStoreConfig($node);
        } else {
            return $this->___callPlugins('getStoreConfig', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function initLayout()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'initLayout');
        if (!$pluginInfo) {
            return parent::initLayout();
        } else {
            return $this->___callPlugins('initLayout', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addDefaultHandle()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addDefaultHandle');
        if (!$pluginInfo) {
            return parent::addDefaultHandle();
        } else {
            return $this->___callPlugins('addDefaultHandle', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getConfig');
        if (!$pluginInfo) {
            return parent::getConfig();
        } else {
            return $this->___callPlugins('getConfig', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addPageLayoutHandles(array $parameters = array(), $defaultHandle = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addPageLayoutHandles');
        if (!$pluginInfo) {
            return parent::addPageLayoutHandles($parameters, $defaultHandle);
        } else {
            return $this->___callPlugins('addPageLayoutHandles', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getLayout()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLayout');
        if (!$pluginInfo) {
            return parent::getLayout();
        } else {
            return $this->___callPlugins('getLayout', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultLayoutHandle()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDefaultLayoutHandle');
        if (!$pluginInfo) {
            return parent::getDefaultLayoutHandle();
        } else {
            return $this->___callPlugins('getDefaultLayoutHandle', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addHandle($handleName)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addHandle');
        if (!$pluginInfo) {
            return parent::addHandle($handleName);
        } else {
            return $this->___callPlugins('addHandle', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addUpdate($update)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addUpdate');
        if (!$pluginInfo) {
            return parent::addUpdate($update);
        } else {
            return $this->___callPlugins('addUpdate', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderResult(\Magento\Framework\App\ResponseInterface $response)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'renderResult');
        if (!$pluginInfo) {
            return parent::renderResult($response);
        } else {
            return $this->___callPlugins('renderResult', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setHttpResponseCode($httpCode)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setHttpResponseCode');
        if (!$pluginInfo) {
            return parent::setHttpResponseCode($httpCode);
        } else {
            return $this->___callPlugins('setHttpResponseCode', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setHeader($name, $value, $replace = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setHeader');
        if (!$pluginInfo) {
            return parent::setHeader($name, $value, $replace);
        } else {
            return $this->___callPlugins('setHeader', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setStatusHeader($httpCode, $version = null, $phrase = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setStatusHeader');
        if (!$pluginInfo) {
            return parent::setStatusHeader($httpCode, $version, $phrase);
        } else {
            return $this->___callPlugins('setStatusHeader', func_get_args(), $pluginInfo);
        }
    }
}
