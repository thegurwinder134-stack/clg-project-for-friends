<?php
require_once 'config/db.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

$id = $_GET['id'] ?? 0;
$product = getProductById($pdo, $id);

if (!$product) {
    header('Location: shop.php');
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<section class="section product-detail">
    <div class="product-detail-container">
        <div class="product-image-large">
            <img src="<?php echo e(getProductImageSrc($product['image'])); ?>" alt="<?php echo e($product['name']); ?>">
        </div>
        <div class="product-info-detail">
            <p class="section-eyebrow"><?php echo e(ucfirst($product['category'])); ?> / <?php echo e($product['brand_style']); ?></p>
            <h1><?php echo e($product['name']); ?></h1>
            <p class="price"><?php echo e(formatPrice($product['price'])); ?></p>
            <p class="description"><?php echo e($product['description']); ?></p>

            <div class="product-options">
                <div class="option">
                    <label>Size:</label>
                    <select id="size">
                        <?php
                        $sizes = explode(',', $product['size']);
                        foreach ($sizes as $size) {
                            echo '<option value="' . e(trim($size)) . '">' . e(trim($size)) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="option">
                    <label>Color:</label>
                    <select id="color">
                        <?php
                        $colors = explode(',', $product['color']);
                        foreach ($colors as $color) {
                            echo '<option value="' . e(trim($color)) . '">' . e(trim($color)) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="option">
                    <label>Quantity:</label>
                    <input type="number" id="quantity" value="1" min="1" max="<?php echo e($product['stock']); ?>">
                </div>
            </div>

            <button onclick="addToCart(<?php echo e($product['id']); ?>)" class="btn btn-primary add-to-cart">Add to Cart</button>
            <?php if (!empty($product['link'])): ?>
                <a href="<?php echo e($product['link']); ?>" target="_blank" rel="noopener noreferrer" class="btn secondary">View on Brand Site</a>
            <?php endif; ?>

            <div class="stock-status">
                <?php echo $product['stock'] > 0 ? e($product['stock'] . ' pieces in stock') : 'Out of Stock'; ?>
            </div>
        </div>
    </div>

    <div class="related-products">
        <div class="section-header">
            <div>
                <p class="section-eyebrow">Complete the look</p>
                <h2>Related Products</h2>
            </div>
        </div>
        <div class="product-grid">
            <?php
            $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ? AND id != ? ORDER BY CASE WHEN brand_style = ? THEN 0 ELSE 1 END, id DESC LIMIT 4");
            $stmt->execute([$product['category'], $product['id'], $product['brand_style']]);
            $related = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($related as $rel) {
                renderProductCard($rel);
            }
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
