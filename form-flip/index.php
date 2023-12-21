<!DOCTYPE html>
<html lang="en">
<!--divinectorweb.com-->

<head>
	<meta charset="UTF-8">
	<title>Contact Form With Flip Animation Effect</title>
	<link href="style.css" rel="stylesheet">
</head>

<body>
	
	<div class="wrapper">
		<div class="box">
			<div class="front">
				<h2>Quitutes da vivi</h2>
				<p>O "Quitutes da Vi" vai além de uma simples opção de delivery. É um espaço dedicado à excelência
					gastronômica, proporcionando não apenas produtos de alta qualidade, mas também uma experiência única
					de sabores. Nosso compromisso é oferecer praticidade, satisfação e o prazer de uma refeição
					deliciosa, tornando cada pedido uma experiência única para nossos clientes.</p><a
					class="btn animate" href="#">Contate-nos</a>
					<a class="btn" href="../index.php">Voltar a página inicial</a>
					
			</div>
			<div class="back">
				<a class="animate close" href="#">&times;</a>
				<div class="container">
					<form action="https://formspree.io/f/myyrgjeg" method="POST">
						<label>Nome Completo</label>
						<input placeholder="Seu nome completo" type="text" required>
						<label>Seu endereço de email</label>
						<input placeholder="Seu email completo" type="email" required>
						<label>Sua mensagem</label>
						<textarea></textarea> <input type="submit" value="Enviar" required>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
	</script>
	<script>
		$(document).ready(function () {
			$('.animate').click(function () {
				$('.box').toggleClass('animated');
				return false;
			});
		});
	</script>
</body>

</html>