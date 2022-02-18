<?php

declare(strict_types=1);

namespace App\FinizensContext\Infrastructure\Controller\Portfolio;

use App\FinizensContext\Application\Command\Portfolio\CreatePortfolio;
use App\FinizensContext\Domain\Exception\Portfolio\InvalidPortfolioIdException;
use App\FinizensContext\Domain\Repository\Portfolio\PortfolioRepository;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;
use App\FinizensContext\Domain\View\Portfolio\PortfolioViewFactory;
use App\FinizensContext\Infrastructure\Validator\Portfolio\CreatePortfolioConstraints;
use App\SharedContext\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends BaseController
{
    #[Route("/portfolio", methods: ['GET'])]
    public function getAllPortfolios(PortfolioRepository $portfolioRepository): Response
    {
        $portfolios = $portfolioRepository->all();

        $portfolioViews = PortfolioViewFactory::makeCollection($portfolios);

        return $this->responseFactory->fromRawData($portfolioViews);
    }

    #[Route("/portfolio/{id}", methods: ['GET'])]
    public function getPortfolio(int $id, PortfolioRepository $portfolioRepository): Response
    {
        try {
            $portfolioId = new PortfolioId($id);
        } catch (InvalidPortfolioIdException) {
            return $this->responseFactory->notFoundResponse();
        }

        $portfolio = $portfolioRepository->byId($portfolioId);
        if (null === $portfolio) {
            return $this->responseFactory->notFoundResponse();
        }

        $portfolioView = PortfolioViewFactory::create($portfolio);

        return $this->responseFactory->fromRawData($portfolioView);
    }

    #[Route("/portfolio", methods: ['PUT'])]
    public function createPortfolio(): Response
    {
        $content = $this->request->content();

        $this->validator->validate($content, CreatePortfolioConstraints::get());

        $command = CreatePortfolio::fromArray($content);

        $this->commandBus->handle($command);

        return $this->responseFactory->emptyResponse();
    }
}