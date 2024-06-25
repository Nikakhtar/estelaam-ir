
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
    $app->post('/customer-quotation-forms', function (Request $request, Response $response, array $args): Response {

    $data = json_decode($request->getBody()->getContents(), true);
    error_log(print_r($data));
    $pdo = DatabaseConnection::getPDO();

    // Insert the main form
    $stmt = $pdo->prepare("INSERT INTO customer_quotation_form (application, by_person, submit_date, expire_date, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['application'],
        $data['by_person'],
        $data['submit_date'],
        $data['expire_date'],
        $data['description']
    ]);
    $formId = $pdo->lastInsertId();

    // Insert items related to the form
    foreach ($data['items'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO customer_quotation_form_item (customer_quotation_form, article, quantity, unit, article_name_place, description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $formId,
            $item['article'],
            $item['quantity'],
            $item['unit'],
            $item['article_name_place'],
            $item['description']
        ]);
    }

    $response->getBody()->write(json_encode(['message' => 'Customer quotation form created successfully', 'id' => $formId]));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

    /////////////////////
    $app->get('/customer-quotation-forms/{id}', function (Request $request, Response $response, array $args): Response {
    $id = $args['id'];
    $pdo = DatabaseConnection::getPDO();

    // Retrieve the main form
    $stmt = $pdo->prepare("SELECT * FROM customer_quotation_form WHERE id = ?");
    $stmt->execute([$id]);
    $formData = $stmt->fetch();

    // Retrieve items related to the form
    $stmt = $pdo->prepare("SELECT * FROM customer_quotation_form_item WHERE customer_quotation_form = ?");
    $stmt->execute([$id]);
    $items = $stmt->fetchAll();

    if ($formData) {
        $result = ['formData' => $formData, 'items' => $items];
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    } else {
        $response->getBody()->write(json_encode(['message' => 'Quotation form not found']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    }
});

    /////////////////////
    $app->post('/vendor-announcement-forms', function (Request $request, Response $response): Response {
    $data = json_decode($request->getBody()->getContents(), true);
    $pdo = DatabaseConnection::getPDO();

    // Insert the main announcement form
    $stmt = $pdo->prepare("INSERT INTO vendor_announcement_form (application, customer_quotation_form, by_person, submit_date, expire_date, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['application'],
        $data['customer_quotation_form'],
        $data['by_person'],
        $data['submit_date'],
        $data['expire_date'],
        $data['description']
    ]);
    $formId = $pdo->lastInsertId();

    // Insert items related to the form
    foreach ($data['items'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO vendor_announcement_form_item (vendor_announcement_form, article, unit_price, available_quantity, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $formId,
            $item['article'],
            $item['unit_price'],
            $item['available_quantity'],
            $item['description']
        ]);
    }

    $response->getBody()->write(json_encode(['message' => 'Vendor announcement form submitted successfully', 'id' => $formId]));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

    /////////////////////
    $app->get('/vendor-announcement-forms/{id}', function (Request $request, Response $response, array $args): Response {
    $id = $args['id'];
    $pdo = DatabaseConnection::getPDO();

    // Retrieve the main announcement form
    $stmt = $pdo->prepare("SELECT * FROM vendor_announcement_form WHERE id = ?");
    $stmt->execute([$id]);
    $formData = $stmt->fetch();

    // Retrieve items related to the form
    $stmt = $pdo->prepare("SELECT * FROM vendor_announcement_form_item WHERE vendor_announcement_form = ?");
    $stmt->execute([$id]);
    $items = $stmt->fetchAll();

    if ($formData) {
        $result = ['formData' => $formData, 'items' => $items];
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    } else {
        $response->getBody()->write(json_encode(['message' => 'Announcement form not found']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    }
});

    /////////////////////
    $app->post('/bills', function (Request $request, Response $response): Response {
    $data = json_decode($request->getBody()->getContents(), true);
    $pdo = DatabaseConnection::getPDO();

    // Insert the main bill
    $stmt = $pdo->prepare("INSERT INTO bill_form (application, vendor_announcement_form, by_person, type, submit_date, expire_date, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['application'],
        $data['vendor_announcement_form'],
        $data['by_person'],
        $data['type'],
        $data['submit_date'],
        $data['expire_date'],
        $data['description']
    ]);
    $billId = $pdo->lastInsertId();

    // Insert items related to the bill
    foreach ($data['items'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO bill_form_item (bill_form, article, quantity, unit_price, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $billId,
            $item['article'], // mock article with id 1
            $item['quantity'],
            $item['unit_price'],
            $item['description']
        ]);
    }

    $response->getBody()->write(json_encode(['message' => 'Bill created successfully', 'id' => $billId]));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
});

    /////////////////////
    $app->get('/bills/{id}', function (Request $request, Response $response, array $args): Response {
    $id = $args['id'];
    $pdo = DatabaseConnection::getPDO();

    // Retrieve the main bill
    $stmt = $pdo->prepare("SELECT * FROM bill_form WHERE id = ?");
    $stmt->execute([$id]);
    $formData = $stmt->fetch();

    // Retrieve items related to the bill
    $stmt = $pdo->prepare("SELECT * FROM bill_form_item WHERE bill_form = ?");
    $stmt->execute([$id]);
    $items = $stmt->fetchAll();

    if ($formData) {
        $result = ['formData' => $formData, 'items' => $items];
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    } else {
        $response->getBody()->write(json_encode(['message' => 'Bill not found']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    }
});

    /////////////////////
    $app->post('/invoices', function (Request $request, Response $response): Response {
    $data = json_decode($request->getBody()->getContents(), true);
    $pdo = DatabaseConnection::getPDO();

    // Insert the main invoice
    $stmt = $pdo->prepare("INSERT INTO invoice_form (application, bill_form, by_person, type, submit_date, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['application'],
        $data['bill_form'],
        $data['by_person'],
        $data['type'],
        $data['submit_date'],
        $data['description']
    ]);
    $invoiceId = $pdo->lastInsertId();

    // Insert items related to the invoice
    foreach ($data['items'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO invoice_form_item (invoice_form, article, quantity, unit_price, description, delivery_state, delivery_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $invoiceId,
            $item['article'],  // mock article with id 1
            $item['quantity'],
            $item['unit_price'],
            $item['description'],
            $item['delivery_state'],
            $item['delivery_time']
        ]);
    }

    $response->getBody()->write(json_encode(['message' => 'Invoice created successfully', 'id' => $invoiceId]));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
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
      $items = $stmt->fetchAll();

      if ($formData) {
        $result = ['formData' => $formData, 'items' => $items];
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    } else {
        $response->getBody()->write(json_encode(['message' => 'Invoice not found']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
    }
    });
    ///////////////////
    $app->put('/invoices/{id}/update-full', function (Request $request, Response $response, array $args): Response {
    $id = $args['id'];
    $data = json_decode($request->getBody()->getContents(), true);
    $pdo = DatabaseConnection::getPDO();

    // Update the main invoice
    $stmt = $pdo->prepare("UPDATE invoice_form SET application = ?, bill_form = ?, by_person = ?, type = ?, submit_date = ?, description = ? WHERE id = ?");
    $stmt->execute([
        $data['invoice']['application'],
        $data['invoice']['bill_form'],
        $data['invoice']['by_person'],
        $data['invoice']['type'],
        $data['invoice']['submit_date'],
        $data['invoice']['description'],
        $id
    ]);

    // Update items related to the invoice
    foreach ($data['items'] as $item) {
        $stmt = $pdo->prepare("UPDATE invoice_form_item SET article = ?, quantity = ?, unit_price = ?, description = ?, delivery_state = ?, delivery_time = ? WHERE id = ? AND invoice_form = ?");
        $stmt->execute([
            $item['article'],  // mock article with id 1
            $item['quantity'],
            $item['unit_price'],
            $item['description'],
            $item['delivery_state'],
            $item['delivery_time'],
            $item['id'],
            $id
        ]);
    }

    $response->getBody()->write(json_encode(['message' => 'Invoice and items updated successfully']));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

    ///////////////////
    $app->post('/send-sms', function (Request $request, Response $response): Response {
    $data = json_decode($request->getBody()->getContents(), true);
    $pdo = DatabaseConnection::getPDO();

    // Here you'd integrate with an actual SMS API
    // Log the SMS request for simulation
    error_log("Sending SMS to person_id: " . $data['person_id'] . " with template: " . $data['template_sms_id'] . " and parameters: " . implode(", ", $data['content_parameters']));

    $response->getBody()->write(json_encode(['message' => 'SMS sent successfully']));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(202);
});

};
