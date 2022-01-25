<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Sender\Sales;

use Magento\Sales\Model\Order;
use Magento\Sales\Model\Order\Invoice;

/**
 * Sends order invoice email to the customer.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InvoiceSender extends Sender
{
    const XML_TEMPLATE_PATH = 'sales/xxxx';
    /**
     * Sends order invoice email to the customer.
     *
     * Email will be sent immediately in two cases:
     *
     * - if asynchronous email sending is disabled in global settings
     * - if $forceSyncMode parameter is set to TRUE
     *
     * Otherwise, email will be sent later during running of
     * corresponding cron job.
     *
     * @param Invoice $invoice
     * @param bool $forceSyncMode
     * @return bool
     * @throws \Exception
     */
    public function send(Invoice $invoice, $forceSyncMode = false)
    {
        $this->identityContainer->setStore($invoice->getStore());
        $invoice->setSendEmail($this->identityContainer->isEnabled());

        if (!$this->globalConfig->getValue('sales_email/general/async_sending') || $forceSyncMode) {
            $order = $invoice->getOrder();
            if ($this->checkIfPartialInvoice($order, $invoice)) {
                $order->setBaseSubtotal((float) $invoice->getBaseSubtotal());
                $order->setBaseTaxAmount((float) $invoice->getBaseTaxAmount());
                $order->setBaseShippingAmount((float) $invoice->getBaseShippingAmount());
            }

            // $transport = [
            //     'order' => $order,
            //     'order_id' => $order->getId(),
            //     'invoice' => $invoice,
            //     'invoice_id' => $invoice->getId(),
            //     'comment' => $invoice->getCustomerNoteNotify() ? $invoice->getCustomerNote() : '',
            //     'billing' => $order->getBillingAddress(),
            //     'payment_html' => $this->getPaymentHtml($order),
            //     'store' => $order->getStore(),
            //     'formattedShippingAddress' => $this->getFormattedShippingAddress($order),
            //     'formattedBillingAddress' => $this->getFormattedBillingAddress($order),
            //     'order_data' => [
            //         'customer_name' => $order->getCustomerName(),
            //         'is_not_virtual' => $order->getIsNotVirtual(),
            //         'email_customer_note' => $order->getEmailCustomerNote(),
            //         'frontend_status_label' => $order->getFrontendStatusLabel()
            //     ]
            // ];
            // $transportObject = new DataObject($transport);


            $this->templateContainer->setTemplateVars($transportObject->getData());
            $this->identityContainer->setTemplatePath(self::XML_TEMPLATE_PATH);

            if ($this->checkAndSend($order)) {
                $invoice->setEmailSent(true);
                $this->invoiceResource->saveAttribute($invoice, ['send_email', 'email_sent']);
                return true;
            }
        } else {
            $invoice->setEmailSent(null);
            $this->invoiceResource->saveAttribute($invoice, 'email_sent');
        }

        $this->invoiceResource->saveAttribute($invoice, 'send_email');

        return false;
    }

}
