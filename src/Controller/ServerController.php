<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ServerDataService;
use Symfony\Component\HttpFoundation\Request;

class ServerController extends AbstractController
{
    private $serverDataService;

    public function __construct(ServerDataService $serverDataService)
    {
        $this->serverDataService = $serverDataService;
    }

    /**
     * @Route("/servers", name="servers", methods={"GET"})
     */
    public function viewServers(): Response
    {
        $servers = $this->serverDataService->getServerData();

        $html = '<html><head><title>Server List</title>';

        $html .= '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">';

        $html .= '<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>';
        $html .= '<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>';

        $html .= '<script>
                    $(document).ready(function() {
                        $("#serverTable").DataTable();
                    });
                </script>';
        
        $html .= '</head><body>';
        $html .= '<h1>Available Servers</h1>';
        $html .= '<table id="serverTable" class="display" border="1">
                    <thead>
                        <tr>
                            <th>Model</th>
                            <th>RAM</th>
                            <th>HDD</th>
                            <th>Location</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($servers as $server) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($server->getModel()) . '</td>
                        <td>' . htmlspecialchars($server->getRam()) . '</td>
                        <td>' . htmlspecialchars($server->getHdd()) . '</td>
                        <td>' . htmlspecialchars($server->getLocation()) . '</td>
                        <td>' . htmlspecialchars($server->getPrice()) . '</td>
                    </tr>';
        }

        $html .= '</tbody></table>';
        $html .= '</body></html>';

        return new Response($html);
    }

}
