<?php

declare(strict_types=1);

namespace App\FinizensContext\Infrastructure\Controller\Order;

use App\FinizensContext\Application\Command\Order\CompleteOrder;
use App\FinizensContext\Application\Command\Order\CreateOrder;
use App\FinizensContext\Domain\Exception\Order\InvalidOrderIdException;
use App\FinizensContext\Domain\Model\Order\Order;
use App\FinizensContext\Domain\Model\Portfolio\Allocation;
use App\FinizensContext\Domain\Model\Portfolio\Portfolio;
use App\FinizensContext\Domain\Repository\Order\OrderRepository;
use App\FinizensContext\Domain\ValueObject\Order\OrderId;
use App\FinizensContext\Domain\ValueObject\Order\OrderType;
use App\FinizensContext\Domain\View\Order\OrderViewFactory;
use App\FinizensContext\Infrastructure\Validator\Order\CompleteOrderConstraints;
use App\FinizensContext\Infrastructure\Validator\Order\CreateOrderConstraints;
use App\SharedContext\Infrastructure\Controller\BaseController;
use App\SharedContext\Infrastructure\Validator\Constraints\EntityExist;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends BaseController
{
    #[Route("/order", methods: ['GET'])]
    public function getAllOrders(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->all();

        $orderViews = OrderViewFactory::makeCollection($orders);

        return $this->responseFactory->fromRawData($orderViews);
    }

    #[Route("/order/{id}", methods: ['GET'])]
    public function getOrder(int $id, OrderRepository $orderRepository): Response
    {
        try {
            $orderId = new OrderId($id);
        } catch (InvalidOrderIdException) {
            return $this->responseFactory->notFoundResponse();
        }

        $order = $orderRepository->byId($orderId);
        if (null === $order) {
            return $this->responseFactory->notFoundResponse();
        }

        $orderView = OrderViewFactory::create($order);

        return $this->responseFactory->fromRawData($orderView);
    }

    #[Route("/buy", methods: ['POST'])]
    public function buy(): Response
    {
        $content = $this->request->content();
        $content[CreateOrder::ORDER_TYPE] = OrderType::buy()->value();

        $this->validator->validate($content, CreateOrderConstraints::withCustomFieldConstraints([
            CreateOrder::PORTFOLIO_ID => [
                new EntityExist([
                    'entityClass' => Portfolio::class
                ])
            ]
        ]), 404);

        $this->validator->validate($content, CreateOrderConstraints::get());

        $command = CreateOrder::fromArray($content);

        $this->commandBus->handle($command);

        return $this->responseFactory->emptyResponse();
    }

    #[Route("/sell", methods: ['POST'])]
    public function sell(): Response
    {
        $content = $this->request->content();
        $content[CreateOrder::ORDER_TYPE] = OrderType::sell()->value();

        $this->validator->validate($content, CreateOrderConstraints::withCustomFieldConstraints([
            CreateOrder::PORTFOLIO_ID => [
                new EntityExist([
                    'entityClass' => Portfolio::class
                ])
            ]
        ]), 404);

        $this->validator->validate($content, CreateOrderConstraints::withCustomFieldConstraints([
            CreateOrder::ALLOCATION_ID => [
                new EntityExist([
                    'entityClass' => Allocation::class
                ])
            ]
        ]), 404);

        $this->validator->validate($content, CreateOrderConstraints::get());

        $command = CreateOrder::fromArray($content);

        $this->commandBus->handle($command);

        return $this->responseFactory->emptyResponse();
    }

    #[Route("/complete", methods: ['POST'])]
    public function complete(): Response
    {
        $content = $this->request->content();

        $this->validator->validate($content, CompleteOrderConstraints::withCustomFieldConstraints([
            CompleteOrder::ORDER_ID => [
                new EntityExist([
                    'entityClass' => Order::class,
                    'message' => 'order_not_exist',
                ]),
            ]
        ]), 404);

        $this->validator->validate($content, CompleteOrderConstraints::get());

        $command = CompleteOrder::fromArray($content);

        $this->commandBus->handle($command);

        return $this->responseFactory->emptyResponse();
    }
}