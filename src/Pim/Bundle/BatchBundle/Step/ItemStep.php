<?php

namespace Pim\Bundle\BatchBundle\Step;

use Pim\Bundle\BatchBundle\Item\ItemReaderInterface;
use Pim\Bundle\BatchBundle\Item\ItemProcessorInterface;
use Pim\Bundle\BatchBundle\Item\ItemWriterInterface;

/**
 * Basic step implementation that read items, process them and write them
 *
 * @author    Benoit Jacquemont <benoit@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 */
class ItemStep extends AbstractStep
{
    /* @var ItemReaderInterface $reader */
    private $reader = null;

    /* @var ItemWriterInterfacce $writer */
    private $writer = null;

    /* @var ItemProcessorInterface $processor */
    private $processor = null;

    public function setReader(ItemReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    public function setWriter(ItemWriterInterface $writer)
    {
        $this->writer = $writer;
    }

    public function setProcessor(ItemProcessorInterface $processor)
    {
        $this->processor = $processor;
    }

    /**
     * {@inheritdoc}
     */
    public function doExecute(StepExecution $execution)
    {
        $readCounter = 0;
        $writeCounter = 0;

        while ( ($item = $this->reader->read()) != null) {
            $readCounter ++;
            $processedItem = $this->processor->process($item);
            if ($processedItem != null) {
                $writeCounter ++;
                $this->writer->write(array($processedItem));
            }
        }
    }
}
