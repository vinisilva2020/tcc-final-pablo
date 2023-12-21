<?php
// limparCarrinho.php

// Limpa o carrinho
setcookie('carrinho', '', time() - 3600, '/'); // Define um tempo de expiração no passado para excluir o cookie

?>
