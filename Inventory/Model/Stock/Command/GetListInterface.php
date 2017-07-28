<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Inventory\Model\Stock\Command;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\InventoryApi\Api\Data\StockSearchResultsInterface;

/**
 * Find Stocks by SearchCriteria command (Service Provider Interface - SPI)
 *
 * Separate command interface to which Repository proxies initial GetList call, could be considered as SPI - Interfaces
 * that you should extend and implement to customize current behaviour, but NOT expected to be used (called) in the code
 * of business logic directly
 *
 * @see \Magento\InventoryApi\Api\StockRepositoryInterface
 * @api
 */
interface GetListInterface
{
    /**
     * Find Stocks by given SearchCriteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return StockSearchResultsInterface
     */
    public function execute(SearchCriteriaInterface $searchCriteria);
}
