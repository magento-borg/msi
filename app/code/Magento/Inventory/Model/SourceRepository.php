<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Inventory\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Inventory\Model\Source\Command\GetInterface;
use Magento\Inventory\Model\Source\Command\GetBySourceIdInterface;
use Magento\Inventory\Model\Source\Command\GetListInterface;
use Magento\Inventory\Model\Source\Command\SaveInterface;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Magento\InventoryApi\Api\Data\SourceSearchResultsInterface;
use Magento\InventoryApi\Api\SourceRepositoryInterface;

/**
 * @inheritdoc
 */
class SourceRepository implements SourceRepositoryInterface
{
    /**
     * @var SaveInterface
     */
    private $commandSave;

    /**
     * @var GetInterface
     */
    private $commandGet;

    /**
     * @var GetBySourceIdInterface
     */
    private $commandGetBySourceId;

    /**
     * @var GetListInterface
     */
    private $commandGetList;

    /**
     * @param SaveInterface $commandSave
     * @param GetInterface $commandGet
     * @param GetBySourceIdInterface $commandGetBySourceId
     * @param GetListInterface $commandGetList
     */
    public function __construct(
        SaveInterface $commandSave,
        GetInterface $commandGet,
        GetBySourceIdInterface $commandGetBySourceId,
        GetListInterface $commandGetList
    ) {
        $this->commandSave = $commandSave;
        $this->commandGet = $commandGet;
        $this->commandGetBySourceId = $commandGetBySourceId;
        $this->commandGetList = $commandGetList;
    }

    /**
     * @inheritdoc
     */
    public function save(SourceInterface $source): int
    {
        return $this->commandSave->execute($source);
    }

    /**
     * @inheritdoc
     */
    public function get(string $code): SourceInterface
    {
        return $this->commandGet->execute($code);
    }

    /**
     * @inheritdoc
     */
    public function getBySourceId(int $sourceId): SourceInterface
    {
        return $this->commandGetBySourceId->execute($sourceId);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): SourceSearchResultsInterface
    {
        return $this->commandGetList->execute($searchCriteria);
    }
}
