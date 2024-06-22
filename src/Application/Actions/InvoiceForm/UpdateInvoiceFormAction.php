<?php
namespace Application\Actions\InvoiceForm;

use Infrastructure\Repositories\InvoiceFormRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateInvoiceFormAction {
    private $invoiceFormRepository;

    public function __construct(InvoiceFormRepository $invoiceFormRepository) {
        $this->invoiceFormRepository = $invoiceFormRepository;
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        $invoiceId = $args['id'];
        $data = $request->getParsedBody();
        $result = $this->invoiceFormRepository->update($invoiceId, $data);
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
