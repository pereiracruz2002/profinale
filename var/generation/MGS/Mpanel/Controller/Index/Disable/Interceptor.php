<?php
namespace MGS\Mpanel\Controller\Index\Disable;

/**
 * Interceptor class for @see \MGS\Mpanel\Controller\Index\Disable
 */
class Interceptor extends \MGS\Mpanel\Controller\Index\Disable implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Element\Context $urlContext, \Magento\Customer\Model\Session $customerSession)
    {
        $this->___init();
        parent::__construct($context, $urlContext, $customerSession);
    }

    /**
     * {@inheritdoc}
     */
    public function urlDecode($url)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'urlDecode');
        if (!$pluginInfo) {
            return parent::urlDecode($url);
        } else {
            return $this->___callPlugins('urlDecode', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        if (!$pluginInfo) {
            return parent::execute();
        } else {
            return $this->___callPlugins('execute', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getModel($model)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getModel');
        if (!$pluginInfo) {
            return parent::getModel($model);
        } else {
            return $this->___callPlugins('getModel', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getActionFlag()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getActionFlag');
        if (!$pluginInfo) {
            return parent::getActionFlag();
        } else {
            return $this->___callPlugins('getActionFlag', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRequest');
        if (!$pluginInfo) {
            return parent::getRequest();
        } else {
            return $this->___callPlugins('getRequest', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getResponse');
        if (!$pluginInfo) {
            return parent::getResponse();
        } else {
            return $this->___callPlugins('getResponse', func_get_args(), $pluginInfo);
        }
    }
}
