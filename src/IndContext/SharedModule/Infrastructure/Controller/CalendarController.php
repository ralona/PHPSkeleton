<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Infrastructure\Controller;

use App\IndContext\SharedModule\Application\Query\GetCalendarBlocksQuery;
use App\SharedContext\Infrastructure\Controller\BaseController;
use Carbon\CarbonImmutable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends BaseController
{
    #[Route("/calendar", methods: ["GET"])]
    public function getCalendarBlocks(): Response
    {
        $params = $this->request->params();

        $startDate = isset($params['startDate'])
            ? new CarbonImmutable($params['startDate'])
            : new CarbonImmutable('today');

        $query = new GetCalendarBlocksQuery(
            $startDate,
            isset($params['endDate']) ? new CarbonImmutable($params['endDate']) : $startDate->addMonth(),
        );

        $queryResponse = $this->queryBus->handle($query);

        return $this->responseFactory->fromQueryResponse($queryResponse);
    }
}
