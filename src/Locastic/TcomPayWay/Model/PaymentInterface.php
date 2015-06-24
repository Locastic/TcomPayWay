<?php

namespace Locastic\TcomPayWay\Model;

/**
 * This model is used for preparing standard model of payment (athorize-form)
 *
 * Class Payment
 * @package Locastic\TcomPayWay\AuthorizeForm\Model
 */
interface PaymentInterface
{
    /**
     * @return string
     */
    public function getPgwSignature();
}
