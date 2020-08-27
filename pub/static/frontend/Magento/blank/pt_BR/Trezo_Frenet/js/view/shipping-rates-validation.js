/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*browser:true*/
/*global define*/
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/shipping-rates-validator',
        'Magento_Checkout/js/model/shipping-rates-validation-rules',
        'Trezo_Frenet/js/model/shipping-rates-validator',
        'Trezo_Frenet/js/model/shipping-rates-validation-rules'
    ],
    function (
        Component,
        defaultShippingRatesValidator,
        defaultShippingRatesValidationRules,
        frenetShippingRatesValidator,
        frenetShippingRatesValidationRules
    ) {
        'use strict';
        defaultShippingRatesValidator.registerValidator('trezo_frenet', frenetShippingRatesValidator);
        defaultShippingRatesValidationRules.registerRules('trezo_frenet', frenetShippingRatesValidationRules);
        return Component;
    }
);