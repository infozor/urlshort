<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\HttpFoundation\RedirectResponse;


class ApiRedirectController
{

	
	public function index($token, Connection $conn)
	{
		
		try
		{
			$sqlstr = "SELECT url
					FROM
					  phishing
					WHERE
					  token = '".$token."'
					LIMIT 1";
			$stmt = $conn->prepare($sqlstr);
			$stmt->execute();
			$record = $stmt->fetchAll();
			
			return new RedirectResponse($record[0]['url']);
		}
		catch (\Exception $e)
		{
			return new Response($e->getMessage());
		}
	}
}