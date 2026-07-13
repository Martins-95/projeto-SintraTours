# projeto-SintraTours
O Sintra Tours é uma aplicação web desenvolvida em PHP e MySQL, criada para promover e gerir a reserva de experiências turísticas (Packs de Viagem) na região de Sintra.  A plataforma divide-se em duas vertentes principais:  Área Pública (Frontend): Uma montra digital onde os utilizadores podem explorar o catálogo de tours, consultar detalhes (preços, duração, disponibilidade) e adicionar packs a um carrinho de compras para finalizar a reserva.  Área de Administração (Backoffice): Um painel de controlo restrito, destinado aos gestores da plataforma, que permite a gestão completa (CRUD - Criar, Ler, Atualizar, Eliminar) das categorias e dos pacotes de viagem oferecidos.

O sistema é suportado pela base de dados relacional sintra_tours, composta por quatro tabelas interligadas para garantir a integridade dos dados:

utilizadores: Gere as contas de acesso (tanto clientes como administradores). Armazena o nome, email, tipo de permissão e a palavra-passe sob a forma de uma hash criptografada segura.

categorias: Classifica os tipos de experiências disponíveis (ex: Individual, Familiar, Privado), facilitando a organização do catálogo.

produtos: O núcleo do catálogo. Guarda todas as informações dos packs: nome, descrição, preço, duração, stock de lugares, imagem ilustrativa, estado de destaque (para a página inicial) e a Chave Estrangeira que o liga a uma categoria específica.

carrinho: Regista as intenções de compra. Associa um utilizador a um produto, guardando a quantidade de pessoas, a data da visita e o estado atual da compra (comprado = 0 para itens pendentes no carrinho, comprado = 1 para histórico finalizado).

DIAGRAMA EER
<img width="651" height="507" alt="Diagrama EER" src="https://github.com/user-attachments/assets/eb13bb7e-c9c9-4cb8-bb64-15ec018ee77c" />

SCREENSHOTS:
<img width="2048" height="885" alt="Captura de ecrã 2026-07-13, às 16 24 54" src="https://github.com/user-attachments/assets/72a95c70-54c3-46d8-b6a4-c9ca0f185299" />
<img width="2047" height="841" alt="Captura de ecrã 2026-07-13, às 16 25 19" src="https://github.com/user-attachments/assets/1f6fdf75-bf67-41fb-bf75-f75ae53b54b7" />
<img width="2041" height="978" alt="Captura de ecrã 2026-07-13, às 16 26 24" src="https://github.com/user-attachments/assets/02d40d5c-1d60-45d3-ba18-ceb7287787a7" />
<img width="2048" height="1007" alt="Captura de ecrã 2026-07-13, às 16 25 33" src="https://github.com/user-attachments/assets/f5ba4538-e95f-453a-a165-464e7718464e" />
<img width="2048" height="1009" alt="Captura de ecrã 2026-07-13, às 16 26 49" src="https://github.com/user-attachments/assets/09dff43e-0cf5-41aa-9d4f-93faa031441c" />
<img width="2048" height="595" alt="Captura de ecrã 2026-07-13, às 16 27 14" src="https://github.com/user-attachments/assets/2603b076-e124-46d0-a5ea-376df7bc89f3" />

