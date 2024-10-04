<?php
namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ServerDataService;
use Symfony\Contracts\Cache\CacheInterface;
use App\Entity\Server;

class ServerDataServiceTest extends TestCase
{
    public function testGetServerData()
    {
        /** 
         * @var CacheInterface|\PHPUnit\Framework\MockObject\MockObject $cacheMock 
         */

        $cacheMock = $this->createMock(CacheInterface::class);

        $cacheMock->expects($this->once())
            ->method('get')
            ->willReturn([
                (new Server())
                    ->setModel('Dell R210Intel Xeon X3440')
                    ->setRam('16GBDDR3')
                    ->setHdd('2x2TBSATA2')
                    ->setLocation('AmsterdamAMS-01')
                    ->setPrice(49.99),

                (new Server())
                    ->setModel('HP DL180G62x Intel Xeon E5620')
                    ->setRam('32GBDDR3')
                    ->setHdd('8x2TBSATA2')
                    ->setLocation('AmsterdamAMS-01')
                    ->setPrice(119.00),
            ]);

        $filePath = '/path/to/fake/file.xlsx';

        $service = new ServerDataService($filePath, $cacheMock);

        $servers = $service->getServerData();

        $this->assertIsArray($servers);
        $this->assertCount(2, $servers);

        $this->assertEquals('Dell R210Intel Xeon X3440', $servers[0]->getModel());
        $this->assertEquals('16GBDDR3', $servers[0]->getRam());
        $this->assertEquals(49.99, $servers[0]->getPrice());
    }
}
