<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryBundleIndexer\Indexer\SourceItem;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\MultiDimensionalIndexer\Alias;
use Magento\Framework\MultiDimensionalIndexer\IndexHandlerInterface;
use Magento\Framework\MultiDimensionalIndexer\IndexNameBuilder;
use Magento\InventoryIndexer\Indexer\InventoryIndexer;

/**
 * Bundle indexer by [bundle sku => [bundle children source item ids]]
 */
class ByBundleSkuAndChildrenSourceItemsIdsIndexer
{
    /**
     * @var GetSkuListInStock
     */
    private $getSkuListInStock;

    /**
     * @var IndexDataProvider
     */
    private $indexDataProvider;

    /**
     * @var IndexNameBuilder
     */
    private $indexNameBuilder;

    /**
     * @var IndexHandlerInterface
     */
    private $indexHandler;

    /**
     * @param GetSkuListInStock $getSkuListInStock
     * @param IndexDataProvider $indexDataProvider
     * @param IndexNameBuilder $indexNameBuilder
     * @param IndexHandlerInterface $indexHandler
     */
    public function __construct(
        GetSkuListInStock $getSkuListInStock,
        IndexDataProvider $indexDataProvider,
        IndexNameBuilder $indexNameBuilder,
        IndexHandlerInterface $indexHandler
    ) {
        $this->getSkuListInStock = $getSkuListInStock;
        $this->indexDataProvider = $indexDataProvider;
        $this->indexNameBuilder = $indexNameBuilder;
        $this->indexHandler = $indexHandler;
    }

    /**
     * @param array $bundleChildrenSourceItemsIdsWithSku
     *
     * @return void
     */
    public function execute(array $bundleChildrenSourceItemsIdsWithSku)
    {
        $skuListInStockList = $this->getSkuListInStock->execute($bundleChildrenSourceItemsIdsWithSku);
        foreach ($skuListInStockList as $skuListInStock) {
            $stockId = $skuListInStock->getStockId();
            $skuList = $skuListInStock->getSkuList();
            $bundleIndexData = $this->indexDataProvider->execute($skuList, $stockId);

            $mainIndexName = $this->indexNameBuilder
                ->setIndexId(InventoryIndexer::INDEXER_ID)
                ->addDimension('stock_', (string)$stockId)
                ->setAlias(Alias::ALIAS_MAIN)
                ->build();

            $this->indexHandler->cleanIndex(
                $mainIndexName,
                new \ArrayIterator(array_keys($skuList)),
                ResourceConnection::DEFAULT_CONNECTION
            );

            $this->indexHandler->saveIndex(
                $mainIndexName,
                $bundleIndexData,
                ResourceConnection::DEFAULT_CONNECTION
            );
        }
    }
}
