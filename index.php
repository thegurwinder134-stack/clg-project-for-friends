<?php
require_once 'config/db.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';
?>

<?php include 'includes/header.php'; ?>

<section class="hero">
    <div class="hero-shell">
        <div class="hero-content">
            <div class="liquid-panel hero-copy-panel">
                <p class="eyebrow">Fashion Hub / Campus Atelier 2026</p>
                <h1>Runway energy, made for college corridors.</h1>
                <p class="hero-copy">A sharp fashion storefront with curated drops, quick filtering, local product images, cart flow, and a polished visual story for presentation day.</p>
                <div class="hero-actions">
                    <a href="shop.php" class="btn btn-primary">Shop Collection</a>
                    <a href="category.php?cat=women" class="btn btn-secondary">Explore Women</a>
                </div>
            </div>
        </div>
        <div class="hero-editorial">
            <div class="hero-photo hero-photo-main">
                <img src="<?php echo e(getProductImageSrc('037-women-red-party-dress-dresses.webp')); ?>" alt="Women red party dress">
            </div>
            <div class="hero-photo hero-photo-small">
                <img src="<?php echo e(getProductImageSrc('056-men-green-bomber-jacket-jackets.webp')); ?>" alt="Men green bomber jacket">
            </div>
            <div class="hero-label">
                <span>60 products</span>
                <span>Men / Women</span>
                <span>Fast checkout</span>
            </div>
        </div>
    </div>
</section>

<section class="runway-strip" aria-label="Fashion Hub highlights">
    <span>New season edit</span>
    <span>Footwear</span>
    <span>Bags</span>
    <span>Jewellery</span>
    <span>Streetwear</span>
    <span>College-ready fits</span>
</section>

<section class="section featured-categories">
    <div class="section-header">
        <div>
            <p class="section-eyebrow">Curated edits</p>
            <h2>Shop by mood</h2>
        </div>
        <p class="section-lead">Clean category paths make the project easy to present and easy to use.</p>
    </div>
    <div class="category-grid">
        <div class="category-card category-men" data-code="M">
            <h3>Men</h3>
            <p>Sharp casuals, sneakers, jackets, wallets, and accessories.</p>
            <a href="category.php?cat=men" class="btn">Explore</a>
        </div>
        <div class="category-card category-women" data-code="W">
            <h3>Women</h3>
            <p>Party dresses, blazers, bags, jewellery, and daily essentials.</p>
            <a href="category.php?cat=women" class="btn">Explore</a>
        </div>
        <div class="category-card category-accessories" data-code="+">
            <h3>Accessories</h3>
            <p>Finishing pieces that make the storefront feel complete.</p>
            <a href="shop.php" class="btn">Explore</a>
        </div>
    </div>
</section>

<section class="section featured-products">
    <div class="section-header">
        <div>
            <p class="section-eyebrow">Featured collection</p>
            <h2>Editor picks</h2>
        </div>
        <a href="shop.php" class="btn">View All</a>
    </div>
    <div class="product-grid">
        <?php
        $products = $pdo->query("SELECT * FROM products WHERE id IN (31, 56, 36, 43, 49, 25, 55, 60) ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($products as $product) {
            renderProductCard($product, 'editor-card');
        }
        ?>
    </div>
</section>

<section class="section lookbook">
    <div class="lookbook-copy">
        <p class="section-eyebrow">Presentation moment</p>
        <h2>Not just products. A complete storefront story.</h2>
        <p>The homepage now feels like a small fashion campaign: departments, product cards, badges, stock, cart flow, and mobile responsiveness all connect into one clean project narrative.</p>
        <a href="shop.php?type=Shoes" class="btn btn-primary">Browse Footwear</a>
    </div>
    <div class="lookbook-board">
        <img src="<?php echo e(getProductImageSrc('036-women-luxury-tote-bag-bags.webp')); ?>" alt="Women luxury tote bag">
        <img src="<?php echo e(getProductImageSrc('043-men-grey-running-shoes-shoes.webp')); ?>" alt="Men grey running shoes">
        <img src="<?php echo e(getProductImageSrc('059-women-pearl-earrings-jewellery.webp')); ?>" alt="Women pearl earrings">
    </div>
</section>

<section class="section new-arrivals">
    <div class="section-header">
        <div>
            <p class="section-eyebrow">Fresh drop</p>
            <h2>Trending now</h2>
        </div>
        <p class="section-lead">Latest imported products from the JSON dataset.</p>
    </div>
    <div class="product-grid">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 4");
        $stmt->execute();
        $newProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($newProducts as $product) {
            renderProductCard($product);
        }
        ?>
    </div>
</section>

<section class="section newsletter">
    <div class="section-header">
        <div>
            <p class="section-eyebrow">Why Fashion Hub</p>
            <h2>Built for a clean demo</h2>
        </div>
    </div>
    <div class="feature-strip">
        <div class="feature-item">
            <strong>Dynamic catalog</strong>
            <p>Products load from SQLite seed data generated from JSON.</p>
        </div>
        <div class="feature-item">
            <strong>Real shopping flow</strong>
            <p>Login, cart quantity updates, checkout, and success screen.</p>
        </div>
        <div class="feature-item">
            <strong>Responsive UI</strong>
            <p>Designed to look sharp on projector, laptop, and phone.</p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
