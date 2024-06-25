
<?php


use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
/////////////
use Infrastructure\Database\DatabaseConnection;
/////////////

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    /////////////////////
    $app->get('/invoices/{id}', function (Request $request, Response $response, array $args): Response {
      $id = $args['id'];

      $pdo = DatabaseConnection::getPDO();

      $stmt = $pdo->prepare("SELECT * FROM invoice_form WHERE id = :id");
      $stmt->execute(['id' => $id]);
      $formData = $stmt->fetch();

      $stmt = $pdo->prepare("SELECT * FROM invoice_form_item WHERE invoice_form = :id");
      $stmt->execute(['id' => $id]);
      $itemData = $stmt->fetch();

      $result = array('formData' => $formData, 'itemData' => $itemData);

      $response->getBody()->write(json_encode($result ?: []));
      return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });
    $app->put('/invoices/{id}/update-full', UpdateInvoiceFormAction::class);
};
