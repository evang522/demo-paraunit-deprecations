<?php

class DemonstrationTest extends \PHPUnit\Framework\TestCase
{
    public function testDemonstration(): void
    {
        @trigger_deprecation('my_package', '1.0.0', 'A simulated deprecation.');
        self::assertSame(1, 1);
    }
}