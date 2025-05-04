document.addEventListener('DOMContentLoaded', () => {
    const roleta = document.getElementById('roleta');
    const botaoGirar = document.getElementById('girar-roleta');
    const numPremios = premios.length;
    const anguloPorItem = 360 / numPremios;
    let girando = false;

    // Configurar cores e posições dos itens da roleta
    premios.forEach((premio, index) => {
        const item = document.querySelectorAll('.item-roleta')[index];
        const angulo = index * anguloPorItem;
        const cor = `hsl(${angulo}, 70%, 50%)`;
        
        item.style.transform = `rotate(${angulo}deg)`;
        item.style.backgroundColor = cor;
    });

    botaoGirar.addEventListener('click', () => {
        if (girando) return;
        
        girando = true;
        botaoGirar.disabled = true;

        // Gerar um número aleatório de voltas (entre 5 e 10) mais um ângulo aleatório
        const voltas = Math.floor(Math.random() * 5) + 5;
        const anguloAleatorio = Math.floor(Math.random() * 360);
        const anguloTotal = (voltas * 360) + anguloAleatorio;

        // Calcular o prêmio vencedor
        const anguloFinal = anguloTotal % 360;
        const indiceVencedor = Math.floor(anguloFinal / anguloPorItem);
        const premioVencedor = premios[indiceVencedor];

        // Girar a roleta
        roleta.style.transform = `rotate(${anguloTotal}deg)`;

        // Mostrar o resultado após a rotação
        setTimeout(() => {
            alert(`Parabéns! Você ganhou: ${premioVencedor.nome}`);
            girando = false;
            botaoGirar.disabled = false;
        }, 4000);
    });
}); 