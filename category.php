<?php
require_once 'config/db.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

$category = $_GET['cat'] ?? '';
$categoryTitle = ucfirst($category);
?>

<?php include 'includes/header.php'; ?>

<section class="section category">
    <div class="section-header">
        <div>
            <p class="section-eyebrow">Curated edit</p>
            <h2><?php echo e($categoryTitle); ?> Collection</h2>
        </div>
        <p class="section-lead">A focused selection from the full Fashion Hub catalog.</p>
    </div>

    <div class="product-grid">
        <?php
        if ($category) {
            $products = getProductsByCategory($pdo, $category);
            foreach ($products as $product) {
                renderProductCard($product);
            }
        } else {
            echo '<p>Category not found.</p>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
