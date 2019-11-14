<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryInStorePickupApi\Api\Data;

use Magento\InventoryInStorePickupApi\Api\Data\SearchRequest\FilterSetInterface;
use Magento\InventoryInStorePickupApi\Api\Data\SearchRequest\DistanceFilterInterface;

/**
 * Endpoint used to search Pickup Locations by different parameters:
 * - by attribute filters fields @see \Magento\InventoryInStorePickupApi\Api\Data\SearchRequest\FilterSetInterface
 * - by distance to the address @see \Magento\InventoryInStorePickupApi\Api\Data\SearchRequest\DistanceFilterInterface
 * Also, endpoint supports paging and sort orders.
 *
 * @api
 */
interface SearchRequestInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    /**
     * Get Filter by Distance Filter.
     *
     * @return \Magento\InventoryInStorePickupApi\Api\Data\SearchRequest\DistanceFilterInterface|null
     */
    public function getDistanceFilter(): ?DistanceFilterInterface;

    /**
     * Get set of filter.
     *
     * @return \Magento\InventoryInStorePickupApi\Api\Data\SearchRequest\FilterSetInterface|null
     */
    public function getFilterSet(): ?FilterSetInterface;

    /**
     * Get page size.
     *
     * @return int|null
     */
    public function getPageSize(): ?int;

    /**
     * Get current page.
     *
     * If not specified, 1 is returned by default.
     *
     * @return int
     */
    public function getCurrentPage(): int;

    /**
     * Get Sales Channel Type.
     *
     * @return string
     */
    public function getScopeType(): string;

    /**
     * Get Sales Channel code.
     *
     * @return string
     */
    public function getScopeCode(): string;

    /**
     * Get Sort Order.
     *
     * @return \Magento\Framework\Api\SortOrder[]|null
     */
    public function getSort(): ?array;

    /**
     * Set Extension Attributes for Search Request.
     *
     * @param \Magento\InventoryInStorePickupApi\Api\Data\SearchRequestExtensionInterface|null $extensionAttributes
     *
     * @return void
     */
    public function setExtensionAttributes(?SearchRequestExtensionInterface $extensionAttributes): void;

    /**
     * Get Extension Attributes of Search Request.
     *
     * @return \Magento\InventoryInStorePickupApi\Api\Data\SearchRequestExtensionInterface|null
     */
    public function getExtensionAttributes(): ?SearchRequestExtensionInterface;
}
