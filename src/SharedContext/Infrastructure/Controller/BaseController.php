<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Controller;

use App\SharedContext\Domain\Validator\Validator;
use App\SharedContext\Infrastructure\Bus\CommandBus;
use App\SharedContext\Infrastructure\Bus\QueryBus;
use App\SharedContext\Infrastructure\Request\Request;
use App\SharedContext\Infrastructure\Response\ResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    public function __construct(
        protected QueryBus $queryBus,
        protected CommandBus $commandBus,
        protected Request $request,
        protected Validator $validator,
        protected ResponseFactory $responseFactory,
    ) {
    }
}
