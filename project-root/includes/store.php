<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

const ROLE_LABELS = [
    0 => 'کاربر',
    1 => 'مدیر',
    2 => 'فروشنده',
];

const ORDER_STATUS_LABELS = [
    0 => 'ثبت شده',
    1 => 'در حال پردازش',
    2 => 'تکمیل شده',
];

function fetchProducts(?string $category = null, bool $onlyActive = true): array
{
    $conn = db();

    if ($category !== null && $onlyActive) {
        $stmt = $conn->prepare('SELECT * FROM products WHERE status > 0 AND category = ? ORDER BY id DESC');
        $stmt->bind_param('s', $category);
    } elseif ($category !== null) {
        $stmt = $conn->prepare('SELECT * FROM products WHERE category = ? ORDER BY id DESC');
        $stmt->bind_param('s', $category);
    } elseif ($onlyActive) {
        $stmt = $conn->prepare('SELECT * FROM products WHERE status > 0 ORDER BY id DESC');
    } else {
        $stmt = $conn->prepare('SELECT * FROM products ORDER BY id DESC');
    }

    $stmt->execute();
    $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $products;
}

function fetchFlaggedProducts(string $flag): array
{
    if (!in_array($flag, ['hot', 'new'], true)) {
        return [];
    }

    $query = "SELECT * FROM products WHERE status > 0 AND {$flag} = 1 ORDER BY id DESC";
    $result = db()->query($query);

    return $result->fetch_all(MYSQLI_ASSOC);
}

function fetchProductById(int $productId): ?array
{
    $stmt = db()->prepare('SELECT * FROM products WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $product ?: null;
}

function fetchProductsByIds(array $productIds): array
{
    $productIds = array_values(array_filter(array_map('intval', $productIds), static fn ($id) => $id > 0));
    if ($productIds === []) {
        return [];
    }

    $placeholders = implode(',', array_fill(0, count($productIds), '?'));
    $types = str_repeat('i', count($productIds));
    $stmt = db()->prepare("SELECT * FROM products WHERE id IN ({$placeholders})");
    $stmt->bind_param($types, ...$productIds);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    $mapped = [];
    foreach ($rows as $row) {
        $mapped[(int) $row['id']] = $row;
    }

    $ordered = [];
    foreach ($productIds as $productId) {
        if (isset($mapped[$productId])) {
            $ordered[] = $mapped[$productId];
        }
    }

    return $ordered;
}

function fetchUsersExcept(int $userId): array
{
    $stmt = db()->prepare('SELECT user_id, r_name, u_name, email, role FROM users WHERE user_id != ? ORDER BY user_id DESC');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $users;
}

function fetchUserById(int $userId): ?array
{
    $stmt = db()->prepare('SELECT user_id, r_name, u_name, email, pass, role FROM users WHERE user_id = ? LIMIT 1');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $user ?: null;
}

function productImagePath(string $imageName): string
{
    if (str_contains($imageName, '.')) {
        return '../assets/images/products/' . $imageName;
    }

    return '../assets/images/products/' . $imageName . '.jpg';
}

function fetchOrdersForAdmin(): array
{
    $query = 'SELECT orders.id, orders.status, users.r_name, products.name AS product_name
        FROM orders
        INNER JOIN users ON users.user_id = orders.user_id
        INNER JOIN products ON products.id = orders.product_id
        ORDER BY orders.id DESC
        LIMIT 8';

    $result = db()->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getDashboardStats(): array
{
    $conn = db();

    $ordersCount = (int) $conn->query('SELECT COUNT(*) AS aggregate FROM orders')->fetch_assoc()['aggregate'];
    $usersCount = (int) $conn->query('SELECT COUNT(*) AS aggregate FROM users')->fetch_assoc()['aggregate'];
    $lowStockCount = (int) $conn->query('SELECT COUNT(*) AS aggregate FROM products WHERE stock BETWEEN 1 AND 5')->fetch_assoc()['aggregate'];
    $totalRevenue = (int) $conn->query('SELECT COALESCE(SUM(products.price), 0) AS aggregate FROM orders INNER JOIN products ON products.id = orders.product_id')->fetch_assoc()['aggregate'];

    return [
        'orders' => $ordersCount,
        'revenue' => $totalRevenue,
        'users' => $usersCount,
        'low_stock' => $lowStockCount,
    ];
}

function cartSummary(): array
{
    $items = fetchProductsByIds(getCart());
    $total = 0;

    foreach ($items as $item) {
        $total += (int) $item['price'];
    }

    return [
        'items' => $items,
        'total' => $total,
    ];
}
