<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Driver\Connection;

class ApiShortController extends Controller
{
	public function index(Connection $conn)
	{
		try
		{
			$json = file_get_contents('php://input');
			
			$array = json_decode($json, true);
			
			
//			throw new \Exception('error empty array');
			
			if (is_array($array))
			{
				if (isset($array['url']))
				{
					$sqlstr = "SELECT token
					FROM
					  phishing
					WHERE
					  url = '" . $array['url'] . "'
					LIMIT 1";
					$stmt = $conn->prepare($sqlstr);
					$stmt->execute();
					$record = $stmt->fetchAll();
					
					if (count($record) == 1)
					{
						return $this->json([
								'finish' => 'success',
								'short' => $record[0]['token'] 
						]);
					}
				}
			}
			else
			{
				throw new \Exception('error empty array');
			}
		}
		catch ( \Exception $e )
		{
			return $this->json([
					'finish' => 'error',
					'short' => '',
					'error_message' => $e->getMessage()
			]);
		}
	}
}
