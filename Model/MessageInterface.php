<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

/**
 * Interface for sms message.
 * @api
 * @since 100.0.2
 */
interface MessageInterface
{

    /**
     * Get phone number.
     * 
     * @return string
     */
    public function getPhoneNumber();

    /**
     * Set phone number.
     * 
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * Get content.
     * 
     * @return string
     */
    public function getContent();

    /**
     * Set content.
     * 
     * @param string $content
     * @return $this
     */
    public function setContent(string $content);

    /**
     * Get template.
     *
     * @return string
     */
    public function getTemplate();

    /**
     * Set template.
     * 
     * @param string $template
     * @return $this
     */
    public function setTemplate(string $template);

    /**
     * Get data.
     * 
     * @return array
     */
    public function getData();

    /**
     * Set data.
     * 
     * @param array $data
     * @return $this
     */
    public function setData(array $data);
}