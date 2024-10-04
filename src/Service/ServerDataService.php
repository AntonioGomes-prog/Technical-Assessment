<?php
namespace App\Service;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use App\Entity\Server;

class ServerDataService
{
    private $filePath;
    private $cache;

    public function __construct(string $filePath, CacheInterface $cache)
    {
        $this->filePath = $filePath;
        $this->cache = $cache;
    }

    public function getServerData(): array
    {
        return $this->cache->get('servers_data', function (ItemInterface $item) {
            $item->expiresAfter(3600); 

            return $this->readExcelFile();
        });
    }

    private function readExcelFile(): array
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = [];

        foreach ($sheet->getRowIterator(2) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $server = new Server();
            foreach ($cellIterator as $cell) {
                $cellValue = $cell->getValue();

                switch ($cell->getColumn()) {
                    case 'A':
                        $server->setModel($cellValue);
                        break;
                    case 'B':
                        $server->setRam($cellValue);
                        break;
                    case 'C':
                        $server->setHdd($cellValue);
                        break;
                    case 'D':
                        $server->setLocation($cellValue);
                        break;
                    case 'E':
                        $server->setPrice((float) filter_var($cellValue, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
                        break;
                }
            }

            if ($server->getModel()) {
                $data[] = $server;
            }
        }

        return $data;
    }
}
