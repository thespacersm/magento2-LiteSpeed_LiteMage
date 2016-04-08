<?php
/**
 * LiteMage2
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see https://opensource.org/licenses/GPL-3.0 .
 *
 * @package   LiteSpeed_LiteMage
 * @copyright  Copyright (c) 2016 LiteSpeed Technologies, Inc. (https://www.litespeedtech.com)
 * @license     https://opensource.org/licenses/GPL-3.0
 */
namespace Litespeed\Litemage\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class FlushAllCache
 */
class FlushAllCache implements ObserverInterface
{
    /**
     * @var \Magento\Framework\App\PageCache\Cache
     */

    /**
     * Application config object
     *
     * @var \Magento\PageCache\Model\Config
     */
    protected $litemageCache;

    protected $context;

    /**
     * @param \Magento\PageCache\Model\Config $config
     * @param \Magento\Framework\App\PageCache\Cache $cache
     */
    public function __construct(\Litespeed\Litemage\Model\CacheControl $litemageCache,
            \Magento\Framework\App\Action\Context $context)
    {
        $this->config = $config;
        $this->context = $context;
    }

    /**
     * Flash Built-In cache
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->litemageCache->moduleEnabled()) {
            $this->litemageCache->addPurgeTags('*');
            $this->messageManager = $this->context->getMessageManager();
            $this->messageManager->addSuccess('litemage purge all');
            $this->helper->debugLog('purge all invoked');
        }
    }
}
