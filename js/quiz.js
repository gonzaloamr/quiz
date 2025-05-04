document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM carregado');
    
    let perguntas = [];
    let perguntaAtual = 0;
    let acertos = 0;

    // Função para carregar as perguntas
    function carregarPerguntas() {
        return fetch('get_perguntas.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erro HTTP: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Resposta do servidor:', data);
                
                if (data.status === 'error') {
                    throw new Error(data.message);
                }
                
                perguntas = data.data;
                console.log('Perguntas carregadas:', perguntas);
                mostrarPergunta();
            })
            .catch(error => {
                console.error('Erro detalhado:', error);
                alert(`Erro ao carregar as perguntas: ${error.message}\nPor favor, tente novamente.`);
            });
    }

    function mostrarPergunta() {
        console.log('Mostrando pergunta:', perguntaAtual);
        
        if (!perguntas[perguntaAtual]) {
            console.error('Pergunta atual não encontrada:', perguntaAtual);
            return;
        }
        
        const pergunta = perguntas[perguntaAtual];
        console.log('Pergunta atual:', pergunta);
        
        const perguntaTexto = document.getElementById('pergunta-texto');
        if (perguntaTexto) {
            perguntaTexto.textContent = pergunta.pergunta;
        } else {
            console.error('Elemento pergunta-texto não encontrado');
        }
        
        const opcoesContainer = document.getElementById('opcoes-container');
        if (opcoesContainer) {
            opcoesContainer.innerHTML = '';
            
            const opcoes = [
                { letra: 'A', texto: pergunta.opcao_a },
                { letra: 'B', texto: pergunta.opcao_b },
                { letra: 'C', texto: pergunta.opcao_c },
                { letra: 'D', texto: pergunta.opcao_d }
            ];

            opcoes.forEach(opcao => {
                const button = document.createElement('button');
                button.className = 'opcao';
                button.textContent = `${opcao.letra}) ${opcao.texto}`;
                button.onclick = () => verificarResposta(opcao.letra);
                opcoesContainer.appendChild(button);
            });
        } else {
            console.error('Elemento opcoes-container não encontrado');
        }
    }

    function verificarResposta(resposta) {
        const pergunta = perguntas[perguntaAtual];
        const opcoes = document.querySelectorAll('.opcao');
        const resultadoContainer = document.getElementById('resultado-container');
        const resultadoTexto = document.getElementById('resultado-texto');

        opcoes.forEach(opcao => {
            opcao.disabled = true;
            if (opcao.textContent.startsWith(pergunta.resposta_correta)) {
                opcao.classList.add('correta');
            } else if (opcao.textContent.startsWith(resposta)) {
                opcao.classList.add('incorreta');
            }
        });

        if (resposta === pergunta.resposta_correta) {
            acertos++;
            resultadoTexto.textContent = 'Parabéns! Você acertou!';
        } else {
            resultadoTexto.textContent = 'Que pena! Você errou!';
        }

        resultadoContainer.style.display = 'block';
    }

    const botaoProximaPergunta = document.getElementById('proxima-pergunta');
    if (botaoProximaPergunta) {
        botaoProximaPergunta.addEventListener('click', () => {
            perguntaAtual++;
            if (perguntaAtual < perguntas.length) {
                document.getElementById('resultado-container').style.display = 'none';
                mostrarPergunta();
            } else {
                if (acertos > 0) {
                    window.location.href = 'roleta.php';
                } else {
                    alert('Infelizmente você não acertou nenhuma pergunta. Tente novamente!');
                    window.location.reload();
                }
            }
        });
    } else {
        console.error('Botão próxima pergunta não encontrado');
    }

    // Iniciar o quiz carregando as perguntas
    carregarPerguntas();
}); 