<?php
$site_title = "Tennis World";
$products = [
    [
        'name' => 'Tênis Run Pro', 
        'price' => 399.99, 
        'image' => '',
        'details' => 'Amortecimento premium para corridas de longa distância. Tecnologia AirFlow para respirabilidade.'
    ],
    [
        'name' => 'Tênis Court Master', 
        'price' => 359.99, 
        'image' => 'court',
        'details' => 'Solado de alta aderência para quadras. Cabedal em mesh transpirável.'
    ],
    [
        'name' => 'Tênis Ultimate Comfort', 
        'price' => 299.99, 
        'image' => 'https://source.unsplash.com/400x400/?shoe',
        'details' => 'Conforto para o dia-a-dia. Palmilha ortopédica removível.'
    ],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $site_title ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --dark-color:rgb(0, 0, 0);
            --light-color: #F9F9F9;
        }

        body {
            background-color: var(--light-color);
        }

        .header {
            background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(0, 0, 0, 0.7)), url('https://source.unsplash.com/1920x600/?tennis');
            height: 30vh;
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav {
            background: var(--dark-color);
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin: 0 1rem;
            transition: color 0.3s;
        }

        .nav a:hover {
            color: var(--primary-color);
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 4rem 2rem;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(248, 8, 8, 0.1);
            transition: transform 0.3s;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-price {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin: 0.5rem 0;
        }

        .btn {
            background: var(--secondary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            display: inline-block;
        }

        .btn:hover {
            background: #3BA99C;
        }

        footer {
            background: var(--dark-color);
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            overflow: auto;
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 2rem;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            position: relative;
            animation: modalOpen 0.3s;
        }

        @keyframes modalOpen {
            from {opacity: 0; transform: translateY(-50px)}
            to {opacity: 1; transform: translateY(0)}
        }

        .close {
            position: absolute;
            right: 1rem;
            top: 1rem;
            font-size: 2rem;
            cursor: pointer;
            color: var(--dark-color);
        }

        .modal-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .modal-details {
            margin: 1.5rem 0;
            line-height: 1.6;
            color: #666;
        }

        @media (max-width: 768px) {
            .products {
                grid-template-columns: 1fr;
            }
            
            .modal-content {
                width: 90%;
                margin: 10% auto;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <a href="#home">Home</a>
        <a href="#produtos">Produtos</a>
        <a href="#sobre">Sobre</a>
        <a href="#contato">Contato</a>
    </nav>

    <header class="header">
        <div>
            <h1>Bem-vindo ao Tennis World</h1>
            <p>Os melhores tênis para o seu desempenho</p>
        </div>
    </header>

    <section class="products">
        <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="product-image">
            <div class="product-info">
                <h3><?= $product['name'] ?></h3>
                <p class="product-price">R$ <?= number_format($product['price'], 2, ',', '.') ?></p>
                <button class="btn buy-btn" 
                        data-name="<?= $product['name'] ?>"
                        data-price="<?= $product['price'] ?>"
                        data-image="<?= $product['image'] ?>"
                        data-details="<?= $product['details'] ?>">
                    Detalhes
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </section>

    <!-- Modal de Detalhes -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modalImage" class="modal-image" src="" alt="">
            <h2 id="modalName"></h2>
            <p class="product-price" id="modalPrice"></p>
            <p class="modal-details" id="modalDetails"></p>
            <button class="btn" onclick="alert('Compra finalizada com sucesso!')">Comprar Agora</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Tennis World. Todos os direitos reservados.</p>
    </footer>

    <script>
        const modal = document.getElementById('productModal');
        const span = document.getElementsByClassName('close')[0];

        document.querySelectorAll('.buy-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('modalImage').src = button.dataset.image;
                document.getElementById('modalName').textContent = button.dataset.name;
                document.getElementById('modalPrice').textContent = 
                    `R$ ${parseFloat(button.dataset.price).toFixed(2).replace('.', ',')}`;
                document.getElementById('modalDetails').textContent = button.dataset.details;
                modal.style.display = 'block';
            });
        });

        span.onclick = () => modal.style.display = 'none';
        window.onclick = (event) => {
            if (event.target === modal) modal.style.display = 'none';
        }
    </script>
</body>
</html>