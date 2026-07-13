<?php include 'includes/menu.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contacto - Sintra Tour</title>
</head>
<body>
    <header>
        <h1 id="titulo2">Contacto</h1>
    </header>
    <main>
        <section id="contact" class="section">
            <h2>Entre em Contato Conosco</h2>
            <p>Se tiver alguma dúvida ou quiser reservar a sua viagem, não hesite em entrar em contato conosco. Estamos aqui para ajudar!</p>
            <form id="contact-form">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" placeholder="O seu nome completo" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="o-seu@email.com" required>
                </div>
                <div class="form-group">
                    <label for="assunto">Assunto:</label>
                    <select id="assunto" name="assunto" required>
                        <option value="" disabled selected>Selecione um assunto...</option>
                        <option value="reserva">Reserva de Tour</option>
                        <option value="duvida">Dúvida Geral</option>
                        <option value="orcamento">Pedido de Orçamento Personalizado</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Mensagem:</label>
                    <textarea id="message" name="message" rows="4" placeholder="Escreva a sua mensagem aqui..." required></textarea>
                </div>
                <button id="submit" type="submit"><i class="fa fa-solid fa-paper-plane fa-beat"></i> Enviar Mensagem</button>
            </form>
        </section>
        <div class="button-voltar">
            <button id="voltar"><a href="index.php"><i class="fa fa-solid fa-house"></i> Pagina Principal</a></button>
        </div>
    </main>
    <footer>
        <p>© 2026 Sintra Tours | Made in Portugal</p>
    </footer>
</body>
