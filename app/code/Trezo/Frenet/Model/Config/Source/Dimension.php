<?php
/**
 * Trezo Mundipagg Credit Card
 *
 * @author Bruno Roeder <bruno@trezo.com.br>
 *
 */
namespace Trezo\Frenet\Model\Config\Source;

class Dimension implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return [
            [
                'value' => 1,
                'label' => __('Centimeters')
            ],
            [
                'value' =>  0,
                'label' =>__('Millimeters')
            ]
        ];
    }
}
