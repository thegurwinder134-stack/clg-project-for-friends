<?php
require_once 'config/db.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';
?>

<?php include 'includes/header.php'; ?>

<section class="section shop">
    <div class="section-header">
        <div>
            <p class="section-eyebrow">Full catalog</p>
            <h2>Shop the collection</h2>
        </div>
        <p class="section-lead">Filter by gender, product type, price, or search the imported product list.</p>
    </div>

    <div class="filters">
        <form method="GET" class="filter-form">
            <select name="category">
                <option value="">All Categories</option>
                <option value="men" <?php echo (($_GET['category'] ?? '') === 'men') ? 'selected' : ''; ?>>Men</option>
                <option value="women" <?php echo (($_GET['category'] ?? '') === 'women') ? 'selected' : ''; ?>>Women</option>
            </select>
            <select name="type">
                <option value="">All Product Types</option>
                <?php
                $typeStmt = $pdo->query("SELECT DISTINCT brand_style FROM products WHERE brand_style IS NOT NULL AND brand_style != '' ORDER BY brand_style ASC");
                $types = $typeStmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($types as $type) {
                    $selected = (($_GET['type'] ?? '') === $type['brand_style']) ? 'selected' : '';
                    echo '<option value="' . e($type['brand_style']) . '" ' . $selected . '>' . e($type['brand_style']) . '</option>';
                }
                ?>
            </select>
            <select name="sort">
                <option value="name" <?php echo (($_GET['sort'] ?? '') === 'name') ? 'selected' : ''; ?>>Name</option>
                <option value="price_low" <?php echo (($_GET['sort'] ?? '') === 'price_low') ? 'selected' : ''; ?>>Price: Low to High</option>
                <option value="price_high" <?php echo (($_GET['sort'] ?? '') === 'price_high') ? 'selected' : ''; ?>>Price: High to Low</option>
            </select>
            <input type="text" name="search" value="<?php echo e($_GET['search'] ?? ''); ?>" placeholder="Search products...">
            <button type="submit" class="btn">Filter</button>
        </form>
    </div>

    <div class="product-grid">
        <?php
        $query = "SELECT * FROM products WHERE 1=1";
        $params = [];

        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $query .= " AND category = ?";
            $params[] = $_GET['category'];
        }

        if (isset($_GET['type']) && !empty($_GET['type'])) {
            $query .= " AND brand_style = ?";
            $params[] = $_GET['type'];
        }

        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $query .= " AND (name LIKE ? OR brand_style LIKE ?)";
            $params[] = '%' . $_GET['search'] . '%';
            $params[] = '%' . $_GET['search'] . '%';
        }

        if (isset($_GET['sort'])) {
            switch ($_GET['sort']) {
                case 'price_low':
                    $query .= " ORDER BY price ASC";
                    break;
                case 'price_high':
                    $query .= " ORDER BY price DESC";
                    break;
                default:
                    $query .= " ORDER BY name ASC";
            }
        } else {
            $query .= " ORDER BY created_at DESC";
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product) {
            renderProductCard($product);
        }

        if (empty($products)) {
            echo '<p>No products found. Try a different filter.</p>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
