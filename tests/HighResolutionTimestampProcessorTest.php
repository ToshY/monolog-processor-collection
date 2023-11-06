<?php

/*
 * (c) Alexandre Daubois <alex.daubois@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MonologProcessorCollection\Tests;

use Monolog\Handler\TestHandler;
use Monolog\Level;
use MonologProcessorCollection\HighResolutionTimestampProcessor;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(HighResolutionTimestampProcessor::class)]
class HighResolutionTimestampProcessorTest extends AbstractProcessorTestCase
{
    public function testItWorks(): void
    {
        $processor = new HighResolutionTimestampProcessor();

        $handler = new TestHandler();
        $handler->pushProcessor($processor);
        $handler->handle($this->createRecord(Level::Notice));

        $this->assertTrue($handler->hasNoticeRecords());
        $record = $handler->getRecords()[0];

        $this->assertArrayHasKey('hrtime', $record->extra);
        $this->assertIsNotArray($record->extra['hrtime']);
    }
}
