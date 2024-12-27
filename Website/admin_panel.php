<?php
// admin_panel.php

session_start();
include('server/connection.php');

// Verificar si el usuario es administrador
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

// Procesar acciones del administrador
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add_product') {
        // Lógica para agregar un producto
        $name = $_POST['product_name'];
        $description = $_POST['product_description'];
        $price = $_POST['product_price'];
        $category = $_POST['product_category'];
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_category) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssis', $name, $description, $price, $category);
        $stmt->execute();
    } elseif ($action === 'delete_product') {
        // Lógica para eliminar un producto
        $product_id = $_POST['product_id'];
        $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
    } elseif ($action === 'update_order') {
        // Lógica para actualizar el estado del pedido
        $order_id = $_POST['order_id'];
        $status = $_POST['order_status'];
        $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        $stmt->bind_param('si', $status, $order_id);
        $stmt->execute();
    }
}

// Consultar productos
$stmt_products = $conn->prepare("SELECT * FROM products");
$stmt_products->execute();
$products = $stmt_products->get_result();

// Consultar pedidos
$stmt_orders = $conn->prepare("SELECT * FROM orders");
$stmt_orders->execute();
$orders = $stmt_orders->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>  
    <header class="bg-dark text-white p-3 mb-4">
        <div class="container">
            <h1 class="h3">Panel de Administración</h1>
            <nav>
                <a href="#inventory" class="btn btn-outline-light me-2">Gestión de Inventario</a>
                <a href="#orders" class="btn btn-outline-light">Gestión de Pedidos</a>
                <a href="admin_logout.php" class="btn btn-danger float-end">Cerrar Sesión</a>
            </nav>
        </div>
    </header>


    <main>
        <!-- Gestión de Inventario -->
        <section id="inventory" class="container mb-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2>Gestión de Inventario</h2>
                </div>
                <div class="card-body">
                <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = $products->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['product_id']) ?></td>
                            <td><?= htmlspecialchars($product['product_name']) ?></td>
                            <td><?= htmlspecialchars($product['product_description']) ?></td>
                            <td>$<?= htmlspecialchars($product['product_price']) ?></td>
                            <td><?= htmlspecialchars($product['product_category']) ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                    <input type="hidden" name="action" value="delete_product">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <h3>Añadir Producto</h3>
            <form method="POST" class="mb-4">
                <div class="mb-3">
                    <label for="product_name" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Nombre del Producto" required>
                </div>
                <div class="mb-3">
                    <label for="product_description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="product_description" name="product_description" placeholder="Descripción" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="product_price" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Precio" required>
                </div>
                <div class="mb-3">
                    <label for="product_category" class="form-label">Categoría</label>
                    <input type="text" class="form-control" id="product_category" name="product_category" placeholder="Categoría" required>
                </div>
                <button type="submit" class="btn btn-primary">Añadir Producto</button>
                </form>
                </div>
            </div>
</section>


        <!-- Gestión de Pedidos -->
        <section id="orders">
            <h2>Gestión de Pedidos</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $orders->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                            <td>$<?= htmlspecialchars($order['order_cost']) ?></td>
                            <td><?= htmlspecialchars($order['order_status']) ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                    <select name="order_status">
                                        <option value="Pendiente" <?= $order['order_status'] === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                        <option value="Enviado" <?= $order['order_status'] === 'Enviado' ? 'selected' : '' ?>>Enviado</option>
                                        <option value="Entregado" <?= $order['order_status'] === 'Entregado' ? 'selected' : '' ?>>Entregado</option>
                                    </select>
                                    <input type="hidden" name="action" value="update_order">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
