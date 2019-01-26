<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 26/01/19
 * Time: 22:10
 */

namespace Tests\Framework\Twig;

use Framework\Twig\TimeExtension;
use PHPUnit\Framework\TestCase;

class TimeExtensionTest extends TestCase
{
    /**
     * @var TimeExtension
     */
    private $timeExtension;

    public function setUp()
    {
        $this->timeExtension = new TimeExtension();
    }

    public function testDateFormat()
    {
        $date   = new \DateTime();
        $format = 'd-m-Y H:i';
        $result = '<span class="timeago" datetime="' . $date->format(\DateTime::ISO8601) . '">' . $date->format($format) . '</span>';
        $this->assertEquals($result, $this->timeExtension->ago($date));
    }
}
