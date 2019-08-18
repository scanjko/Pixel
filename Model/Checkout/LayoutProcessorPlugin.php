<?php

namespace Pixel\ReorderBillingForm\Model\Checkout;

class LayoutProcessorPlugin
{

    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */

    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    )
    {
        // get billing address form at billing step
//        $billingAddressForm = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['afterMethods']['children']['billing-address-form'];
        $billingAddressForm = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['free-form'];

        /* Sort order */
        $billingAddressForm['children']['form-fields']['children']['firstname']['sortOrder']= 17;
        $billingAddressForm['children']['form-fields']['children']['lastname']['sortOrder']= 18;
        $billingAddressForm['children']['form-fields']['children']['telephone']['sortOrder']= 19;
        $billingAddressForm['children']['form-fields']['children']['country_id']['sortOrder']= 20;
        $billingAddressForm['children']['form-fields']['children']['postcode']['sortOrder']= 21;
        $billingAddressForm['children']['form-fields']['children']['region_id']['sortOrder']= 22;
        $billingAddressForm['children']['form-fields']['children']['city']['sortOrder']= 23;
        $billingAddressForm['children']['form-fields']['children']['street']['sortOrder']= 24;
        $billingAddressForm['sortOrder']=100;


        /* Set placeholder text */
        $billingAddressForm['children']['form-fields']['children']['firstname']['placeholder'] = __('Enter your name here');
        $billingAddressForm['children']['form-fields']['children']['lastname']['placeholder'] = __('Enter last name here');
        $billingAddressForm['children']['form-fields']['children']['telephone']['placeholder'] = __('Enter your phone here');
        $billingAddressForm['children']['form-fields']['children']['country_id']['placeholder'] = __('Select country');
        $billingAddressForm['children']['form-fields']['children']['postcode']['placeholder'] = __('Enter your postal code here');
        $billingAddressForm['children']['form-fields']['children']['region_id']['placeholder'] = __('Enter your region here');
        $billingAddressForm['children']['form-fields']['children']['city']['placeholder'] = __('Enter your city here');
        $billingAddressForm['children']['form-fields']['children']['street']['children'][0]['placeholder']=__('Enter your address here');

        $billingAddressForm['children']['form-fields']['children']['company']['visible'] = false;


        // Add Class to checkout field
        $billingAddressForm['children']['form-fields']['children']['city']['additionalClasses'] = 'city-checkout';

        $billingAddressForm['children']['form-fields']['children']['street']['children'][0]['label']= __('Address Line 1');


        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['custom-field-group-delivery-info'] = $billingAddressForm;

        // remove form from billing step
        unset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['afterMethods']['children']['billing-address-form']);

        return $jsLayout;
    }
}